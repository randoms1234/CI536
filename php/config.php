<?php
// Database configuration
$servername = "localhost"; // Replace with your MySQL server hostname
$username = "zr137_groupproject"; // Replace with your MySQL username
$password = "7KLkpm9RJ8pA"; // Replace with your MySQL password
$database = "zr137_group"; // Replace with the name of your MySQL database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

