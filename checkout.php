<?php
include 'includes/config.php';
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $sql = "SELECT price FROM products WHERE id=$product_id";
        $result = $conn->query($sql);
        $product = $result->fetch_assoc();
        $total_price = $product['price'] * $quantity;

        $sql = "INSERT INTO orders (user_id, product_id, quantity, total_price) VALUES ('$user_id', '$product_id', '$quantity', '$total_price')";
        $conn->query($sql);
    }

    unset($_SESSION['cart']);
    echo "<h1>Thank you for your purchase!</h1>";
} else {
    echo "<h1>Checkout</h1>";
    echo "<form action='checkout.php' method='POST'>
            <input type='submit' value='Place Order'>
          </form>";
}

include 'includes/footer.php';
$conn->close();
?>
