<?php
include 'db.php'; // Include the database connection

if (isset($_GET['query'])) {
    $searchTerm = $_GET['query'];

    // Prepare the SQL statement
    $stmt = $pdo->prepare("SELECT * FROM vsebina WHERE naslov LIKE :searchTerm LIMIT 10");
    $stmt->execute(['searchTerm' => '%' . $searchTerm . '%']);
    
    // Fetch the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Return results as JSON
    echo json_encode($results);
}
?>
