<?php
include "dbConnect.php";

$id = $_GET['id'];

$sql = "DELETE FROM product_variants WHERE id = $id";
mysqli_query($conn, $sql);

header("Location: variants.php");
exit();
?>