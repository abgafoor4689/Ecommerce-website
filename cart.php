<?php
include 'includes/config.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }

    header('Location: cart.php');
}

echo "<h1>Your Cart</h1>";
if (!empty($_SESSION['cart'])) {
    $total_price = 0;
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $sql = "SELECT * FROM products WHERE id=$product_id";
        $result = $conn->query($sql);
        $product = $result->fetch_assoc();

        echo "<div><h2>" . $product['name'] . "</h2><p>Quantity: " . $quantity . "</p><p>Price: $" . $product['price'] . "</p><p>Total: $" . ($product['price'] * $quantity) . "</p></div><hr>";
        $total_price += $product['price'] * $quantity;
    }
    echo "<h2>Total Price: $" . $total_price . "</h2>";
    echo "<a href='checkout.php' class='button'>Checkout</a>";
} else {
    echo "Your cart is empty.";
}

include 'includes/footer.php';
$conn->close();
?>
