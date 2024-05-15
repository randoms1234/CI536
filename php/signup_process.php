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

$data = json_decode(file_get_contents('php://input'), true);
$username = $data["username"];
$email = $data['email'];
$password = $data["password"];

// Validate password
if (!checkPassword($password)) {
    $response = array(
        "success" => false,
        "message" => "Password must be 8 or more characters long and contain at least 1 uppercase letter, 1 lowercase letter, and 1 digit"
    );
    // Return the JSON response
    header("Content-Type: application/json");
    echo json_encode($response);
    exit(); // Exit the script after sending the response
}

// Check if username or email already exists
$checkUserQuery = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($checkUserQuery);
if ($result->num_rows > 0) {
    $response = array("success" => false, "message" => "Username already exists");
    // Return the JSON response
    header("Content-Type: application/json");
    echo json_encode($response);
    exit(); // Exit the script after sending the response
}

// Hash the password
$hashedPassword = md5($password); // You should use stronger hashing algorithms like bcrypt or Argon2

// Insert new user into database
$insertQuery = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
if ($conn->query($insertQuery) === TRUE) {
    $_SESSION['username'] = $username;
    $response = array("success" => true, "message" => "Account successfully created!");
} else {
    $response = array("success" => false, "message" => "Error occurred");
}

// Close the database connection
$conn->close();

// Return the JSON response
header("Content-Type: application/json");
echo json_encode($response);

function checkPassword($password) {
    $number = preg_match('@[0-9]@', $password);
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    return strlen($password) >= 8 && $uppercase && $lowercase && $number;
}
?>

