<?php
session_start();
include 'connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user's progress data
$sql = "SELECT progress_value, progress_date FROM growth_tracker WHERE user_id = ? ORDER BY progress_date";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$progress_data = [];
while ($row = $result->fetch_assoc()) {
    $progress_data[] = $row;
}

// Debugging: Check if any data is retrieved
if (empty($progress_data)) {
    $no_data = true; // Flag to check if no data is available
} else {
    $no_data = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Growth Tracker</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <header>
        <h1>Growth Tracker</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="user_details.php">User Details</a>
        </nav>
    </header>

    <?php if ($no_data): ?>
        <p>No progress data found for this user.</p>
    <?php else: ?>
        <canvas id="growthChart"></canvas>
        <script>
            // Prepare data for the chart
            const progressData = <?php echo json_encode($progress_data); ?>;
            const labels = progressData.map(item => item.progress_date);
            const data = progressData.map(item => item.progress_value);

            // Create the chart
            const ctx = document.getElementById('growthChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Growth Progress',
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day'
                            }
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    <?php endif; ?>
</body>
</html>
