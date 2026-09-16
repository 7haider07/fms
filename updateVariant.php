<?php
include "dbConnect.php";

$id = $_POST['id'];
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
    $sql = "UPDATE product_variants SET product_id = '$product_id', variant_name = '$variant_name', stock_quantity = '$stock_quantity', price = '$price', sale_price = NULL WHERE id = $id";
} else {
    $sql = "UPDATE product_variants SET product_id = '$product_id', variant_name = '$variant_name', stock_quantity = '$stock_quantity', price = '$price', sale_price = '$sale_price' WHERE id = $id";
}

mysqli_query($conn, $sql);

header("Location: variants.php");
exit();
?>