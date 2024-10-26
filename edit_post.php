<?php
session_start();
include 'connect.php';

// Redirect to login if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission for updating the post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare the SQL statement to update the post
    $stmt = $conn->prepare("UPDATE peer_support SET post_title = ?, post_content = ? WHERE id = ? AND user_id = (SELECT id FROM users WHERE username = ?)");
    $stmt->bind_param("ssis", $post_title, $post_content, $post_id, $_SESSION['username']);

    // Set parameters and execute
    $post_title = $_POST['post_title'];
    $post_content = $_POST['post_content'];
    $post_id = $_POST['post_id'];
    
    if ($stmt->execute()) {
        // Redirect to community page on success
        header("Location: community.php");
        exit();
    } else {
        // Handle SQL execution error
        echo "Error: Unable to update post. Please try again.";
    }

    // Close the statement
    $stmt->close();
} else {
    // Fetch the existing post for editing
    $post_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM peer_support WHERE id = ? AND user_id = (SELECT id FROM users WHERE username = ?)");
    $stmt->bind_param("is", $post_id, $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    // Check if the post exists
    if (!$post) {
        header("Location: community.php");
        exit();
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="community.php">Peer Support Communities</a></li>
            </ul>
            <div>
                <span class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                <a href="logout.php" style="margin-left: 20px;">Logout</a>
            </div>
        </nav>
    </header>
    
    <main>
        <section id="edit-post">
            <h2>Edit Post</h2>
            <form action="edit_post.php" method="POST" class="post-form">
                <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['id']); ?>">
                
                <label for="post_title">Post Title:</label>
                <input type="text" id="post_title" name="post_title" value="<?php echo htmlspecialchars($post['post_title']); ?>" required>
                
                <label for="post_content">Post Content:</label>
                <textarea id="post_content" name="post_content" required><?php echo htmlspecialchars($post['post_content']); ?></textarea>
                
                <input type="submit" value="Update Post" class="submit-button">
            </form>
        </section>
    </main>
</body>
</html>
