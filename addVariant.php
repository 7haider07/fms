<?php
include "dbConnect.php";

$product_id = $_POST['product_id'];
$variant_name = $_POST['variant_name'];
$stock_quantity = $_POST['stock_quantity'];
$price = $_POST['price'];
$sale_price = $_POST['sale_price'];

if ($stock_quantity < 0) {
    echo "Stock quantity cannot be negative.";
    echo "<br><a href='variants.php'>Back to Variants</a>";
    exit();
}

if ($sale_price == "") {
    $sql = "INSERT INTO product_variants (product_id, variant_name, stock_quantity, price, sale_price) VALUES ('$product_id', '$variant_name', '$stock_quantity', '$price', NULL)";
} else {
    $sql = "INSERT INTO product_variants (product_id, variant_name, stock_quantity, price, sale_price) VALUES ('$product_id', '$variant_name', '$stock_quantity', '$price', '$sale_price')";
}

mysqli_query($conn, $sql);

header("Location: variants.php");
exit();
?>