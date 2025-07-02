<?php
// Connect to the MySQL database
$host = 'localhost'; // or your server IP
$db = 'exportlink_db';
$user = 'student'; // replace with your DB username
$pass = 'student';     // replace with your DB password

// Create a new MySQLi connection
$conn = new mysqli($host, $user, $pass, $db);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql = "SELECT name, price, image_url FROM products ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 ExportLink - Browse Products</title>
  https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css
  https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap
  https://cdn.tailwindcss.com
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <div class="wireframe-container">
    <header class="header-nav">
      <-links">
        <a href="productListing.php" class="text-blue-700 font-bold">Browse Products</a>
        <a href="order_management.html">My Orders</a>
        <a href="#">Profile</a>
        <a href="index.html">Logout</a>
      </nav>
    </header>

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Browse Products</h1>

    <!-- Product Grid -->
    <div class="product-grid">
      <?php
      // Check if products exist
      if ($result->num_rows > 0) {
          // Output each product
          while ($row = $result->fetch_assoc()) {
              $name = htmlspecialchars($row['name']);
              $price = number_format($row['price'], 2);
              $image = $row['image_url'] ?: 'https://placehold.co/250x150/e0e0e0/555555?text=No+Image';

              echo "
              <div class='product-card'>
                <img src='$image' alt='$name'>
                <div class='details'>
                  <h3 class='text-lg font-semibold text-gray-800 mb-1'>$name</h3>
                  <p class='text-gray-600 mb-3'>Price: \$$price/kg</p>
                  <button class='btn-secondary w-full'>View Details</button>
                  <button class='btn-primary w-full mt-2' onclick=\"alert('Contacting Farmer for $name')\">Contact Farmer</button>
                </div>
              </div>";
          }
      } else {
          echo "<p>No products found.</p>";
      }

      // Close the database connection
      $conn->close();
      ?>
    </div>
  </div>
</body>
</html>
