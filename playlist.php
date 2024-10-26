<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Playlist</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
            <div class="auth-links">
                <!-- Display the username if logged in -->
                <?php if (isset($_SESSION['username'])): ?>
                    <span class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                    <a href="logout.php" class="logout-link">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="auth-button">Login</a>
                    <a href="register.php" class="auth-button">Register</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <main>
        

        <section id="community">
            <h2>Stress</h2>
            <p>A calming and Guidance collection of videos designed to help relieve stress and promote relaxation</p>
            <!-- Lock "Start Chat" button until user logs in -->
            <?php if (isset($_SESSION['username'])): ?>
                <button id="stress-btn">Watch Now</button>
            <?php else: ?>
                <p><strong>Please <a href="login.php">login</a> to access the chat support.</strong></p>
            <?php endif; ?>
        </section>
        <section id="community">
            <h2>Depression</h2>
            <p>A soothing playlist to help uplift your mood and ease the burden of depression.</p>
            <!-- Lock "Start Chat" button until user logs in -->
            <?php if (isset($_SESSION['username'])): ?>
                <button id="dep-btn">Watch Now</button>
            <?php else: ?>
                <p><strong>Please <a href="login.php">login</a> to access the chat support.</strong></p>
            <?php endif; ?>
        </section>
        <section id="community">
            <h2>Anxiety</h2>
            <p>A calming playlist to help reduce anxiety and bring peace of mind.</p>
            <!-- Lock "Start Chat" button until user logs in -->
            <?php if (isset($_SESSION['username'])): ?>
                <button id="anx-btn">Watch Now</button>
            <?php else: ?>
                <p><strong>Please <a href="login.php">login</a> to access the chat support.</strong></p>
            <?php endif; ?>
        </section>
        <section id="community">
            <h2>ADHD</h2>
            <p>An energizing playlist designed to improve focus and manage ADHD symptoms.</p>
            <!-- Lock "Start Chat" button until user logs in -->
            <?php if (isset($_SESSION['username'])): ?>
                <button id="adhd-btn">Watch Now</button>
            <?php else: ?>
                <p><strong>Please <a href="login.php">login</a> to access the chat support.</strong></p>
            <?php endif; ?>
        </section>
    </main>

    <script>
        // Redirect button is clicked
        document.getElementById("stress-btn").onclick = function() {
            window.location.href = "videos/stress/stress.html";
        };
        document.getElementById("dep-btn").onclick = function() {
            window.location.href = "videos/depression/depression.html";
        };
        document.getElementById("anx-btn").onclick = function() {
            window.location.href = "videos/anxiety/anxiety.html";
        };
        document.getElementById("adhd-btn").onclick = function() {
            window.location.href = "videos/adhd/ADHD.html";
        };
    </script>
</body>
</html>
