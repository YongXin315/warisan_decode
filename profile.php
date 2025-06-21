<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "⚠️ Please log in to view your profile.";
    exit;
}

$userId = $_SESSION['user_id'];
$userName = $_SESSION['user_name']; // optional if you stored it

echo "<h2>👤 Welcome, $userName</h2>";
echo "<h3>🏅 Your Badge Collection</h3>";

// Fetch user's badges
$sql = "SELECT badge_name FROM user_badges WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$unlockedBadges = [];
while ($row = $result->fetch_assoc()) {
    $unlockedBadges[] = $row['badge_name'];
}

// Define all available badges
$allBadges = [
    'chicken_rice_ball',
    'nyonya_laksa',
    'duck_noodles',
    'fried_oyster_egg',
    'coconut_shake'
];

// Display badges
echo "<div style='display: flex; gap: 15px; flex-wrap: wrap;'>";
foreach ($allBadges as $badge) {
    $badgeImage = "assets/badges/{$badge}.png";
    $status = in_array($badge, $unlockedBadges) ? "" : "opacity: 0.2; filter: grayscale(100%);";
    echo "<div style='text-align: center;'>
            <img src='$badgeImage' alt='$badge' width='100' style='$status border-radius: 10px;'><br>
            <small>$badge</small>
          </div>";
}
echo "</div>";
?>
