<?php
require_once(__DIR__ . '/config/config.php');
require_once(__DIR__ . '/config/database.php');

// Initiaze the database connection
$db = new Database($conn);
$pdo = $db->connect();

//Example query
try {
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll();

    foreach($users as $user) {
        echo $user['username'] . '<br>';
    }
} catch (PDOException $e) {
    error_log("Query error: " . $e->getMessage());
    die("Failed to fetch users.");
}


?>