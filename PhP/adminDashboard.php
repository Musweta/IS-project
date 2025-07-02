<?php
require 'db.php';

// Fetch pending verifications with importer names
$sql = "
    SELECT v.verification_id, u.name AS company_name, v.submitted_on
    FROM verifications v
   .user_id
    WHERE v.status = 'pending'
    ORDER BY v.submitted_on DESC
";
$stmt = $pdo->query($sql);
$verifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch dashboard statistics
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$totalProducts = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$totalFarmers = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'farmer'")->fetchColumn();
$ordersToday = $pdo->query("SELECT COUNT(*) FROM orders WHERE DATE(order_date) = CURDATE()")->fetchColumn();
$totalImporters = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'importer'")->fetchColumn();

$stats = [
    ["label" => "Total Users", "value" => $totalUsers],
    ["label" => "Products Listed", "value" => $totalProducts],
    ["label" => "Farmers", "value" => $totalFarmers],
    ["label" => "Orders Today", "value" => $ordersToday],
    ["label" => "Importers", "value" => $totalImporters]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ExportLink - Admin Dashboard</title>
  https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css
  https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap
  https://cdn.tailwindcss.com
  <link rel="stylesheet" href="CSS/adminDashboard.css" />
</wireframe-container">
    <div class="pb-8">
      <header class="header-nav">
        <div class="logo text-blue-700">ExportLink Admin</div>
        <nav class="nav-links">
          <a href="adminDashboard.php" class="text-blue-700 font-bold">Verifications</a>
          <a href="manage_users.php">Manage Users</a>
          <a href="#" onclick="alert('Generating Reports...')">Reports</a>
          <a href="index.php">Logout</a>
        </nav>
      </header>

      <h1 class="text-2xl font-bold text-gray-800 mb-6">Administrator Dashboard</h1>

      <!-- Verifications Table -->
      <h2 class="text-xl font-semibold text-gray-800 mb-4">Pending Importer Verifications</h2>
      <div class="overflow-x-auto rounded-lg shadow-sm mb-8">
        <table>
          <thead>
            <tr>
              <th>Company Name</th>
              <th>Submitted On</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($verifications as $entry): ?>
              <tr>
                <td><?= htmlspecialchars($entry['company_name']) ?></td>
                <td><?= htmlspecialchars($entry['submitted_on']) ?></td>
                <td>
                  <button class="text-blue-600 font-medium mr-2">Review</button>
                  <button class="text-green-600 font-medium mr-2">Approve</button>
                  <button class="text-red-600 font-medium">Reject</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- Dashboard Statistics -->
      <h2 class="text-xl font-semibold text-gray-800 mb-4">System Overview</h2>
      <div class="dashboard-stats">
        <?php foreach ($stats as $stat): ?>
          <div class="stat-card">
            <div class="value"><?= htmlspecialchars($stat['value']) ?></div>
            <div class="label"><?= htmlspecialchars($stat['label']) ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</body>

<script>
  // Optional interactivity
  document.querySelector('.btn-primary')?.addEventListener('click', function(event) {
    event.preventDefault();
    alert('Changes saved successfully!');
  });
</script>
</html>
