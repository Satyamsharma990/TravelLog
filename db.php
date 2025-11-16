<?php
// Database configuration
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "travellog";
$port = 3307;

// Create connection
$conn = new mysqli($host, $user, $pass, $db, $port);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Set proper charset for security + Unicode support
$conn->set_charset("utf8mb4");
?>
