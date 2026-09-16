<?php
include "dbConnect.php";

$id = $_GET['id'];

$checkSql = "SELECT COUNT(*) AS total FROM product_variants WHERE product_id = $id";
$checkResult = mysqli_query($conn, $checkSql);
$checkRow = mysqli_fetch_assoc($checkResult);

if ($checkRow['total'] > 0) {
    echo "This product cannot be deleted because it still has variants assigned to it. Please delete those variants first.";
    echo "<br><a href='products.php'>Back to Products</a>";
    exit();
}

$sql = "DELETE FROM products WHERE id = $id";
mysqli_query($conn, $sql);

header("Location: products.php");
exit();
?>