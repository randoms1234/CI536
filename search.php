<?php
include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <script src="js/index.js"></script>
  <script src="js/search.js"></script> <!-- Link to the new JavaScript file -->
  <title>MarketPlace</title>
</head>
<header>
  <div class="topnav">
    <div class="active">
      <h3>Market Place</h3>
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
    <form method="GET" action="index.php">
      <fieldset>
        <label for="search">Search for an item</label>
        <input id="search" name="search" type="text">
        <input id="btn" type="submit" value="Search">
      </fieldset>
    </form>
  </div>
  <div id="usrsearch"></div> <!-- Add this element to display the user's search term -->
  <div id="srchresult">
    <?php
    if (isset($_GET['search'])) {
        $searchTerm = $conne->real_escape_string($_GET['search']);
        $sql = "SELECT * FROM Items WHERE title LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%'";
        $result = $conne->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<article class='home'>
                          <h2>" . htmlspecialchars($row['title']) . "</h2>
                          <p>" . htmlspecialchars($row['description']) . "</p>
                          <p>£" . htmlspecialchars($row['price']) . "</p>
                          <button>BUY</button>
                        </article>";
            }
        } else {
            echo "<h3>No results found for '" . htmlspecialchars($searchTerm) . "'</h3>";
        }
    }
    ?>
  </div>
</main>
</body>
</html>

