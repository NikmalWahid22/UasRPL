<?php
require_once BASE_PATH . '/config/database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    /* =========================
       AUTH
    ========================= */

    public function register($data) {
        $stmt = $this->db->prepare(
            "INSERT INTO users (nama, email, password, status_aktif)
             VALUES (?, ?, ?, 1)"
        );

        return $stmt->execute([
            $data['nama'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare(
            "SELECT * FROM users 
             WHERE email = ? AND status_aktif = 1"
        );
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    /* =========================
       DASHBOARD
    ========================= */

    public function countAll() {
        return $this->db
            ->query("SELECT COUNT(*) FROM users")
            ->fetchColumn();
    }

    /* =========================
       KELOLA ANGGOTA (ADMIN)
    ========================= */

    public function getAll() {
        return $this->db->query(
            "SELECT id_user, nama, email, status_aktif
             FROM users
             ORDER BY id_user DESC"
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function nonaktifkan($id) {
        $stmt = $this->db->prepare(
            "UPDATE users SET status_aktif = 0 WHERE id_user = ?"
        );
        return $stmt->execute([$id]);
    }

    public function aktifkan($id) {
        $stmt = $this->db->prepare(
            "UPDATE users SET status_aktif = 1 WHERE id_user = ?"
        );
        return $stmt->execute([$id]);
    }

    public function find($id) {
        $stmt = $this->db->prepare(
            "SELECT id_user, nama, email FROM users WHERE id_user = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare(
            "UPDATE users SET nama = ?, email = ? WHERE id_user = ?"
        );
        return $stmt->execute([
            $data['nama'],
            $data['email'],
            $id
        ]);
    }

}
