<?php
require_once BASE_PATH . '/app/models/Peminjaman.php';
require_once BASE_PATH . '/app/models/DetailPeminjaman.php';
require_once BASE_PATH . '/app/models/Denda.php';
require_once BASE_PATH . '/app/models/Buku.php';


class PeminjamanController {

    public function index() {
        $this->authAdmin();
        $data = (new Peminjaman())->getAll();
        require_once BASE_PATH . '/app/views/admin/peminjaman.php';
    }

    public function store()
    {

        if (!isset($_SESSION['user']['id_user'])) {
        header("Location: " . BASE_URL . "/login");
            exit;
        }

        if (!isset($_POST['id_buku'])) {
            die("ID buku tidak ditemukan");
        }

        $id_user = $_SESSION['user']['id_user'];
        $id_buku = $_POST['id_buku'];
        $jumlah  = 1;

        require_once BASE_PATH . '/app/models/Buku.php';

        $bukuModel       = new Buku();
        $peminjamanModel = new Peminjaman();
        $detailModel     = new DetailPeminjaman();

        $buku = $bukuModel->find($id_buku);
        if (!$buku || $buku['stok'] < $jumlah) {
            die("Stok buku tidak mencukupi");
        }

        $id_peminjaman = $peminjamanModel->create($id_user);
        $detailModel->create($id_peminjaman, $id_buku, $jumlah);
        $bukuModel->kurangiStok($id_buku, $jumlah);

        header("Location: " . BASE_URL . "/riwayat");
        exit;
    }

    public function approve($id) {
        $this->authAdmin();
        $id = intval($id);
        (new Peminjaman())->approve($id, $_SESSION['admin']['id_admin']);
        header("Location: " . BASE_URL . "/peminjaman");
        exit;
    }

    public function reject($id) {
        $this->authAdmin();
        $id = intval($id);
        (new Peminjaman())->reject($id);
        header("Location: " . BASE_URL . "/peminjaman");
        exit;
    }

    public function selesai($id) {
        $this->authAdmin();

        $peminjamanModel = new Peminjaman();
        $dendaModel      = new Denda();

        $id = intval($id);
        $peminjaman = $peminjamanModel->find($id);

        if (!$peminjaman) {
            header("Location: " . BASE_URL . "/peminjaman");
            exit;
        }

        $tanggalKembali = date('Y-m-d');

        // Update status peminjaman
        $peminjamanModel->selesai($id);

        $dendaModel->hitungDanSimpan(
            $id,
            $peminjaman['tanggal_pinjam'],
            date('Y-m-d') // ini masih OK utk hitung
        );

        header("Location: " . BASE_URL . "/peminjaman");
        exit;
    }


    private function authAdmin() {
        if (!isset($_SESSION['admin']['id_admin'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
    }

    private function authUser() {
        if (!isset($_SESSION['user']['id_user'])) {
             header("Location: " . BASE_URL . "/login");
            exit;
        }
    }

    public function getLaporanByTanggal($awal, $akhir)
    {
        $sql = "
            SELECT 
                p.id_peminjaman,
                u.nama,
                b.judul,
                p.tanggal_pinjam,
                p.tanggal_kembali,
                p.status,
                p.denda
            FROM peminjaman p
            JOIN users u ON p.id_user = u.id_user
            JOIN buku b ON p.id_buku = b.id_buku
            WHERE p.tanggal_pinjam BETWEEN ? AND ?
            ORDER BY p.tanggal_pinjam DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$awal, $akhir]);
        return $stmt->fetchAll();
    }

}
