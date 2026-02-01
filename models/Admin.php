<?php
require_once BASE_PATH . '/config/database.php';

class Admin {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE email = ?");
        $stmt->execute([$email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin['password'])) {
            return $admin;
        }

        return false;
    }
}
