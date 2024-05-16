<?php include 'db_connect.php';
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
        <title>MarketPlace</title>
    </head>
    <header>
        <div class="topnav">
            <div class="active">
                <h3>Market Place</h3>
            </div>
            <div id="links">
                <a href="search.php">Buying</a>
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
            <div id="wrapper"><!-- display to none when search result active-->
                <a class="home" href="search.php">
                    <article>
                        <h2>Buying</h2>
                        <p>Click Here to search for </p>
                        <p>your next treasure!</p>
                    </article>
                </a>
                <a class="home" href="selling.php">
                    <article>
                        <h2>Selling</h2>
                        <p>Wanna Sell your stuff?</p>
                        <p>Click here to begin</p>
                    </article>
                </a>
                <a class="home" href="about.php">
                    <article >
                        <h2>About</h2>
                        <p>FAQs</p>
                        <p>Contact us</p>

                    </article>
                </a>
                <a class="home" id="account" href="account.php" >
                    <article>
                        <h2>Account</h2>
                        <p>Your Account Details</p>
                    </article>
                </a>
            </div>
        </main>
    </body>
    <footer>
    </footer>
</html>