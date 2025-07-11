<?php
session_start();
include 'db.php'; // database connection file

// Step 1: Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<p>⚠️ You must be logged in to collect a badge.</p>";
    exit;
}
require 'checkpoint3.html';

// Step 2: Get the user ID and badge name
$userId = $_SESSION['user_id'];
$badgeName = "duck_noodles"; // 🎯 this is the badge for checkpoint 1 (A Famosa)

// Step 3: Check if badge is already earned
$sqlCheck = "SELECT * FROM user_badges WHERE user_id = ? AND badge_name = ?";
$stmt = $conn->prepare($sqlCheck);
$stmt->bind_param("is", $userId, $badgeName);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // Step 4: Badge not earned yet, insert it
    $sqlInsert = "INSERT INTO user_badges (user_id, badge_name) VALUES (?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("is", $userId, $badgeName);
    $stmtInsert->execute();

    echo "<p>🎉 Congratulations! You have earned the <strong>'$badgeName'</strong> badge.</p>";
} else {
    echo "<p>✅ You already earned the <strong>'$badgeName'</strong> badge.</p>";
}
?>
