<?php
session_start();
include 'connect.php';

// Redirect to login if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check if post ID is set in the URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Prepare and execute the deletion statement
    $stmt = $conn->prepare("DELETE FROM peer_support WHERE id = ? AND user_id = (SELECT id FROM users WHERE username = ?)");
    $stmt->bind_param("is", $post_id, $_SESSION['username']);

    if ($stmt->execute()) {
        // Successfully deleted
        // Redirect to community page
        header("Location: community.php");
        exit();
    } else {
        // Handle potential error during deletion
        echo "Error: Unable to delete post. Please try again.";
    }

    // Close the statement
    $stmt->close();
} else {
    // Redirect to community page if post ID is not set
    header("Location: community.php");
    exit();
}

// Close the database connection
$conn->close();
?>
