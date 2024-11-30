<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__. '/../config/database.php');
require_once(__DIR__. '/../models/User.php');

// Initiaze the database connection
$database = new Database($conn);
$db = $database->connect();

// Create an Category instance
$userModel = new User($db);

$url = BASE_URL . '/index.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['logged_in'] !== true){
    $title = "Log in";
}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $_SESSION["role"] === "admin" ? 
        $url = BASE_URL . '/views/admin/' :
        $url = BASE_URL . '/views/user/';
    header("Location: $url");
}

// LOGIN USER
if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST['login'])) {
    // Collect and sanitize user inputs
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Both username and password are required.";
        header("Location: $url");
        return;
    } else {
        // check if user exist
        $userExist = $userModel->checkUserExist($email);
        if(!$userExist) {
            $_SESSION['error'] = "Incorrect email address or password";
            $_SESSION['email'] = $email;
            header("Location: $url");
            return;
        } else {
            $loginResult = $userModel->loginUser($email, $password);
            // Verify user exists and password matches
            if ($loginResult && password_verify($password, $loginResult['password'])) {
                // Set session variables for logged-in user
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $loginResult['id'];
                $_SESSION['email'] = $loginResult['email'];
                $_SESSION['role'] = $loginResult['rolename'];
                $_SESSION['username'] = $loginResult['username'];
                $_SESSION['image'] = $loginResult['image'];

                // Redirect to dashboard
                $_SESSION["role"] === "admin" ? 
                    $url = BASE_URL . '/views/admin/' :
                    $url = BASE_URL . '/views/user/';
                header("Location: $url");
                exit;
            } else {
                $_SESSION['error'] = "Invalid username or password.";
                $_SESSION['email'] = $email;
                header("Location: $url");
            }
        }
    }
}

?>