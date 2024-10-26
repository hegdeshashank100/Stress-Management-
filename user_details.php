<?php
session_start();
include 'connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user details from database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .user-details-container {
    max-width: 600px;
    margin: 50px auto; /* Increased margin for better spacing */
    padding: 30px; /* Added padding for inner spacing */
    border: 1px solid #ddd;
    border-radius: 10px;
    background-color: #ffffff; /* Changed to white for better contrast */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

/* User details content */
.user-details {
    text-align: center;
}

.user-details img.profile-pic {
    display: block;
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin: 0 auto 20px auto; /* Added margin for better spacing */
    border: 3px solid #ddd;
}

.user-details h2 {
    font-size: 28px; /* Increased font size for prominence */
    color: #333;
    margin-bottom: 10px; /* Added margin for spacing */
}

.user-details p {
    font-size: 18px; /* Increased font size for better readability */
    color: #555;
    margin: 8px 0; /* Reduced vertical margin for better spacing */
}

/* Button Styling */
.btn {
    display: inline-block;
    padding: 10px 20px; /* Adjusted padding for better button size */
    font-size: 16px;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    margin: 10px; /* Margin between buttons */
    transition: background-color 0.3s; /* Added transition for hover effect */
}

.btn:hover {
    background-color: #0056b3; /* Darker shade on hover */
}
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Home</a>
            <h3><strong>User Details</strong></h3>
            <a href="logout.php">Logout</a> <!-- Added Logout Link -->
        </nav>
    </header>

    <div class="user-details-container">
        <div class="user-details">
            
            <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?></h2>
            <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
            <p>Age: <?php echo htmlspecialchars($user['age']); ?></p>
            <p>Joined on: <?php echo htmlspecialchars($user['created_at']); ?></p>
        </div>
        
        <!-- Additional buttons for updating profile or logging out -->
        <div class="user-actions">
            <a href="edit_profile.php" class="btn">Edit Profile</a> <!-- Link to Edit Profile -->
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </div>
</body>
</html>
