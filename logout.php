<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to login.php or index.php
header("Location: login.php"); // Change to "index.php" if you want to redirect to the home page
exit();
?>
