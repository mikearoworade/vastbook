<?php
class Category {
    private $conn; // Database connection

    public function __construct($db) {
        $this->conn = $db;
    }

    function getAllcategories() {
        try {
            $sql = "SELECT * FROM bookcategory";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Check if category exit
    public function checkCategoryExist($categoryName) {
        // Check if category already exists
        try {
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM bookcategory WHERE categoryname = :categoryname");
            $stmt->bindParam(':categoryname', $categoryName, PDO::PARAM_STR);
            $stmt->execute();
    
            if ($stmt->fetchColumn() > 0){
                return true;
            }else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Check if category exit and it's not ID
    public function checkCategoryExistAndNotID($categoryName, $id) {
        // Check if category already exists
        $stmt = "SELECT COUNT(*) FROM bookcategory WHERE categoryName = :categoryName AND id != :id";
        $stmt = $this->conn->prepare($stmt);
        $stmt->execute([':categoryName' => $categoryName, ':id' => $id]);

        if ($stmt->fetchColumn() > 0){
            return true;
        }else {
            return false;
        }
    }

    // Create Category
    public function addCategory($categoryName)
    {
        try {
            // // Insert new category
            $sql = "INSERT INTO bookcategory (categoryname) VALUES (:categoryname)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':categoryname', $categoryName, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Update Category
    public function updateCategory($categoryName, $id) {
        // Update the category
        try {
            $sqlUpdate = "UPDATE bookcategory SET categoryName = :categoryName WHERE id = :id";
            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            $stmtUpdate->execute([':categoryName' => $categoryName, ':id' => $id]);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteCategory($id) {
        try {
            // Prepare the SQL DELETE query
            $sql = "DELETE FROM bookcategory WHERE id = :id";
    
            // Create a prepared statement
            $stmt = $this->conn->prepare($sql);
    
            // Bind the ID parameter
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
            return true;
            } else {
            return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}
?>