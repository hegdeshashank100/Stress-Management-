<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize an array to store user responses
    $responses = array();

    // Loop to collect responses and check if all questions are answered
    for ($i = 1; $i <= 20; $i++) {
        if (isset($_POST['q'.$i])) {
            $responses[] = $_POST['q'.$i];  // Store the response if present
        } else {
            $responses[] = 0;  // Default to 0 if the question wasn't answered
        }
    }

    // Calculate the score (Max score: 60 since 20 questions * 3 max points)
    $total_score = array_sum($responses);
    $max_score = 60;
    $percentage = ($total_score / $max_score) * 100;
}
