<?php
include "dbConnect.php";

$name = $_POST['name'];

$sql = "INSERT INTO categories (name) VALUES ('$name')";

mysqli_query($conn, $sql);

header("Location: categories.php");
exit();
?>