<?php
include "dbConnect.php";

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$sql = "INSERT INTO customers (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";

mysqli_query($conn, $sql);

header("Location: customers.php");
exit();
?>