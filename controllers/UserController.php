<?php
require_once BASE_PATH . '/app/models/Buku.php';
require_once BASE_PATH . '/app/models/Peminjaman.php';
require_once BASE_PATH . '/app/models/Denda.php';

class UserController {

    private function auth() {
        if (!isset($_SESSION['user']['id_user'])) {
                   header("Location: " . BASE_URL . "/login");
            exit;
        }
    }

    public function dashboard() {
        $this->auth();

        $id_user = $_SESSION['user']['id_user'];

        $bukuModel       = new Buku();
        $peminjamanModel = new Peminjaman();
        $dendaModel      = new Denda();

        $totalBuku  = $bukuModel->countAll();
        $dipinjam   = $peminjamanModel->countDipinjamByUser($id_user);
        $totalDenda = $dendaModel->totalDendaUser($id_user);

        require_once BASE_PATH .  '/app/views/user/dashboard.php';
    }

    public function katalog() {
        $this->auth();

        $keyword = $_GET['keyword'] ?? '';

        if ($keyword) {
            $buku = (new Buku())->search($keyword);
        } else {
            $buku = (new Buku())->all();
        }

        require_once BASE_PATH . '/app/views/user/katalog.php';
    }

    public function riwayat() {
        $this->auth();
        $data = (new Peminjaman())->byUser($_SESSION['user']['id_user']);
        require_once BASE_PATH .  '/app/views/user/riwayat.php';
    }
}
