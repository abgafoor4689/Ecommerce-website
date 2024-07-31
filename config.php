<?php
$host = 'localhost';
$db = 'ecommerce';
$user = 'root';
$pass = '';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    // Log the error message
    error_log("Connection failed: " . $conn->connect_error);
    // Display a user-friendly message
    echo "Sorry, there seems to be an issue with the connection. Please try again later.";
    exit();
}

// Start session
session_start();
?>
