<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__. '/../config/database.php');
require_once(__DIR__. '/../models/Author.php');

if(((!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false)) && $_SESSION["role"] !== 'admin'){
    $url = BASE_URL;
    header("Location: $url");
    exit;
}

// Initiaze the database connection
$database = new Database($conn);
$db = $database->connect();

$uploadpath  = '../assets/img/author/';
// Create an Author instance
$authorModel = new Author($db);

// Fetch all authors
$authors = $authorModel->getAllAuthors();

if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['create'])) {
    $_SESSION["authorfirstname"] = $firstname = trim($_POST['firstname']);
    $_SESSION["authorlastname"] = $lastname = trim($_POST['lastname']);
    $_SESSION["authoremail"] = $email = trim($_POST['email']);
    $_SESSION["authorbio"] = $bio = trim($_POST['bio']);
    
    $authorExist = $authorModel->checkAuthorExist($email);
    $url = BASE_URL . '/views/admin/authors/create.php';

    if($authorExist) {
        $_SESSION['error'] = "Email address already exist";
        header("Location: $url");
        return;
    } else {
        if(isset($_FILES['image']) && !empty($_FILES['image'])){
            // Handling Image Upload
            $imageFile = $_FILES['image'];
            $imageName = basename($imageFile['name']);
            $imageTmpPath = $imageFile['tmp_name'];
            $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

            $allowedImageTypes = ['jpeg', 'jpg', 'png'];

            // Validate and upload image file
            if (in_array($imageExtension, $allowedImageTypes)) {
                $newImageName = uniqid('img_', true) . '.' . $imageExtension;
                $imageDestination = $uploadpath  . $newImageName;

                if (move_uploaded_file($imageTmpPath, $imageDestination)) {
                    $addAuthorResult = $authorModel->addAuthour($firstname, $lastname, $email, $bio, $newImageName);
                } else {
                    $_SESSION['error'] = "Failed to uplaod Image";
                    // header("Location: $url");
                    // return;
                }
            }else {
                $_SESSION['error'] = "Only JPG, JPEG, and PNG files are allowed for the image.";
                header("Location: $url");
                return;
            }
        } else {
            $imageDestination = "";
            $addAuthorResult = $authorModel->addAuthour($firstname, $lastname, $email, $bio, $imageDestination);
        }
        
        if($addAuthorResult) {
            $url = BASE_URL . '/views/admin/authors/';
            $_SESSION['success'] = "Author Added Successfully";
            header("Location: $url");
            return;
        }
    }
}
?>