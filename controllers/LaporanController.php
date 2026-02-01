<?php

require_once BASE_PATH . '/app/models/Peminjaman.php';
require_once BASE_PATH . '/app/models/User.php';
require_once BASE_PATH . '/app/models/Buku.php';

class LaporanController {

    private function authAdmin() {
        if (!isset($_SESSION['admin'])) {
          header("Location: " . BASE_URL . "/login");
            exit;
        }
    }

    public function index()
    {
        $this->authAdmin();

        $awal  = $_GET['awal']  ?? null;
        $akhir = $_GET['akhir'] ?? null;

        if ($awal && $akhir) {
            $peminjaman = new Peminjaman();

            $data = [
                'total_peminjaman' => $peminjaman->countByTanggal($awal, $akhir),
                'total_kembali'    => $peminjaman->countKembaliByTanggal($awal, $akhir),
                'total_anggota'    => (new User())->countAll(),
                'total_buku'       => (new Buku())->countAll(),
                'detail'           => $peminjaman->laporanDetail($awal, $akhir)
            ];
        }

        // VIEW WAJIB DIPANGGIL DI DALAM METHOD
        require_once BASE_PATH . '/app/views/admin/laporan.php';
    }

    public function exportLaporanPdf()
    {
        $this->authAdmin();

        require_once BASE_PATH . '/app/libraries/dompdf/autoload.inc.php';

        $awal  = $_GET['awal'] ?? '';
        $akhir = $_GET['akhir'] ?? '';

        $peminjaman = new Peminjaman();
        $data = $peminjaman->laporanDetail($awal, $akhir);

        ob_start();
        include '../app/views/admin/laporan_pdf.php';
        $html = ob_get_clean();

        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("laporan-perpustakaan.pdf", false);
    }

}
