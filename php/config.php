<?php
// Database configuration
$servername = "localhost"; // Replace with your MySQL server hostname
$username = "jay123"; // Replace with your MySQL username
$password = "QGZfzUBDjSkJ"; // Replace with your MySQL password
$database = "database"; // Replace with the name of your MySQL database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

