<?php
include "dbConnect.php";

$id = $_GET['id'];

$orderSql = "SELECT * FROM orders WHERE id = $id";
$orderResult = mysqli_query($conn, $orderSql);
$order = mysqli_fetch_assoc($orderResult);

if (!$order) {
    echo "That order doesn't exist.";
    echo "<br><a href='orders.php'>Back to Orders</a>";
    exit();
}

$custSql = "SELECT * FROM customers WHERE id = " . $order['customer_id'];
$custResult = mysqli_query($conn, $custSql);
$customer = mysqli_fetch_assoc($custResult);

$itemsSql = "SELECT * FROM order_items WHERE order_id = $id";
$itemsResult = mysqli_query($conn, $itemsSql);

$grandTotal = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details - FMS</title>
</head>
<body>

<h1>Order #<?php echo $order['id']; ?></h1>

<p><strong>Customer:</strong> <?php echo $customer['name']; ?> (<?php echo $customer['email']; ?>)</p>
<p><strong>Date:</strong> <?php echo $order['order_date']; ?></p>
<p><strong>Status:</strong> <?php echo $order['status']; ?></p>

<h2>Items</h2>
<table border="1">
    <tr>
        <th>Variant</th>
        <th>Quantity</th>
        <th>Price Each</th>
        <th>Subtotal</th>
    </tr>
    <?php while ($item = mysqli_fetch_assoc($itemsResult)) {

        $varSql = "SELECT product_variants.variant_name, products.name AS product_name FROM product_variants, products WHERE product_variants.id = " . $item['variant_id'] . " AND product_variants.product_id = products.id";
        $varResult = mysqli_query($conn, $varSql);
        $var = mysqli_fetch_assoc($varResult);

        $subtotal = $item['quantity'] * $item['price_at_purchase'];
        $grandTotal = $grandTotal + $subtotal;
    ?>
    <tr>
        <td><?php echo $var['product_name']; ?> - <?php echo $var['variant_name']; ?></td>
        <td><?php echo $item['quantity']; ?></td>
        <td>£<?php echo number_format($item['price_at_purchase'], 2); ?></td>
        <td>£<?php echo number_format($subtotal, 2); ?></td>
    </tr>
    <?php } ?>
</table>

<h3>Total: £<?php echo number_format($grandTotal, 2); ?></h3>

<p><a href="orders.php">Back to Orders</a></p>

</body>
</html>