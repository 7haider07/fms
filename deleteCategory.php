<?php
include "dbConnect.php";

$id = $_GET['id'];

$checkSql = "SELECT COUNT(*) AS total FROM products WHERE category_id = $id";
$checkResult = mysqli_query($conn, $checkSql);
$checkRow = mysqli_fetch_assoc($checkResult);

if ($checkRow['total'] > 0) {
    echo "This category cannot be deleted because it still has products assigned to it. Please move or delete those products first.";
    echo "<br><a href='categories.php'>Back to Categories</a>";
    exit();
}

$sql = "DELETE FROM categories WHERE id = $id";
mysqli_query($conn, $sql);

header("Location: categories.php");
exit();
?>