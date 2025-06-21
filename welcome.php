<?php
    $name = $_GET['name'] ?? "Traveler";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($name); ?>!</h1>
  <p>Let's begin your journey through Malaysia's cultural heritage!</p>
  <a href="maps-leaflet.html">Heritage Map</a>
  <a href="profile.php?name=<?php echo urlencode($name); ?>">Profile</a>
  <a href="logout.php">Logout</a>
</body>
</html>
