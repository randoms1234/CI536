<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <script src="js/index.js"></script>
  <script src="js/search.js"></script>
  <title>MarketPlace</title>
</head>
<header>
  <div class="topnav">
    <div class="active">
      <h3>Market Place</h3>
      <!-- <img  src="https://upload.wikimedia.org/wikipedia/en/5/52/Testcard_F.jpg" alt="">-->
    </div>
    <div id="links">
      <a href="index.php">Home</a>
      <a href="selling.php">Selling</a>
      <a href="about.php">About</a>
      <a href="login.php">Login</a>
      <a href="account.php">Account</a>
    </div>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</header>
<body>
<main>
  <div id="searchform">
    <form method="GET" action="search.php">
      <fieldset>
        <label for="search">Search for an item</label>
        <input id="search" type="text">
        <input id="btn" type="submit" value="Search">
      </fieldset>
    </form>
  </div>
  <div id="srchresult">
      <?php
      if (isset($_GET['search'])) {
          $searchTerm = $conn->real_escape_string($_GET['search']);
          $sql = "SELECT * FROM Items WHERE title LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo "<article class='home'>
                            <h2>" . $row['title'] . "</h2>
                            <p>" . $row['description'] . "</p>
                            <p>£" . $row['price'] . "</p>
                            <button>BUY</button>
                          </article>";
              }
          } else {
              echo "<h3>No results found for '$searchTerm'</h3>";
          }
      }
      ?>
  </div>
</main>
</body>
</html>