<?php
$host = 'localhost';
$db   = 'exportlink_db';
$user = 'student'; 
$pass = 'student';     
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
?>
<?php
// Function to fetch pending verifications
function fetchPendingVerifications($pdo) {
    $stmt = $pdo->query("SELECT * FROM verifications WHERE status = 'pending'");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}       