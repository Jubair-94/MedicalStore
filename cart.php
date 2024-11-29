<?php
session_start();
include 'db_connection.php';

$user_id = $_SESSION['user_id'];
$query = "SELECT Products.product_name, Sales.quantity, Sales.total_price 
          FROM Sales JOIN Products ON Sales.product_id = Products.product_id 
          WHERE Sales.user_id = $user_id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Your Cart</h2>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($cart_item = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $cart_item['product_name'] . "</td>";
                echo "<td>" . $cart_item['quantity'] . "</td>";
                echo "<td>$" . $cart_item['total_price'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="customer_dashboard.php">Back to Shopping</a> | <a href="checkout.php">Checkout</a>
</body>
</html>
