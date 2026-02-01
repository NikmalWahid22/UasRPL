<?php

class Database
{
    private $host = "localhost";
    private $db   = "perpustakaan";
    private $user = "root";
    private $pass = "";
    private $charset = "utf8mb4";

    public $conn;

    public function connect()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
            $this->conn = new PDO($dsn, $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $this->conn;
        } catch (PDOException $e) {
            die("Database Error: " . $e->getMessage());
        }
    }
}
