<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch user ID from the database based on the username
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    if ($user_id) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO peer_support (post_title, post_content, user_id, parent_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $post_title, $post_content, $user_id, $parent_id);

        // Set parameters and execute
        $post_title = "Reply"; // Set a default title for replies
        $post_content = $_POST['reply_content'];
        $parent_id = $_POST['post_id'];
        $stmt->execute();

        // Close the statement and connection
        $stmt->close();
        $conn->close();

        // Redirect to community page
        header("Location: community.php");
        exit();
    } else {
        // Handle case where user ID is not found
        echo "Error: User ID not found.";
    }
}
?>
