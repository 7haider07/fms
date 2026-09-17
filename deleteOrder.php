<?php
include "dbConnect.php";

$id = $_GET['id'];

$checkSql = "SELECT COUNT(*) AS total FROM order_items WHERE order_id = $id";
$checkResult = mysqli_query($conn, $checkSql);
$checkRow = mysqli_fetch_assoc($checkResult);

if ($checkRow['total'] > 0) {
    $deleteItemsSql = "DELETE FROM order_items WHERE order_id = $id";
    mysqli_query($conn, $deleteItemsSql);
}

$sql = "DELETE FROM orders WHERE id = $id";
mysqli_query($conn, $sql);

header("Location: orders.php");
exit();
?>