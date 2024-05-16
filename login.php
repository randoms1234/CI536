<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <script src="js/index.js"></script>
    <title>login</title>
</head>
<header>
  <div class="topnav">
    <div class="active">
      <h3>MarketPlace</h3>
    </div>
    <div id="links">
      <a href="index.php">Home</a>
      <a href="search.php">Buying</a>
      <a href="selling.php">Selling</a>
      <a href="account.php">Account</a>
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
        <!--<div class="home" id="login-signup">-->
          <?php
          if (isset($_SESSION['login_input'])) {
              echo '<h1><a href="php/logout.php">Sign out</a></h1>';
          } else {
              echo '<h1><a href="login.html">Sign up | Login</a></h1>';
          }
          ?>
      <!--  </div>-->

  </div>
</main>
</body>
<footer></footer>
</html>