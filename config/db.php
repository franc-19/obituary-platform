<?php
// Include the database configuration file
require_once __DIR__ . '/config.php';

// Create a database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Set character encoding to avoid charset issues
$conn->set_charset("utf8mb4");

?>
