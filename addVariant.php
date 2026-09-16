<?php
include "dbConnect.php";

$product_id = $_POST['product_id'];
$variant_name = $_POST['variant_name'];
$stock_quantity = $_POST['stock_quantity'];
$price = $_POST['price'];
$sale_price = $_POST['sale_price'];

if ($sale_price == "") {
    $sale_price = null;
}

$sql = "INSERT INTO product_variants (product_id, variant_name, stock_quantity, price, sale_price) VALUES ('$product_id', '$variant_name', '$stock_quantity', '$price', '$sale_price')";

mysqli_query($conn, $sql);

header("Location: variants.php");
exit();
?>