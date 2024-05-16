<?php
$servername = "localhost"; // e.g., db.example.com
$username = "zr137_groupproject";
$password = "7KLkpm9RJ8pA";
$dbname = "zr137_group";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>