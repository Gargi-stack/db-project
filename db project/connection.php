<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Replace with your PHPMyAdmin username
$password = ""; // Replace with your PHPMyAdmin password
$dbname = "transport";

// Connect to MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>