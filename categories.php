<?php
include "dbConnect.php";

$sql = "SELECT * FROM categories ORDER BY name ASC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories - FMS</title>
</head>
<body>

<h1>Furniture Categories</h1>

<h2>Add New Category</h2>
<form action="addCategory.php" method="POST">
    <label for="name">Category Name:</label>
    <input type="text" id="name" name="name" required>
    <button type="submit">Add Category</button>
</form>

<h2>All Categories</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td>
            <a href="editCategory.php?id=<?php echo $row['id']; ?>">Edit</a>
            |
            <a href="deleteCategory.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>