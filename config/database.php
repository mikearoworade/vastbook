<?php
class Database {
    private $host;
    private $db;
    private $user;
    private $pass;
    private $charset;
    private $pdo;
    private $options = [
        PDO::ATTR_ERRMODE   => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  // Return results as associative arrays
        PDO::ATTR_EMULATE_PREPARES => false, // Use native prepared statements
    ];

    public function __construct(array $conn)
    {
        $this->host = $conn['host'];
        $this->db = $conn['db'];
        $this->user = $conn['user'];
        $this->pass = $conn['pass'];
        $this->charset = $conn['charset'];
    }

    public function connect() {
        if ($this->pdo === null)
        {
            $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
            try {
                $this->pdo = new PDO($dsn, $this->user, $this->pass, $this->options);
            }
            catch (PDOException $e) {
                // lOG Error instead instead of exposing sensitive information
                error_log("Database Connection Error: " . $e->getMessage());
                die("Database Connection Failed");

            }
        }

        return $this->pdo;
    }
}