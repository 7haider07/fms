<?php
include "dbConnect.php";

$id = $_GET['id'];
$sql = "SELECT * FROM customers WHERE id = $id";
$result = mysqli_query($conn, $sql);
$customer = mysqli_fetch_assoc($result);

if (!$customer) {
    echo "That customer doesn't exist.";
    echo "<br><a href='customers.php'>Back to Customers</a>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Customer - FMS</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Edit Customer</h1>

<form action="updateCustomer.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $customer['name']; ?>" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $customer['email']; ?>" required>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" value="<?php echo $customer['phone']; ?>">

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="<?php echo $customer['address']; ?>">

    <button type="submit">Save Changes</button>
</form>

<a href="customers.php">Cancel</a>

</body>
</html>