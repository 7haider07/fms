<?php
include "dbConnect.php";

$id = $_POST['id'];
$name = $_POST['name'];

$sql = "UPDATE categories SET name = '$name' WHERE id = $id";
mysqli_query($conn, $sql);

header("Location: categories.php");
exit();
?>