<?php
include "dbConnect.php";

$sql = "SELECT * FROM products ORDER BY name ASC";
$result = mysqli_query($conn, $sql);

$catSql = "SELECT * FROM categories ORDER BY name ASC";
$catResult = mysqli_query($conn, $catSql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products - FMS</title>
</head>
<body>

<h1>Products</h1>

<h2>Add New Product</h2>
<form action="addProduct.php" method="POST">
    <label for="category_id">Category:</label>
    <select id="category_id" name="category_id" required>
        <?php while ($cat = mysqli_fetch_assoc($catResult)) { ?>
        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
        <?php } ?>
    </select>

    <label for="name">Product Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="description">Description:</label>
    <textarea id="description" name="description"></textarea>

    <label for="base_price">Base Price:</label>
    <input type="number" step="0.01" id="base_price" name="base_price" required>

    <button type="submit">Add Product</button>
</form>

<h2>All Products</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Category</th>
        <th>Name</th>
        <th>Description</th>
        <th>Base Price</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) {

        $catLookup = "SELECT name FROM categories WHERE id = " . $row['category_id'];
        $catLookupResult = mysqli_query($conn, $catLookup);
        $catRow = mysqli_fetch_assoc($catLookupResult);
        $categoryName = $catRow['name'];
    ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $categoryName; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <td>£<?php echo $row['base_price']; ?></td>
        <td>
            <a href="editProduct.php?id=<?php echo $row['id']; ?>">Edit</a>
            |
            <a href="deleteProduct.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

<p><a href="categories.php">Back to Categories</a></p>

</body>
</html>