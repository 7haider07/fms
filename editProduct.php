<?php
include "dbConnect.php";

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    echo "That product doesn't exist.";
    echo "<br><a href='products.php'>Back to Products</a>";
    exit();
}

$catSql = "SELECT * FROM categories ORDER BY name ASC";
$catResult = mysqli_query($conn, $catSql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product - FMS</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Edit Product</h1>

<form action="updateProduct.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

    <label for="category_id">Category:</label>
    <select id="category_id" name="category_id" required>
        <?php while ($cat = mysqli_fetch_assoc($catResult)) {

            if ($cat['id'] == $product['category_id']) {
                echo "<option value='" . $cat['id'] . "' selected>" . $cat['name'] . "</option>";
            } else {
                echo "<option value='" . $cat['id'] . "'>" . $cat['name'] . "</option>";
            }

        } ?>
    </select>

    <label for="name">Product Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required>

    <label for="description">Description:</label>
    <textarea id="description" name="description"><?php echo $product['description']; ?></textarea>

    <label for="base_price">Base Price:</label>
    <input type="number" step="0.01" id="base_price" name="base_price" value="<?php echo $product['base_price']; ?>" required>

    <button type="submit">Save Changes</button>
</form>

<a href="products.php">Cancel</a>

</body>
</html>