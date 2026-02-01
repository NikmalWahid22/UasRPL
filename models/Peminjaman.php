<?php
require_once BASE_PATH . '/config/database.php';

class Peminjaman {

    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

     public function countAktif() {
        $sql = "SELECT COUNT(*) as total 
                FROM peminjaman 
                WHERE status IN ('menunggu','disetujui')";

        $result = $this->db->query($sql)->fetch();

        return $result['total'] ?? 0;
    }
   
    /* ================= ADMIN ================= */

    public function getAll() {
        return $this->db->query(
            "SELECT 
                p.*,
                u.nama AS nama_user,
                b.judul
            FROM peminjaman p
            JOIN users u ON p.id_user = u.id_user
            JOIN detail_peminjaman dp ON p.id_peminjaman = dp.id_peminjaman
            JOIN buku b ON dp.id_buku = b.id_buku
            ORDER BY p.id_peminjaman DESC"
        )->fetchAll();
    }


    public function find($id_peminjaman) {
        $stmt = $this->db->prepare(
            "SELECT * FROM peminjaman WHERE id_peminjaman = ?"
        );
        $stmt->execute([$id_peminjaman]);
        return $stmt->fetch();
    }

    public function approve($id_peminjaman, $id_admin) {
        $stmt = $this->db->prepare(
            "UPDATE peminjaman 
             SET status = 'disetujui', id_admin = ?
             WHERE id_peminjaman = ?"
        );
        return $stmt->execute([$id_admin, $id_peminjaman]);
    }

    public function reject($id_peminjaman) {
        $stmt = $this->db->prepare(
            "UPDATE peminjaman 
             SET status = 'ditolak' 
             WHERE id_peminjaman = ?"
        );
        return $stmt->execute([$id_peminjaman]);
    }

    public function selesai($id_peminjaman)
    {
        // ambil id buku
        $stmt = $this->db->prepare("
            SELECT id_buku 
            FROM detail_peminjaman 
            WHERE id_peminjaman = ?
        ");
        $stmt->execute([$id_peminjaman]);
        $data = $stmt->fetch();

        if (!$data) return false;

        // update peminjaman (tanggal dari DB)
        $stmt = $this->db->prepare("
            UPDATE peminjaman 
            SET status = 'selesai',
                tanggal_kembali = CURDATE()
            WHERE id_peminjaman = ?
        ");
        $stmt->execute([$id_peminjaman]);

        // stok balik
        $stmt = $this->db->prepare("
            UPDATE buku 
            SET stok = stok + 1 
            WHERE id_buku = ?
        ");
        return $stmt->execute([$data['id_buku']]);
    }


    /* ================= USER ================= */

    public function create($id_user) {
        $stmt = $this->db->prepare(
            "INSERT INTO peminjaman (id_user, tanggal_pinjam)
             VALUES (?, CURDATE())"
        );
        $stmt->execute([$id_user]);
        return $this->db->lastInsertId();
    }

    public function countDipinjamByUser($id_user) {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM peminjaman 
            WHERE id_user = ? 
            AND status IN ('menunggu','disetujui')"
        );
        $stmt->execute([$id_user]);
        return $stmt->fetchColumn();
    }



    public function byUser($id_user)
    {
        $stmt = $this->db->prepare("
            SELECT 
                p.id_peminjaman,
                p.tanggal_pinjam,
                p.tanggal_kembali,
                p.status,
                b.judul AS judul_buku
            FROM peminjaman p
            JOIN detail_peminjaman dp 
                ON p.id_peminjaman = dp.id_peminjaman
            JOIN buku b 
                ON dp.id_buku = b.id_buku
            WHERE p.id_user = ?
            ORDER BY p.id_peminjaman DESC
        ");
        $stmt->execute([$id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function countByTanggal($awal, $akhir)
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM peminjaman 
            WHERE tanggal_pinjam BETWEEN ? AND ?
        ");
        $stmt->execute([$awal, $akhir]);
        return $stmt->fetchColumn();
    }

    public function countKembaliByTanggal($awal, $akhir)
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM peminjaman 
            WHERE tanggal_kembali BETWEEN ? AND ?
        ");
        $stmt->execute([$awal, $akhir]);
        return $stmt->fetchColumn();
    }

    public function laporanDetail($awal, $akhir)
        {
            $sql = "
                SELECT 
                    u.nama AS nama_anggota,
                    b.judul AS judul_buku,
                    p.tanggal_pinjam,
                    p.tanggal_kembali,
                    p.status
                FROM peminjaman p
                JOIN users u ON p.id_user = u.id_user
                JOIN detail_peminjaman dp ON p.id_peminjaman = dp.id_peminjaman
                JOIN buku b ON dp.id_buku = b.id_buku
                WHERE p.tanggal_pinjam BETWEEN ? AND ?
                ORDER BY p.tanggal_pinjam DESC
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([$awal, $akhir]);
            return $stmt->fetchAll();
        }

}
