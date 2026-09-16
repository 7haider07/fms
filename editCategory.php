<?php
include "dbConnect.php";

$id = $_GET['id'];
$sql = "SELECT * FROM categories WHERE id = $id";
$result = mysqli_query($conn, $sql);
$category = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Category - FMS</title>
</head>
<body>

<h1>Edit Category</h1>

<form action="updateCategory.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
    <label for="name">Category Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $category['name']; ?>" required>
    <button type="submit">Save Changes</button>
</form>

<a href="categories.php">Cancel</a>

</body>
</html>