<?php
require_once BASE_PATH . '/config/database.php';

class Denda {

    private $db;

    const BATAS_HARI  = 7;
    const TARIF_DENDA = 10000; 

    public function __construct() {
        $this->db = (new Database())->connect();
    }


    public function hitungDanSimpan($id_peminjaman, $tanggal_pinjam, $tanggal_kembali) {

        $pinjam  = new DateTime($tanggal_pinjam);
        $kembali = new DateTime($tanggal_kembali);

        $lamaPinjam = $pinjam->diff($kembali)->days;

        if ($lamaPinjam > self::BATAS_HARI) {

            $hariTerlambat = $lamaPinjam - self::BATAS_HARI;
            $jumlahDenda   = $hariTerlambat * self::TARIF_DENDA;

            $stmt = $this->db->prepare("
                INSERT INTO denda (id_peminjaman, jumlah_denda, status_bayar)
                VALUES (?, ?, 'belum')
            ");

            $stmt->execute([$id_peminjaman, $jumlahDenda]);

            return $jumlahDenda;
        }

        return 0;
    }


    public function getByPeminjaman($id_peminjaman) {
        $stmt = $this->db->prepare(
            "SELECT * FROM denda WHERE id_peminjaman = ?"
        );
        $stmt->execute([$id_peminjaman]);
        return $stmt->fetch();
    }

    public function lunasi($id_denda) {
        $stmt = $this->db->prepare(
            "UPDATE denda SET status_bayar = 'lunas' WHERE id_denda = ?"
        );
        return $stmt->execute([$id_denda]);
    }

    public function sumBelumLunas() {
        $sql = "SELECT COALESCE(SUM(jumlah_denda), 0) AS total
                FROM denda
                WHERE status_bayar = 'belum'";

        $result = $this->db->query($sql)->fetch();
        return $result['total'];
    }

    

    public function totalDendaUser($id_user) {
        $stmt = $this->db->prepare(
            "SELECT COALESCE(SUM(jumlah_denda),0)
            FROM denda d
            JOIN peminjaman p ON d.id_peminjaman = p.id_peminjaman
            WHERE p.id_user = ? AND d.status_bayar = 'belum'"
        );
        $stmt->execute([$id_user]);
        return $stmt->fetchColumn();
    }

}
