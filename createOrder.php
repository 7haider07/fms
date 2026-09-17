<?php
include "dbConnect.php";

$custSql = "SELECT * FROM customers ORDER BY name ASC";
$custResult = mysqli_query($conn, $custSql);

$varSql = "SELECT product_variants.*, products.name AS product_name FROM product_variants, products WHERE product_variants.product_id = products.id ORDER BY products.name ASC";
$varResult = mysqli_query($conn, $varSql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Order - FMS</title>
</head>
<body>

<h1>Create Order</h1>

<form action="processOrder.php" method="POST">

    <label for="customer_id">Customer:</label>
    <select id="customer_id" name="customer_id" required>
        <?php while ($cust = mysqli_fetch_assoc($custResult)) { ?>
        <option value="<?php echo $cust['id']; ?>"><?php echo $cust['name']; ?></option>
        <?php } ?>
    </select>

    <h3>Items</h3>

    <?php for ($i = 1; $i <= 5; $i++) { ?>
    <div id="itemRow<?php echo $i; ?>" <?php if ($i > 1) echo 'style="display:none;"'; ?>>
        <select name="variant_id[]">
            <option value="">-- Select a variant --</option>
            <?php
            mysqli_data_seek($varResult, 0);
            while ($var = mysqli_fetch_assoc($varResult)) {
            ?>
            <option value="<?php echo $var['id']; ?>"><?php echo $var['product_name']; ?> - <?php echo $var['variant_name']; ?></option>
            <?php } ?>
        </select>
        <label>Quantity:</label>
        <input type="number" name="quantity[]" min="1">
    </div>
    <?php } ?>

    <button type="button" onclick="addItemRow()">Add Item</button>

    <br><br>
    <button type="submit">Create Order</button>
</form>

<a href="orders.php">Cancel</a>

<script>
var rowCount = 1;

function addItemRow() {
    if (rowCount < 5) {
        rowCount = rowCount + 1;
        var nextRow = document.getElementById("itemRow" + rowCount);
        nextRow.style.display = "block";
    }
}
</script>

</body>
</html>