<?php
require_once BASE_PATH . '/config/database.php';

class Buku {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function all() {
        return $this->db->query("SELECT * FROM buku")->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM buku WHERE id_buku = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare(
            "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, stok)
             VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['judul'],
            $data['penulis'],
            $data['penerbit'],
            $data['tahun_terbit'],
            $data['stok']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare(
            "UPDATE buku SET judul=?, penulis=?, penerbit=?, tahun_terbit=?, stok=?
             WHERE id_buku=?"
        );
        return $stmt->execute([
            $data['judul'],
            $data['penulis'],
            $data['penerbit'],
            $data['tahun_terbit'],
            $data['stok'],
            $id
        ]);
    }

    public function search($keyword)
    {
        $sql = "SELECT * FROM buku
                WHERE judul LIKE :keyword
                OR penulis LIKE :keyword";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':keyword', "%$keyword%");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function countAll() {
        $sql = "SELECT COUNT(*) as total FROM buku";
        return $this->db->query($sql)->fetch()['total'] ?? 0;
    }


    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM buku WHERE id_buku = ?");
        return $stmt->execute([$id]);
    }

    public function kurangiStok($id, $jumlah) {
        $stmt = $this->db->prepare(
            "UPDATE buku SET stok = stok - ? WHERE id_buku = ? AND stok >= ?"
        );
        return $stmt->execute([$jumlah, $id, $jumlah]);
    }
}
