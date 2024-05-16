<?php
session_start();

// Database configuration
$servername = "localhost"; // Replace with your MySQL server hostname
$username = "cr910_Connor"; // Replace with your MySQL username
$password = "Randoms123.."; // Replace with your MySQL password
$database = "cr910_grouppj"; // Replace with the name of your MySQL database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$username = $data["username"];
$password = $data["password"];

// Prepare the SQL query with parameter binding
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if password record exists
if ($row = $result->fetch_assoc()) {
    $storedPassword = $row['password'];

    // Hash the provided password for comparison
    $hashedPassword = md5($password);

    // Check if the hashed password matches the stored password
    if ($hashedPassword === $storedPassword) {
        $_SESSION['username'] = $username;
        $response = array("success" => true);
    } else {
        $response = array("success" => false, "message" => "Username or password incorrect");
    }
} else {
    $response = array("success" => false, "message" => "Fatal error occurred");
}

$stmt->close();
$conn->close();

header("Content-Type: application/json");
echo json_encode($response);
?>
