<?php
session_start();
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peer Support Communities</title>
    <link rel="stylesheet" href="community.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
            <div>
                <?php if (isset($_SESSION['username'])): ?>
                    <span class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                    <a href="logout.php" style="margin-left: 20px;">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                    <a href="register.php" style="margin-left: 20px;">Register</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    
    <main>
        <!-- Peer Support Communities Section -->
        <section class="community">
            <h2>Peer Support Communities</h2>
            
            <?php if (isset($_SESSION['username'])): ?>
                <form action="add_post.php" method="POST" class="post-form">
                    <label for="post_title">Post Title:</label>
                    <input type="text" id="post_title" name="post_title" required>
                    
                    <label for="post_content">Post Content:</label>
                    <textarea id="post_content" name="post_content" required></textarea>
                    
                    <input type="submit" value="Submit Post" class="submit-button">
                </form>
            <?php else: ?>
                <p><strong>Please <a href="login.php">login</a> to post in the Peer Support Communities.</strong></p>
            <?php endif; ?>

            <h3>Community Posts</h3>
            <?php
            // Fetch and display posts
            $stmt = $conn->prepare("SELECT * FROM peer_support WHERE parent_id IS NULL ORDER BY created_at DESC");
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                echo "<div class='post'>";
                echo "<h4 class='post-title'>" . htmlspecialchars($row['post_title']) . "</h4>";
                echo "<p class='post-content'>" . nl2br(htmlspecialchars($row['post_content'])) . "</p>"; 
                echo "<small>Posted by " . htmlspecialchars($row['username']) . " on " . htmlspecialchars($row['created_at']) . "</small>";

                // Fetch and display replies
                $reply_stmt = $conn->prepare("SELECT * FROM peer_support WHERE parent_id = ? ORDER BY created_at ASC");
                $reply_stmt->bind_param("i", $row['id']);
                $reply_stmt->execute();
                $reply_result = $reply_stmt->get_result();

                if ($reply_result->num_rows > 0) {
                    while ($reply = $reply_result->fetch_assoc()) {
                        echo "<div class='reply'>";
                        echo "<p class='reply-content'>" . nl2br(htmlspecialchars($reply['post_content'])) . "</p>";
                        echo "<small>Reply by " . htmlspecialchars($reply['username']) . " on " . htmlspecialchars($reply['created_at']) . "</small>";
                        echo "</div>";
                    }
                }

                // Show reply form below replies
                if (isset($_SESSION['username'])) {
                    echo "<form action='add_reply.php' method='POST' class='reply-form'>";
                    echo "<input type='hidden' name='post_id' value='" . htmlspecialchars($row['id']) . "'>";
                    echo "<label for='reply_content'>Reply:</label>";
                    echo "<textarea id='reply_content' name='reply_content' required></textarea>";
                    echo "<input type='submit' value='Reply' class='submit-button'>";
                    echo "</form>";
                }

                if (isset($_SESSION['username']) && $_SESSION['username'] == $row['username']) {
                    echo "<div class='post-actions'>";
                    echo "<a href='edit_post.php?id=" . $row['id'] . "'>Edit</a> | ";
                    echo "<a href='delete_post.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this post?\");'>Delete</a>";
                    echo "</div>";
                }
                echo "</div>"; // Close the post div
            }

            // Close the statement and connection
            $stmt->close();
            ?>
        </section>
        <!-- End of Peer Support Communities Section -->
    </main>
</body>
</html>
