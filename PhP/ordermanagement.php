<?php
// order_management.php

// Step 1: Database connection setup
$host = 'localhost';           // Database host
$db   = 'exportlink_db';       // Database name
$user = 'student';                // Database username
$pass = 'student';               // Database password
$charset = 'utf8mb4';          // Character set

// Step 2: Set up DSN and options for PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Enable exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use native prepared statements
];

try {
    // Step 3: Create PDO instance
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Handle connection error
    echo "Database connection failed: " . $e->getMessage();
    exit;
}

// Step 4: Fetch orders (example: for importer_id = 1)
$importer_id = 1; // This would typically come from session or login
$sql = "
    SELECT 
        o.order_id,
        p.name AS product_name,
        o.order_date,
        o.total_amount,
        o.status
    FROM orders o
    JOIN products p ON o.product_id = p.product_id
    WHERE o.importer_id = ?
    ORDER BY o.order_date DESC
";
$stmt = $pdo->prepare($sql);
$stmt->execute([$importer_id]);
$orders = $stmt->fetchAll();
?>

<!-- Step 5: HTML Output -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ExportLink - My Orders</title>
  https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600=swap
  https://cdn.tailwindcss.com
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <div class="wireframe-container">
    <div class="pb-8">
      <header class="header-nav">
        <div class="logo">ExportLink</div>
        <nav class="nav-links">
          <a href="product_listing.html">Browse Products</a>
          <a href="order_management.php" class="text-blue-700 font-bold">My Orders</a>
         index.html">Logout</a>
        </nav>
      </header>

      <h1 class="text-2xl font-bold text-gray-800 mb-6">My Orders</h1>

      <div class="flex justify-end mb-4">
        <button class="btn-secondary">
          <i class="fas fa-download mr-2"></i> Export Orders
        </button>
      </div>

      <div class="overflow-x-auto rounded-lg shadow-sm">
        <table>
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Product(s)</th>
              <th>Date</th>
              <th>Total</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($orders) > 0): ?>
              <?php foreach ($orders as $order): ?>
                <tr>
                  <td>#<?= htmlspecialchars($order['order_id']) ?></td>
                  <td><?= htmlspecialchars($order['product_name']) ?></td>
                  <td><?= htmlspecialchars(date('Y-m-d', strtotime($order['order_date']))) ?></td>
                  <td>$<?= htmlspecialchars($order['total_amount']) ?></td>
                  <td><?= htmlspecialchars(ucfirst($order['status'])) ?></td>
                  <td><a href="#" class="action-link">View</a></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="text-center text-gray-500">No orders found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    document.querySelector('.btn-secondary').addEventListener('click', function(event) {
      event.preventDefault();
      alert('Orders exported successfully!');
    });
  </script>
</body>
</html>
