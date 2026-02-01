<?php
require_once BASE_PATH . '/config/database.php';

class DetailPeminjaman {

    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function create($id_peminjaman, $id_buku, $jumlah) {
        $stmt = $this->db->prepare(
            "INSERT INTO detail_peminjaman 
             (id_peminjaman, id_buku, jumlah)
             VALUES (?, ?, ?)"
        );
        return $stmt->execute([$id_peminjaman, $id_buku, $jumlah]);
    }

    public function getByPeminjaman($id_peminjaman) {
        $stmt = $this->db->prepare(
            "SELECT d.*, b.judul 
             FROM detail_peminjaman d
             JOIN buku b ON d.id_buku = b.id_buku
             WHERE d.id_peminjaman = ?"
        );
        $stmt->execute([$id_peminjaman]);
        return $stmt->fetch();
    }
}
