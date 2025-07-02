<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your actual database password
$dbname = "exportlink_db";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form inputs
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Securely hash the password
    $role = $conn->real_escape_string($_POST['role']);
    $address = isset($_POST['address']) ? $conn->real_escape_string($_POST['address']) : null;
    $phone_number = isset($_POST['phone_number']) ? $conn->real_escape_string($_POST['phone_number']) : null;

    // Prepare the SQL query to insert the user
    $sql = "INSERT INTO users (name, email, password, role, address, phone_number)
            VALUES ('$name', '$email', '$password', '$role', '$address', '$phone_number')";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
