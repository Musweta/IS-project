<?php
// login.php

// Step 1: Start the session to manage user login state
session_start();

// Step 2: Define database connection parameters
$host = 'localhost';         // Database host
$db   = 'exportlink_db';     // Database name
$user = 'student';              // Database username
$pass = 'student';                  // Database password (update if needed)

// Step 3: Create a new database connection using MySQLi
$conn = new mysqli($host, $user, $pass, $db);

// Step 4: Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 5: Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Step 6: Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT user_id, name, email, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Step 7: Fetch result
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Step 8: Verify password (assuming it's hashed using password_hash)
        if (password_verify($password, $user['password'])) {
            // Step 9: Store user info in session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // Optional: Redirect based on role
            if ($user['role'] === 'farmer') {
                header("Location: farmerDashboard.php");
            } elseif ($user['role'] === 'importer') {
                header("Location: importerDashboard.php");
            } else {
                header("Location: adminDashboard.php");
            }
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with that email.";
    }

    $stmt->close();
}

$conn->close();
?>

<!-- Optional: Display error message -->
<?php if (!empty($error)): ?>
    <p style="color: red; text-align: center;"><?php echo $error; ?></p>
<?php endif; ?>
