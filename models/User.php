<?php
class User {
    private $conn; // Database connection

    public function __construct($db) {
        $this->conn = $db;
    }

    public function checkUserExist($email) {
        // Check if category already exists
        try {
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
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

    public function loginUser($email, $password) {
        try {
            $sql = "
            SELECT 
                *,
                roles.rolename
            FROM 
                users
            INNER JOIN 
                roles
            ON 
                users.role_id = roles.id WHERE email = :email
        ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
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