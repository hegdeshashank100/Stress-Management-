<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Test Support</title>
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
    <section class="welcome-container">
        <div class="logo">
            <img src="logo.jpg" alt="Logo"> <!-- Use your actual logo image file path -->
        </div>
        <div class="info-content">
            <h2>Welcome to Your Health Test Hub!</h2>
            <p>At our Health Test Hub, we prioritize your well-being and empower you to take charge of your health journey.</p>
            <p>Here, you'll find a comprehensive selection of health assessments designed to help you understand your physical and mental well-being better.</p>
            <p>Each test is carefully curated with detailed descriptions, allowing you to choose the assessments that best suit your needs.</p> 
            <p>Whether you're looking to gauge your stress levels, anxiety, depression, or overall health, our user-friendly platform makes it easy to take the tests and track your progress.</p>
            <p>Your health matters, and we're here to support you every step of the way!</p>
            
        </div>
    </section>
        

        <section id="community">
            <h2>Depression Test</h2>
            <p>An interactive assessment that evaluates depressive symptoms and provides instant results in a circular chart to enhance self-awareness and guide users toward appropriate support.</p>
            <!-- Lock "Start Chat" button until user logs in -->
            <?php if (isset($_SESSION['username'])): ?>
                <button id="pag-btn">Take Test</button>
            <?php else: ?>
                <p><strong>Please <a href="login.php">login</a> to access the chat support.</strong></p>
            <?php endif; ?>
        </section>
        <section id="community">
            <h2>Anxiety Test</h2>
            <p>Assess your anxiety levels with our quick and interactive test for personalized insights.</p>
            <!-- Lock "Start Chat" button until user logs in -->
            <?php if (isset($_SESSION['username'])): ?>
                <button id="anx-btn">Take Test</button>
            <?php else: ?>
                <p><strong>Please <a href="login.php">login</a> to access the chat support.</strong></p>
            <?php endif; ?>
        </section>
        <section id="community">
            <h2>ADHD Test</h2>
            <p>Assess your attention and focus levels with our comprehensive ADHD test to better understand your cognitive health.</p>
            <!-- Lock "Start Chat" button until user logs in -->
            <?php if (isset($_SESSION['username'])): ?>
                <button id="adhd-btn">Take Test</button>
            <?php else: ?>
                <p><strong>Please <a href="login.php">login</a> to access the chat support.</strong></p>
            <?php endif; ?>
        </section>
        <section id="community">
            <h2>Stress Test</h2>
            <p>Evaluate your stress levels with our quick and insightful stress test to gain a clearer understanding of your mental well-being.</p>
            <!-- Lock "Start Chat" button until user logs in -->
            <?php if (isset($_SESSION['username'])): ?>
                <button id="stress-btn">Take Test</button>
            <?php else: ?>
                <p><strong>Please <a href="login.php">login</a> to access the chat support.</strong></p>
            <?php endif; ?>
        </section>
    </main>

    <script>
        // Redirect button is clicked
        document.getElementById("pag-btn").onclick = function() {
            window.location.href = "tests/Depression/test.html";
        };
        document.getElementById("anx-btn").onclick = function() {
            window.location.href = "tests/anxiety/anxiety_test.html";
        };
        document.getElementById("adhd-btn").onclick = function() {
            window.location.href = "tests/adhd/adhd_test.html";
        };
        document.getElementById("stress-btn").onclick = function() {
            window.location.href = "tests/stress/stress.html";
        };
    </script>
</body>
</html>
