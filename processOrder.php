<?php
include "dbConnect.php";

$customer_id = $_POST['customer_id'];
$order_date = date("Y-m-d");
$status = "pending";

$sql = "INSERT INTO orders (customer_id, order_date, status) VALUES ('$customer_id', '$order_date', '$status')";
mysqli_query($conn, $sql);

$order_id = mysqli_insert_id($conn);

$variant_ids = $_POST['variant_id'];
$quantities = $_POST['quantity'];

$totalRows = count($variant_ids);

for ($i = 0; $i < $totalRows; $i++) {

    $variant_id = $variant_ids[$i];
    $quantity = $quantities[$i];

    if ($variant_id == "" || $quantity == "") {
        continue;
    }

    $priceSql = "SELECT price, sale_price FROM product_variants WHERE id = $variant_id";
    $priceResult = mysqli_query($conn, $priceSql);
    $priceRow = mysqli_fetch_assoc($priceResult);

    if ($priceRow['sale_price'] != null) {
        $price_at_purchase = $priceRow['sale_price'];
    } else {
        $price_at_purchase = $priceRow['price'];
    }

    $itemSql = "INSERT INTO order_items (order_id, variant_id, quantity, price_at_purchase) VALUES ('$order_id', '$variant_id', '$quantity', '$price_at_purchase')";
    mysqli_query($conn, $itemSql);
}

header("Location: orders.php");
exit();
?>