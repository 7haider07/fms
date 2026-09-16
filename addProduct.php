<?php
include "dbConnect.php";

$category_id = $_POST['category_id'];
$name = $_POST['name'];
$description = $_POST['description'];
$base_price = $_POST['base_price'];

$sql = "INSERT INTO products (category_id, name, description, base_price) VALUES ('$category_id', '$name', '$description', '$base_price')";

mysqli_query($conn, $sql);

header("Location: products.php");
exit();
?>