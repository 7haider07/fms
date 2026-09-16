<?php
include "dbConnect.php";

$id = $_POST['id'];
$category_id = $_POST['category_id'];
$name = $_POST['name'];
$description = $_POST['description'];
$base_price = $_POST['base_price'];

$sql = "UPDATE products SET category_id = '$category_id', name = '$name', description = '$description', base_price = '$base_price' WHERE id = $id";
mysqli_query($conn, $sql);

header("Location: products.php");
exit();
?>