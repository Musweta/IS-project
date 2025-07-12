<?php
// manage_users.php

// Step 1: Database connection settings
$host = 'localhost';         // Hostname
$db   = 'exportlink_db';     // Database name
$user = 'student';              // MySQL username
$pass = 'student';                  // MySQL password 
$charset = 'utf8mb4';        // Character set

// Step 2: Set up DSN (Data Source Name) and options
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Enable exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use native prepared statements
];

try {
    // Step 3: Create PDO instance
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Step 4: Fetch all users
    $stmt = $pdo->query("SELECT user_id, name, email, role FROM users ORDER BY user_id ASC");
    $users = $stmt->fetchAll();

} catch (\PDOException $e) {
    // Handle connection errors
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ExportLink - Manage Users</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheetom/css2?family=Inter:wght@300;400;600;700&display=swap
  https://cdn.tailwindcss.com
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <div class="wireframe-container">
    <div class="pb-8">
      <header class="header-nav">
        <div class="logo text-blue-700">ExportLink Admin</div>
        <nav class="nav-links">
          <a href="admin_dashboard.html">Verifications</a>
          <a href="manage_users.php" class="text-blue-700 font-bold">Manage Users</a>
          <a href="#" onclick="alert('Generating Reports...')">Reports</a>
          <a href="index.html">Logout</a>
        </nav>
      </header>

      <h1 class="text-2xl font-bold text-gray-800 mb-6">Manage Users</h1>

      <div class="mb-6">
        <input type="text" placeholder="Search users by name or email..." class="w-full" />
      </div>

      <div class="overflow-x-auto rounded-lg shadow-sm">
        <table>
          <thead>
            <tr>
              <th>User ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user): ?>
              <tr>
                <td><?= htmlspecialchars('USR' . str($user['user_id'], 3, '0', STR_PAD_LEFT)) ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= ucfirst(htmlspecialchars($user['role'])) ?></td>
                <td>Active</td>
                <td>
                  <button class="text-blue-600 font-medium mr-2">Edit</button>
                  <?php if ($user['role'] !== 'admin'): ?>
                    <button class="text-red-600 font-medium">Deactivate</button>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
