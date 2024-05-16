<?php
include 'db_connect.php';

// Get the raw POST data
$rawData = file_get_contents("php://input");

// Decode the JSON data
$data = json_decode($rawData, true);

// Check if item_id is set
if (isset($data['item_id'])) {
    $itemId = $conne->real_escape_string($data['item_id']);
    
    // Remove the item from the database
    $sql = "DELETE FROM Items WHERE item_id = '$itemId'";
    if ($conne->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Order confirmed']);
    } else {
        // Log the error and send a detailed error message
        error_log("SQL Error: " . $conne->error);
        echo json_encode(['status' => 'error', 'message' => 'Failed to confirm order: ' . $conne->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
