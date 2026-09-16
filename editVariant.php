<?php
include "dbConnect.php";

$id = $_GET['id'];
$sql = "SELECT * FROM product_variants WHERE id = $id";
$result = mysqli_query($conn, $sql);
$variant = mysqli_fetch_assoc($result);

if (!$variant) {
    echo "That variant doesn't exist.";
    echo "<br><a href='variants.php'>Back to Variants</a>";
    exit();
}

$prodSql = "SELECT * FROM products ORDER BY name ASC";
$prodResult = mysqli_query($conn, $prodSql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Variant - FMS</title>
</head>
<body>

<h1>Edit Variant</h1>

<form action="updateVariant.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $variant['id']; ?>">

    <label for="product_id">Product:</label>
    <select id="product_id" name="product_id" required>
        <?php while ($prod = mysqli_fetch_assoc($prodResult)) {

            if ($prod['id'] == $variant['product_id']) {
                echo "<option value='" . $prod['id'] . "' selected>" . $prod['name'] . "</option>";
            } else {
                echo "<option value='" . $prod['id'] . "'>" . $prod['name'] . "</option>";
            }

        } ?>
    </select>

    <label for="variant_name">Variant Name:</label>
    <input type="text" id="variant_name" name="variant_name" value="<?php echo $variant['variant_name']; ?>" required>

    <label for="stock_quantity">Stock Quantity:</label>
    <input type="number" id="stock_quantity" name="stock_quantity" value="<?php echo $variant['stock_quantity']; ?>" required>

    <label for="price">Price:</label>
    <input type="number" step="0.01" id="price" name="price" value="<?php echo $variant['price']; ?>" required>

    <label for="sale_price">Sale Price (leave blank if not on sale):</label>
    <input type="number" step="0.01" id="sale_price" name="sale_price" value="<?php echo $variant['sale_price']; ?>">

    <button type="submit">Save Changes</button>
</form>

<a href="variants.php">Cancel</a>

</body>
</html>