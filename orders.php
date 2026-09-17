<?php
include "dbConnect.php";

$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders - FMS</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Orders</h1>

<p><a href="createOrder.php">Create New Order</a></p>

<h2>All Orders</h2>
<table border="1">
    <tr>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Date</th>
        <th>Status</th>
        <th>Total</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) {

        $custLookup = "SELECT name FROM customers WHERE id = " . $row['customer_id'];
        $custLookupResult = mysqli_query($conn, $custLookup);
        $custRow = mysqli_fetch_assoc($custLookupResult);
        $customerName = $custRow['name'];

        $totalSql = "SELECT SUM(quantity * price_at_purchase) AS order_total FROM order_items WHERE order_id = " . $row['id'];
        $totalResult = mysqli_query($conn, $totalSql);
        $totalRow = mysqli_fetch_assoc($totalResult);
        $orderTotal = $totalRow['order_total'];

        if ($orderTotal == null) {
            $orderTotal = 0;
        }
    ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $customerName; ?></td>
        <td><?php echo $row['order_date']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td>£<?php echo number_format($orderTotal, 2); ?></td>
        <td>
            <a href="viewOrder.php?id=<?php echo $row['id']; ?>">View</a>
            |
            <a href="deleteOrder.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

<p><a href="index.php">Back to Home</a></p>

</body>
</html>