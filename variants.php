<?php
include "dbConnect.php";

$sql = "SELECT * FROM product_variants ORDER BY variant_name ASC";
$result = mysqli_query($conn, $sql);

$prodSql = "SELECT * FROM products ORDER BY name ASC";
$prodResult = mysqli_query($conn, $prodSql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Variants - FMS</title>
</head>
<body>

<h1>Product Variants</h1>

<h2>Add New Variant</h2>
<form action="addVariant.php" method="POST">
    <label for="product_id">Product:</label>
    <select id="product_id" name="product_id" required>
        <?php while ($prod = mysqli_fetch_assoc($prodResult)) { ?>
        <option value="<?php echo $prod['id']; ?>"><?php echo $prod['name']; ?></option>
        <?php } ?>
    </select>

    <label for="variant_name">Variant Name:</label>
    <input type="text" id="variant_name" name="variant_name" placeholder="e.g. Oak / Large" required>

    <label for="stock_quantity">Stock Quantity:</label>
    <input type="number" id="stock_quantity" name="stock_quantity" required>

    <label for="price">Price:</label>
    <input type="number" step="0.01" id="price" name="price" required>

    <label for="sale_price">Sale Price (leave blank if not on sale):</label>
    <input type="number" step="0.01" id="sale_price" name="sale_price">

    <button type="submit">Add Variant</button>
</form>

<h2>All Variants</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Product</th>
        <th>Variant</th>
        <th>Stock</th>
        <th>Price</th>
        <th>Sale Price</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) {

        $prodLookup = "SELECT name FROM products WHERE id = " . $row['product_id'];
        $prodLookupResult = mysqli_query($conn, $prodLookup);
        $prodRow = mysqli_fetch_assoc($prodLookupResult);
        $productName = $prodRow['name'];
    ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $productName; ?></td>
        <td><?php echo $row['variant_name']; ?></td>
        <td><?php echo $row['stock_quantity']; ?></td>
        <td>£<?php echo $row['price']; ?></td>
        <td>
            <?php
            if ($row['sale_price'] == null) {
                echo "-";
            } else {
                echo "£" . $row['sale_price'];
            }
            ?>
        </td>
        <td>
            <a href="editVariant.php?id=<?php echo $row['id']; ?>">Edit</a>
            |
            <a href="deleteVariant.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this variant?');">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

<p><a href="products.php">Back to Products</a></p>

</body>
</html>