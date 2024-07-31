<?php
include 'includes/config.php';
include 'includes/header.php';

$sql = "SELECT * FROM products ORDER BY created_at DESC";
$result = $conn->query($sql);

echo "<h1>Products</h1>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div><h2>" . $row['name'] . "</h2><p>" . $row['description'] . "</p><p>Price: $" . $row['price'] . "</p><p><a href='product.php?id=" . $row['id'] . "'>View</a></p></div><hr>";
    }
} else {
    echo "No products available.";
}

include 'includes/footer.php';
$conn->close();
?>
