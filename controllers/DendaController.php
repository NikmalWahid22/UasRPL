<?php
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/app/models/Denda.php';

class DendaController {

    private function authAdmin() {
        if (!isset($_SESSION['admin'])) {
           header("Location: " . BASE_URL . "/login");
            exit;
        }
    }

    /* ================= ADMIN ================= */

    public function index() {
        $this->authAdmin();

        $db = (new Database())->connect();

        $denda = $db->query("
            SELECT 
                d.id_denda,
                d.jumlah_denda,
                d.status_bayar,
                u.nama AS nama_anggota,
                b.judul AS judul_buku,
                (DATEDIFF(p.tanggal_kembali, p.tanggal_pinjam) - 7) AS hari_terlambat
            FROM denda d
            JOIN peminjaman p ON d.id_peminjaman = p.id_peminjaman
            JOIN users u ON p.id_user = u.id_user
            JOIN detail_peminjaman dp ON dp.id_peminjaman = p.id_peminjaman
            JOIN buku b ON dp.id_buku = b.id_buku
            ORDER BY d.id_denda DESC
        ")->fetchAll();


        require_once BASE_PATH . '/app/views/admin/denda.php';
    }

    public function lunasi($id_denda) {
        $this->authAdmin();

        (new Denda())->lunasi($id_denda);

        header("Location: " . BASE_URL . "/denda");
        exit;
    }
}
