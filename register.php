<?php
// Include database connection
include 'connect.php'; // Ensure this file contains your database connection settings

// Initialize a message variable
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $age = $_POST['age']; // Get the age input

    // Check if username or email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $message = "Error: Username or Email already exists!";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare an SQL statement for inserting the user
        $stmt = $conn->prepare("INSERT INTO users (username, password, email, phone, gender, age) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $hashed_password, $email, $phone, $gender, $age); // Bind age parameter

        // Execute the statement
        if ($stmt->execute()) {
            $message = "Registration successful! You can now <a href='login.php'>login here</a>.";
        } else {
            $message = "Error: " . $stmt->error;
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <input type="number" name="age" placeholder="Age" required min="1"> <!-- Age input -->
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <button type="submit">Register</button>
        </form>
        
        <!-- Display message -->
        <?php if ($message != ""): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <style>
        .message {
            margin-top: 15px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f0f8ff; /* Light blue background */
            color: #333; /* Dark text */
            border: 1px solid #b0c4de; /* Light blue border */
        }
    </style>
</body>
</html>
