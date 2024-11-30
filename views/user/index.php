<?php
require_once(__DIR__ . '/../../config/config.php');
require_once(__DIR__ . '/../../config/database.php');

// Initiaze the database connection
$db = new Database($conn);
$pdo = $db->connect();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false){
    $url = BASE_URL;
    header("Location: $url");
    exit;
}

$title = "Welcome";
include(ROOT_PATH . '/shared/header.php');

?>


<?php 
include(ROOT_PATH . '/shared/footer.php');
?>
