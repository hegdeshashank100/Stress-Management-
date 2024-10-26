<?php
// Start the session
session_start();

// Database connection details
$host = 'localhost'; // Database host
$user = 'root'; // Database username
$password = ''; // Database password
$database = 'stress_management'; // Replace with your actual database name

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

// Execute the statement and check if successful
if ($stmt->execute()) {
    // Set a success message in the session
    $_SESSION['success_message'] = "Your message has been sent successfully!";

    // Prepare email
    $to = $email;
    $subject = "Thank You for Your Support";
    $body = "Dear $name,\n\nThank you for reaching out to us! We appreciate your support and will get back to you shortly.\n\nBest regards,\nThe Team";
    $headers = "From: no-reply@yourdomain.com"; // Replace with your sender email address

   
} else {
    // Set an error message in the session
    $_SESSION['error_message'] = "Failed to send your message. Please try again.";
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Redirect back to contactus.php
header("Location: contactus.php");
exit();
?>
