<?php
$host = "localhost";
$port = 3306;
$user = "root";
$pass = "root";
$dbname = "warisan_decode";

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>