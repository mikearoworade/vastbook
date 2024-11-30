<?php
// Example usage
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    // Retrieve inputs
    $_SESSION['categoryIdDelete'] = $id = $_POST['id'];

    try {
         // Prepare the SQL DELETE query
        $sql = "DELETE FROM bookcategory WHERE id = :id";

        // Create a prepared statement
        $stmt = $pdo->prepare($sql);

        // Bind the ID parameter
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Execute the query
        if ($stmt->execute()) {
            $_SESSION['successDelete'] = "Category Deleted successfully.";
            header("Location: index.php");
            return;
        } else {
            $_SESSION['successDelete'] = "Failed to delete the category.";
            header("Location: index.php");
            return;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>