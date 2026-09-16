<?php
include "dbConnect.php";

$id = $_GET['id'];

$sql = "DELETE FROM products WHERE id = $id";
mysqli_query($conn, $sql);

header("Location: products.php");
exit();
?>