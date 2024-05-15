<?php
session_start();

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

// Retrieve JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

$username = $data["username"];
$password = $data["password"];

// Prepare and execute the SQL statement to fetch user data
$stmt = $conn->prepare('SELECT id, password FROM users WHERE username = ? OR email = ?');
$stmt->bind_param('ss', $username, $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($userId, $hashedPassword);
    $stmt->fetch();
    
    // Verify the password
    if (password_verify($password, $hashedPassword)) {
        // Password is correct, start a session
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $userId;

        $response = array("success" => true, "message" => "Login successful!");
    } else {
        // Incorrect password
        $response = array("success" => false, "message" => "Incorrect password.");
    }
} else {
    // No user found with the given username or email
    $response = array("success" => false, "message" => "User not found.");
}

$stmt->close();
$conn->close();

// Return the JSON response
header("Content-Type: application/json");
echo json_encode($response);
?>

