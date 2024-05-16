<?php
session_start(); // Start the session
include 'db_connect.php'; // Include database connection

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $itemName = $conne->real_escape_string($_POST['itemName']);
    $itemDesc = $conne->real_escape_string($_POST['itemDesc']);
    $itemPrice = $conne->real_escape_string($_POST['itemPrice']);
    
    // Check if the user is logged in (replace 1 with actual user ID if available)
    if(isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id']; // Get the user ID from the session
    } else {
        // Redirect to login page or handle unauthorized access
        header("Location: login.php");
        exit();
    }

    // Get the current datetime
    $createdAt = date("Y-m-d H:i:s");

    // SQL query to insert item with user ID
    $sql = "INSERT INTO Items (user_id, title, description, price, created_at) VALUES ('$userId', '$itemName', '$itemDesc', '$itemPrice', '$createdAt')";

    // Execute the query
    if ($conne->query($sql) === TRUE) {
        echo "<p>Item listed successfully!</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conne->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <script src="js/index.js"></script>
  <title>selling</title>
</head>
<header>
  <div class="topnav">
    <div class="active">
      <h3>MarketPlace</h3>
    </div>
    <div id="links">
      <a href="index.php">Home</a>
      <a href="search.php">Buying</a>
      <a href="account.php">Account</a>
      <a href="login.php">Login</a>
      <a href="about.php">About</a>
    </div>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</header>
<body>
  <main>
    <div id="wrapper" class="login">
      <article id="sellimg">
        <p>Upload images goes here</p>
      </article>
      <article>
        <form method="post" action="">
          <fieldset>
            <label for="itemName">Item Name</label>
            <input type="text" id="itemName" name="itemName" placeholder="Item Name" required>
            <label for="itemDesc">Item Description</label>
            <textarea id="itemDesc" name="itemDesc" placeholder="Item Description" required></textarea>
            <label for="itemPrice">Price (£)</label>
            <input type="number" id="itemPrice" name="itemPrice" placeholder="0.00" step="0.01" required>
          </fieldset>
          <input type="submit" value="Sell">
        </form>
      </article>
    </div>
  </main>
</body>
<footer></footer>
</html>
