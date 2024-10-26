<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Support</title>
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
            <h2>Bounce Game</h2>
            <p>Enjoy a classic arcade experience where you control a ball to bounce and avoid obstacles, aiming for high scores!</p>
            <!-- Lock "Start Chat" button until user logs in -->
            <?php if (isset($_SESSION['username'])): ?>
                <button id="pag-btn">play game</button>
            <?php else: ?>
                <p><strong>Please <a href="login.php">login</a> to access the chat support.</strong></p>
            <?php endif; ?>
        </section>
        <section id="community">
            <h2>Rock,Paper and Scissor</h2>
            <p>Rock, Paper, Scissors Game: A classic hand-gesture game where players choose between rock, paper, or scissors to compete against the computer and score points.</p>
            <!-- Lock "Start Chat" button until user logs in -->
            <?php if (isset($_SESSION['username'])): ?>
                <button id="rps-btn">play game</button>
            <?php else: ?>
                <p><strong>Please <a href="login.php">login</a> to access the chat support.</strong></p>
            <?php endif; ?>
        </section>
    </main>

    <script>
        // Redirect button is clicked
        document.getElementById("pag-btn").onclick = function() {
            window.location.href = "Games/PAG/index.html";
        };
        document.getElementById("rps-btn").onclick = function() {
            window.location.href = "Games/rockpaper/index.html";
        };
    </script>
</body>
</html>
