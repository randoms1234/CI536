<?php include 'db_connect.php'; ?>
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
    <div id="wrapper" class="sellwrap">
      <article id="sellimg">
        <p>Upload images goes here</p>
      </article>
      <article>
        <form>
          <fieldset>
            <label for="itemName"></label>
            <input type="text" id="itemName" placeholder="Item Name" required>
            <label for="itemDesc"></label>
            <textarea id="itemDesc" placeholder="item Description" required></textarea>
            <label for="itemPrice">£ <input type="number" id="itemPrice" placeholder="0.00" required></label>
          </fieldset>
          <input type="submit" value="Sell">
        </form>
      </article>
    </div>
      <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $itemName = $conn->real_escape_string($_POST['itemName']);
          $itemDesc = $conn->real_escape_string($_POST['itemDesc']);
          $itemPrice = $conn->real_escape_string($_POST['itemPrice']);
          $userId = 1; // Replace with actual user ID from session or authentication mechanism

          $sql = "INSERT INTO Items (user_id, title, description, price) VALUES ('$userId', '$itemName', '$itemDesc', '$itemPrice')";

          if ($conn->query($sql) === TRUE) {
              echo "<p>Item listed successfully!</p>";
          } else {
              echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
          }
      }
      ?>
  </main>
</body>
<footer></footer>
</html>