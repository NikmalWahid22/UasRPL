<?php
require_once BASE_PATH . '/app/models/Buku.php';

class BukuController {

    private function auth() {
        if (!isset($_SESSION['admin']['id_admin'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
    }

    public function index() {
        $this->auth();
        $buku = (new Buku())->all();
        require_once BASE_PATH . '/app/views/admin/buku.php';
    }

    public function create() {
        $this->auth();
        require_once BASE_PATH . '/app/views/admin/buku_form.php';
    }

    public function store() {
        $this->auth();
        $buku = new Buku();
        $buku->create($_POST);
        header("Location: " . BASE_URL . "/buku");
        exit;
    }

    public function edit($id) {
        $this->auth();
        $id = intval($id);
        $buku = (new Buku())->find($id);
        require_once BASE_PATH . '/app/views/admin/buku_form.php';
    }

    public function update() {
        $this->auth();

        if (!isset($_POST['id_buku'])) {
            die('ID buku tidak ditemukan');
        }

        $id = intval($_POST['id_buku']);

        $buku = new Buku();
        $buku->update($id, $_POST);

       header("Location: " . BASE_URL . "/buku");
        exit;
    }

    public function delete($id) {
        $this->auth();
        $id = intval($id);
        $buku = new Buku();
        $buku->delete($id);
       header("Location: " . BASE_URL . "/buku");
        exit;
    }
}
