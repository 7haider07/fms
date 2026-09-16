<?php
include "dbConnect.php";

$id = $_GET['id'];

$sql = "DELETE FROM customers WHERE id = $id";
mysqli_query($conn, $sql);

header("Location: customers.php");
exit();
?>