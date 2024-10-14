<?php
$servername = "localhost"; // Change if your database server is different
$username = "root"; // Replace with your database username
$password = '3caQ.="hA@eJGtk'; // Replace with your database password
$dbname = "projekt"; // Your database name

define('GOOGLE_CLIENT_ID', 'Insert_Google_Client_ID');
define('GOOGLE_CLIENT_SECRET', 'Insert_Google_Client_Secret');
define('GOOGLE_REDIRECT_URL', 'Callback_URL');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>