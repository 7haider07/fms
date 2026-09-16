<?php
include "dbConnect.php";

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$sql = "UPDATE customers SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE id = $id";
mysqli_query($conn, $sql);

header("Location: customers.php");
exit();
?>