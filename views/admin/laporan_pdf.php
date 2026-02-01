<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Times New Roman; font-size: 11px; }
        h3 { text-align: center; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 4px;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>

<h3>LAPORAN PEMINJAMAN PERPUSTAKAAN</h3>
<p>Periode: <?= $awal ?> s/d <?= $akhir ?></p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Anggota</th>
            <th>Buku</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
            <th>Denda</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach ($data as $row): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama_anggota'] ?? '-' ?></td>
            <td><?= $row['judul_buku'] ?? '-' ?></td>
            <td><?= $row['tanggal_pinjam'] ?></td>
            <td><?= $row['tanggal_kembali'] ?? '-' ?></td>
            <td><?= ucfirst($row['status']) ?></td>
            <td>Rp <?= number_format($row['denda'] ?? 0,0,',','.') ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
