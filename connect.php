<?php
// Database connection details
$host = 'localhost';
$user = 'root';  // Your MySQL username
$password = '';  // Your MySQL password (default is empty for XAMPP)
$database = 'stress_management'; // Replace with your database name

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
