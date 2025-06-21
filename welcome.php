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
  <a href="map.html">Go to Map</a>
  <a href="logout.php">Logout</a>
</body>
</html>
