<?php
require 'db.php';

// Get data from POST request
$name = $_POST['name'];
$password = $_POST['password'];

if ($name && $password) {
    // Step 1: Check if the name already exists
    $checkQuery = "SELECT * FROM users WHERE name = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $name);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
            alert('This name is already taken. Please enter a new name.');
            window.location.href = 'index.html';
        </script>";
    } else {
        // Step 2: Insert new user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO users (name, password) VALUES (?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("ss", $name, $hashedPassword);
        $insertStmt->execute();

        // Step 3: Redirect to welcome page
        header("Location: rules.html");
        exit();
    }
} else {
    echo "Please enter both name and password.";
}

?>
