
<!DOCTYPE html>
<html lang="en">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Warisan Decode</title>
  <link rel="stylesheet" href="style.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body class="rules-page">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Warisan Decode</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto">
            <a class="nav-link active" aria-current="page" href="maps-leaflet.html">Home</a>
            <a class="nav-link" href="rules.html">Rules</a>
            <a class="nav-link" href="profile.php">Achievements</a>
            <a class="nav-link" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </nav>
  
    <!-- ✅ Move scroll content here -->
    <div class="scroll-container">
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
    </div>
      
  </body>
</html>  



