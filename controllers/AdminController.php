<?php
require_once BASE_PATH . '/app/models/User.php';
require_once BASE_PATH . '/app/models/Peminjaman.php';
require_once BASE_PATH . '/app/models/Buku.php';
require_once BASE_PATH . '/app/models/Denda.php';


class AdminController {

    private function authAdmin() {
        if (!isset($_SESSION['admin'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
    }

    /* ================= DASHBOARD ================= */

    public function dashboard() {
        $this->authAdmin();

        $totalBuku = (new Buku())->countAll();
        $totalUser = (new User())->countAll();
        $peminjamanAktif = (new Peminjaman())->countAktif();
        $totalDenda = (new Denda())->sumBelumLunas();

        require_once BASE_PATH .  '/app/views/admin/dashboard.php';
    }

    /* ================= ANGGOTA ================= */

    public function anggota() {
        $this->authAdmin();

        $anggota = (new User())->getAll();
        require BASE_PATH .'/app/views/admin/anggota.php';
    }

    public function tambahAnggota() {
        $this->authAdmin();
        require_once BASE_PATH . '/app/views/admin/anggota_form.php';
    }

    public function storeAnggota() {
        $this->authAdmin();

        (new User())->register($_POST);
        header("Location: index.php?url=admin/anggota");
        exit;
    }

    public function editAnggota($id) {
        $this->authAdmin();

        $anggota = (new User())->find($id);
        require_once BASE_PATH . '/app/views/admin/anggota_form.php';
    }

    public function updateAnggota($id) {
        $this->authAdmin();

        (new User())->update($id, $_POST);
        header("Location: " . BASE_URL . "/admin/anggota");
        exit;
    }

    public function aktifkanAnggota() {
        $this->authAdmin();

        (new User())->aktifkan($_GET['id']);
        header("Location: " . BASE_URL . "/admin/anggota");
        exit;
    }

    public function nonaktifkanAnggota() {
        $this->authAdmin();

        (new User())->nonaktifkan($_GET['id']);
        header("Location: " . BASE_URL . "/admin/anggota");
        exit;
    }


}
