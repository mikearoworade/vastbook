<?php
class Author {
    private $conn; // Database connection

    public function __construct($db) {
        $this->conn = $db;
    }

    // public function getAllAuthors($limit, $offset) {
    //     try {
    //         $sql = "SELECT * FROM authors ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    //         $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    //         $stmt->execute();
    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     } catch (PDOException $e) {
    //         echo "Error: " . $e->getMessage();
    //         return [];
    //     }
    // }

    public function getAllAuthors() {
        try {
            $sql = "SELECT * FROM authors ORDER BY created_at DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Return all results as an associative array

            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function checkAuthorExist($email) {
        try {
            $sql = "SELECT COUNT(*) FROM authors WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            if($stmt->fetchColumn() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function addAuthour($firstname, $lastname, $email, $bio, $image){
        try {
            $sql = "INSERT INTO authors(firstname, lastname, email, bio, image) 
            VALUES(:firstname, :lastname, :email, :bio, :imagepath)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
            $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
            $stmt->bindParam(':imagepath', $image, PDO::PARAM_STR);
            $stmt->execute();
            $lastInsertId = $this->conn->lastInsertId();
    
            if ($lastInsertId) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function getAuthorById($id) {
        try {
            $sql = "SELECT * FROM authors WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
}
?>