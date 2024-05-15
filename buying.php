<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <script src="js/index.js"></script>
    <title>Buying</title>
</head>
<header>
  <div class="topnav">
    <div class="active">
      <h3>MarketPlace</h3>
    </div>
    <div id="links">
      <a href="index.php">Home</a>
      <a href="selling.php">Selling</a>
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
    <div id="wrapper">
      <div id="itemImages">
        <img id="bigPrevImage" src="https://upload.wikimedia.org/wikipedia/en/5/52/Testcard_F.jpg" alt="">
        <div class="preview">
          <img class="prevImage" src="https://upload.wikimedia.org/wikipedia/en/5/52/Testcard_F.jpg" alt="">
          <img  class="prevImage" src="https://upload.wikimedia.org/wikipedia/en/5/52/Testcard_F.jpg" alt="">
          <img class="prevImage" src="https://upload.wikimedia.org/wikipedia/en/5/52/Testcard_F.jpg" alt="">
        </div>
      </div>
      <article class="itmdesc">
        <h3>Item Name</h3>
        <p>Item Description</p>
        <p><strong>Price</strong></p>
        <button id="buyBtn">BUY</button>
      </article>
      <article class="home" id="reviews">
        <h3>User Reviews</h3>
        <p>placeholder</p>
        <p>placeholder</p>
        <p>placeholder</p>
        <p>placeholder</p>
        <p>placeholder</p>
      </article>
      <article class="home" id="recommend">
        <h2>Recommendations</h2>
        <p>placeholder</p>
        <p>placeholder</p>
        <p>placeholder</p>
        <p>placeholder</p>
        <p>placeholder</p>
      </article>
    </div>
    </main>
</body>
<footer></footer>
</html>