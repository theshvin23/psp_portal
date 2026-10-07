<?php

class Database {
    private $host = "localhost";
    private $db_name = "psp_portal";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("ALTER TABLE students ADD COLUMN IF NOT EXISTS profile_picture VARCHAR(255) NULL AFTER program");
        } catch (PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }
        return $this->conn;
    }
}
