<?php global $conne;
$servername = "localhost"; // e.g., db.example.com
$username = "zr137_groupproject";
$password = "7KLkpm9RJ8pA";
$dbname = "zr137_group";

// Create connection
$conne = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conne->connect_error) {
    die("Connection failed: " . $conne->connect_error);
}
?>