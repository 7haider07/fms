<?php
include "dbConnect.php";

$sql = "SELECT * FROM customers ORDER BY name ASC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers - FMS</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Customers</h1>

<h2>Add New Customer</h2>
<form action="addCustomer.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone">

    <label for="address">Address:</label>
    <input type="text" id="address" name="address">

    <button type="submit">Add Customer</button>
</form>

<h2>All Customers</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td><?php echo $row['address']; ?></td>
        <td>
            <a href="editCustomer.php?id=<?php echo $row['id']; ?>">Edit</a>
            |
            <a href="deleteCustomer.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this customer?');">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

<p><a href="index.php">Back to Home</a></p>

</body>
</html>