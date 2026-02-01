<?php

require_once BASE_PATH . '/app/controllers/AuthController.php';
require_once BASE_PATH . '/app/controllers/AdminController.php';
require_once BASE_PATH . '/app/controllers/UserController.php';
require_once BASE_PATH . '/app/controllers/BukuController.php';
require_once BASE_PATH . '/app/controllers/PeminjamanController.php';
require_once BASE_PATH . '/app/controllers/LaporanController.php';
require_once BASE_PATH . '/app/controllers/DendaController.php';

$url    = $_GET['url'] ?? 'login';
$action = $_GET['action'] ?? null;


switch ($url) {

    /* ================= AUTH ================= */
    case 'login':
        (new AuthController())->login();
        break;

    case 'register':
        (new AuthController())->register();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;

    /* ================= ADMIN ================= */
    case 'admin':
        (new AdminController())->dashboard();
        break;

    case 'buku':
        $controller = new BukuController();
        switch ($action) {
            case 'create':
                $controller->create();
                break;
            case 'store':
                $controller->store();
                break;
            case 'edit':
                $controller->edit($_GET['id'] ?? null);
                break;
            case 'update':
                $controller->update($_POST['id'] ?? null);
                break;
            case 'delete':
                $controller->delete($_GET['id'] ?? null);
                break;
            default:
                $controller->index();
        }
        break;

    case 'peminjaman':
    $controller = new PeminjamanController();
    switch ($action) {
        case 'approve':
            $controller->approve($_GET['id'] ?? null);
            break;

        case 'reject':
            $controller->reject($_GET['id'] ?? null);
            break;

        case 'selesai':
            $controller->selesai($_GET['id'] ?? null);
            break;

        default:
            $controller->index();
    }
    break;


    case 'admin/laporan':
        (new LaporanController())->index();
        break;

    case 'admin/anggota':
        (new AdminController())->anggota();
        break;

    case 'admin/anggota-aktifkan':
        (new AdminController())->aktifkanAnggota();
        break;

    case 'admin/anggota-nonaktifkan':
        (new AdminController())->nonaktifkanAnggota();
        break;
    
    case 'admin/laporan/exportLaporanPdf':
    (new LaporanController())->exportLaporanPdf();
    break;



    case 'anggota':
    $controller = new AdminController();
    switch ($action) {
        case 'create':
            $controller->tambahAnggota();
            break;
        case 'store':
            $controller->storeAnggota();
            break;
        case 'edit':
            $controller->editAnggota($_GET['id'] ?? null);
            break;
        case 'update':
            $controller->updateAnggota($_POST['id'] ?? null);
            break;
        case 'delete':
            $controller->hapusAnggota($_GET['id'] ?? null);
            break;
        default:
            $controller->anggota();
    }
    break;



    /* ================= USER ================= */
    case 'user':
        (new UserController())->dashboard();
        break;

    case 'katalog':
        (new UserController())->katalog();
        break;

    case 'pinjam':
        (new PeminjamanController())->store();
        break;

    case 'riwayat':
        (new UserController())->riwayat();
        break;

    case 'denda':
        $controller = new DendaController();

        if ($action === 'lunasi') {
            $controller->lunasi($_GET['id']);
        } else {
            $controller->index();
        }
        break;

    /* ================= DEFAULT ================= */
    default:
        http_response_code(404);
        echo "404 - Halaman tidak ditemukan";
        break;
}
