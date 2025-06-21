<?php
require 'db.php';

$name = $_POST['name'];
$password = $_POST['password'];

if ($name && $password) {
    $sql = "SELECT * FROM users WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $hashedPassword = $user['password'];

        // Check if entered password matches hashed one
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $user['id'];  // Assuming your users table has 'id' column
            $_SESSION['user_name'] = $user['name']; // (Optional) can also store name
            header("Location: rules.html);
            exit();
        } else {
            echo "<script>
                alert('Incorrect password. Try again.');
                window.location.href = 'login.html';
            </script>";
        }
    } else {
        echo "<script>
            alert('Name not found. Please register first.');
            window.location.href = 'login.html';
        </script>";
    }
} else {
    echo "Please enter both name and password.";
}
?>
