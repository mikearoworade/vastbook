<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__. '/../config/database.php');
require_once(__DIR__. '/../models/Category.php');

if(((!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false)) && $_SESSION["role"] !== 'admin'){
    $url = BASE_URL;
    header("Location: $url");
    exit;
}

// Initiaze the database connection
$database = new Database($conn);
$db = $database->connect();

// Create an Category instance
$categoryModel = new Category($db);

$url = BASE_URL . '/views/admin/categories/index.php';

// Fetch all authors
$categories = $categoryModel->getAllcategories();

// CREATE Category
if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST['create'])) {
    $_SESSION['categoryname'] = $categoryName = trim($_POST['categoryname']);

    // Validation for Name
    if (empty($categoryName)) {
        $_SESSION['error'] = "Name is required.";
        header( "Location: $url");
        return;
    }

    $categoryExist = $categoryModel->checkCategoryExist($categoryName);
    if ($categoryExist){
        $_SESSION['error'] = "Category already exists.";
        header("Location: $url");
        return;
    } else {
        $categoryModel->addCategory($categoryName);
        $_SESSION['success'] = "Category added successfully.";
        header("Location: $url");
        return;
    }
}

// EDIT Category
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    // Retrieve inputs
    $_SESSION['categoryIdEdit'] = $id = $_POST['id'];
    $_SESSION['categorynameEdit'] = $categoryName = trim($_POST['categoryname']);

    // Validation for Name
    if (empty($categoryName)) {
        $_SESSION['error'] = "Name is required.";
        header( "Location: $url");
        return;
    }

    $categoryExistAndNotID = $categoryModel->checkCategoryExistAndNotID($categoryName, $id);
    if ($categoryExistAndNotID) {
        $_SESSION['errorEdit'] = "Category already exists.";
        header("Location: $url");
        return;
    } else {
        $categoryModel->updateCategory($categoryName, $id);
        $_SESSION['success'] = "Category updated successfully.";
        header("Location: $url");
        return;
    }
}

// DELETE Category
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    // Retrieve inputs
    $_SESSION['categoryIdDelete'] = $id = $_POST['id'];

    if ($categoryModel->deleteCategory($id)) {
        $_SESSION['successDelete'] = "Category Deleted successfully.";
        header("Location: $url");
        return;
    }
    else {
        $_SESSION['successDelete'] = "Failed to delete the category.";
        header("Location: index.php");
        return;
    }
}

?>
