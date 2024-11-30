<?php
    // USERS
    function getTotalNumberOfUsers($pdo) {
        try {
            // SQL query to count users
            $sql = "SELECT COUNT(*) AS total_users FROM users";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
    
            // Fetch the count
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Return the count
            return $result['total_users'];
        } catch (PDOException $e) {
            // Handle exceptions
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function getFiveRecentRegisteredUsers($pdo) {
        try {
            // Query to get the 5 most recently registered users
            $sql = "SELECT firstname, lastname, username, email, image, created_at
                    FROM users 
                    ORDER BY created_at DESC 
                    LIMIT 5";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        
            // Fetch results
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $users;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    //CATEGORIES
    function getTotalNumberOfCategories($pdo){
        try {
            //sql to count categories
            $sql = "SELECT COUNT(*) AS total_categories FROM bookcategory";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            //Fetch the count
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['total_categories'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // AUTHORS
    function getTotalNumberOfAuthors($pdo){
        try {
            //sql to count categories
            $sql = "SELECT COUNT(*) AS total_authors FROM authors";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            //Fetch the count
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['total_authors'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    // BOOKS
    function getTotalNumberOfBooks($pdo){
        try {
            //sql to count categories
            $sql = "SELECT COUNT(*) AS total_books FROM books";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            //Fetch the count
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['total_books'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function getBooksReadCount($pdo) {
        try {
            // SQL query to count books with times_loaded > 0
            $sql = "SELECT COUNT(*) AS books_read FROM books WHERE times_loaded > 0";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
    
            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Return the count
            return $result['books_read'];
        } catch (PDOException $e) {
            // Handle exceptions
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
?>