<?php
// Start the session to access session variables
session_start();

// Replace with your actual database credentials
$host = 'localhost';
$db   = 'exportlink_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// Set up DSN and options for PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Establish database connection
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Handle connection error
    die("Database connection failed: " . $e->getMessage());
}

// Simulate a logged-in farmer (replace with actual session logic)
$farmer_id = $_SESSION['user_id'] ?? 1; // Default to 1 for testing

// Fetch recent orders for this farmer's products
$sql = "
    SELECT o.order_id, p.name AS product_name, o.status
    FROM orders o
    JOIN products p ON o.product_id = p.product_id
    WHERE p.farmer_id = ?
    ORDER BY o.order_date DESC
    LIMIT 10
";
$stmt = $pdo->prepare($sql);
$stmt->execute([$farmer_id]);
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ExportLink - Farmer Dashboard</title>
  <link rel="stylesheet" href="styles.css">
  https://cdn.tailwindcss.com
</head>
<body>
  <div class="wireframe-container">
    <header class="header-nav">
      <div class="logo">ExportLink</div>
      <nav class="nav-links">
        <a href="farmer_dashboard.php" class="text-blue-700 font-bold">My Products</a>
        <a href="order_management.php">My Orders</a>
        <a href="#">Profile</a>
        <a href="logout.php">Logout</a>
      </nav>
    </header>

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Welcome, Farmer!</h1>

    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mb-8">
      <button class="btn-primary flex-1" onclick="alert('New product added successfully!')">
        <i class="fas fa-plus mr-2"></i> Add New Product
      </button>
      <div class="btn-secondary flex-1 flex items-center justify-center">
        <i class="fas fa-bell mr-2"></i> Notifications (3)
      </div>
    </div>

    <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Orders</h2>
    <div class="overflow-x-auto rounded-lg shadow-sm">
      <table>
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Product</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($orders as $order): ?>
            <tr>
              <td>#<?= htmlspecialchars($order['order_id']) ?></td>
              <td><?= htmlspecialchars($order['product_name']) ?></td>
              <td><?= htmlspecialchars($order['status']) ?></td>
              <td>
                <button class="btn-secondary text-sm px-3 py-1 mr-2" onclick="alert('Action for Order #<?= $order['order_id'] ?>')">Action</button>
                <button class="btn-primary text-sm px-3 py-1" onclick="alert('Details for Order #<?= $order['order_id'] ?>')">View Details</button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
