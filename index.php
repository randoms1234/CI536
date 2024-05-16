<?php
include 'db_connect.php';

// Check if it's a POST request to delete an item
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    exit;
}

// Check if it's a GET request for searching items
if (isset($_GET['search'])) {
    $searchTerm = $conne->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM Items WHERE title LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%'";
    $result = $conne->query($sql);
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
  <script src="js/search.js"></script>
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
  <div id="usrsearch"></div>
  <div id="srchresult">
    <?php
    if (isset($result)) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<article class='home'>
                          <h2>" . htmlspecialchars($row['title']) . "</h2>
                          <p>" . htmlspecialchars($row['description']) . "</p>
                          <p>£" . htmlspecialchars($row['price']) . "</p>";
                if (!empty($row['image_path'])) {
                    echo "<img src='" . htmlspecialchars($row['image_path']) . "' alt='" . htmlspecialchars($row['title']) . "' style='width:100px;height:auto;'/>";
                }
                echo "<button class='buy-button' data-id='" . htmlspecialchars($row['item_id']) . "'>BUY</button>
                      </article>";
            }
        } else {
            echo "<h3>No results found for '" . htmlspecialchars($searchTerm) . "'</h3>";
        }
    }
    ?>
  </div>
</main>
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('#searchform form').addEventListener('submit', sendSearch);

    document.addEventListener('click', async function(event) {
        if (event.target && event.target.classList.contains('buy-button')) {
            const itemId = event.target.getAttribute('data-id');

            if (itemId) {
                try {
                    const response = await fetch('index.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ item_id: itemId })
                    });

                    const result = await response.json();

                    if (result.status === 'success') {
                        alert('Order confirmed');
                        event.target.closest('article').remove();
                    } else {
                        alert('Failed to confirm order: ' + result.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }
        }
    });
});

async function sendSearch(evt) {
    evt.preventDefault();

    const search = document.querySelector('#search').value.trim();
    if (search === '') return;

    try {
        const response = await fetch(`index.php?search=${encodeURIComponent(search)}`);
        const text = await response.text();
        const parser = new DOMParser();
        const doc = parser.parseFromString(text, 'text/html');
        const results = doc.querySelector('#srchresult');

        if (results) {
            document.querySelector('#srchresult').innerHTML = results.innerHTML;
            document.querySelector('#srchresult').style.display = 'grid';
            document.querySelector('#usrsearch').textContent = "You Searched For: " + search;
        } else {
            console.error('Search results element not found in response.');
        }
    } catch (error) {
        console.error('Error fetching search results:', error);
    }
}
</script>
</body>
</html>


