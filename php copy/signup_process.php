<?php
session_start();

// Database configuration
$servername = "localhost"; // Replace with your MySQL server hostname
$username = "cr910_Connor"; // Replace with your MySQL username
$password = "Randoms123.."; // Replace with your MySQL password
$database = "cr910_grouppj"; // Replace with the name of your MySQL database$conn = new mysqli($servername, $username, $password, $database);

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$firstName = $data["first_name"];
$lastName = $data["last_name"];
$fullName = $firstName . ' ' . $lastName;
$username = $data["username"];
$email = $data['email'];
$password = $data["password"];

// Validate password
if (!checkPassword($password)) {
    $response = array(
        "success" => false,
        "message" => "Password must be 8 or more characters long and contain at least 1 uppercase letter, 1 lowercase letter, and 1 digit"
    );
    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
}

// Check if username or email already exists
$checkUserQuery = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$result = $conn->query($checkUserQuery);
if ($result->num_rows > 0) {
    $response = array("success" => false, "message" => "Username or email already exists");
    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
}

// Hash the password using bcrypt
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert new user into database
$insertQuery = "INSERT INTO users (full_name, username, email, password) VALUES ('$fullName', '$username', '$email', '$hashedPassword')";
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