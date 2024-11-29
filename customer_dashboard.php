<?php
session_start();
include 'db_connection.php';

// Check if user is logged in and is a customer
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'customer') {
    header("Location: login.php");
    exit();
}

// Fetch all products from the database
$query = "SELECT * FROM Products";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Banner Section -->
    <div class="banner">
        <img src="images/customer-banner.jpg" alt="Customer Dashboard Banner">
    </div>

    <div class="container">
        <h1>Welcome to the Medical Shop</h1>
        <h2>Available Products</h2>

        <div class="product-list">
            <?php
            while ($product = mysqli_fetch_assoc($result)) {
                echo "<div class='product'>";
                echo "<h3>" . $product['product_name'] . "</h3>";
                echo "<p>" . $product['description'] . "</p>";
                echo "<p>Price: $" . $product['price'] . "</p>";
                echo "<form action='add_to_cart.php' method='POST'>";
                echo "<input type='hidden' name='product_id' value='" . $product['product_id'] . "'>";
                echo "<input type='number' name='quantity' value='1' min='1' max='" . $product['stock'] . "' required>";
                echo "<input type='submit' value='Add to Cart'>";
                echo "</form>";
                echo "</div>";
            }
            ?>
        </div>

        <a href="cart.php">View Cart</a> | <a href="logout.php">Logout</a>
    </div>

</body>
</html>
