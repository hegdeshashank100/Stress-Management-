<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (isset($_SESSION['username'])) {
        // Fetch user ID from the database based on the username
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $stmt->close();

        if ($user_id) {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO peer_support (post_title, post_content, user_id) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $post_title, $post_content, $user_id);

            // Set parameters
            $post_title = $_POST['post_title'];
            $post_content = $_POST['post_content'];

            // Execute the insert statement
            if ($stmt->execute()) {
                // Redirect to community page on success
                header("Location: community.php");
                exit();
            } else {
                // Handle SQL execution error
                echo "Error: Unable to add post. Please try again.";
            }

            // Close the statement
            $stmt->close();
        } else {
            // Handle case where user ID is not found
            echo "Error: User ID not found.";
        }
    } else {
        // Handle case where user is not logged in
        echo "Error: You must be logged in to post.";
    }
}

// Close the database connection
$conn->close();
?>
