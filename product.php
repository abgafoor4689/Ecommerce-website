<?php
include 'includes/config.php';
include 'includes/header.php';

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id=$id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if ($product) {
    echo "<h1>" . $product['name'] . "</h1>";
    echo "<p>" . $product['description'] . "</p>";
    echo "<p>Price: $" . $product['price'] . "</p>";
    echo "<form action='cart.php' method='POST'>
            <input type='hidden' name='product_id' value='" . $product['id'] . "'>
            <label for='quantity'>Quantity:</label>
            <input type='number' name='quantity' id='quantity' value='1' min='1'>
            <input type='submit' value='Add to Cart'>
          </form>";
} else {
    echo "Product not found.";
}

include 'includes/footer.php';
$conn->close();
?>
