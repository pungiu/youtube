<?php
$servername = "localhost"; // Change if your database server is different
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "projekt"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->close();
?>
