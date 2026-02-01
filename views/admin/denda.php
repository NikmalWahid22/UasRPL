<?php
// views/admin/denda.php
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Manajemen Denda</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="d-flex">
    <?php require_once BASE_PATH .  '/app/views/layout/sidebar_admin.php'; ?>

   <div class="flex-grow-1 p-4 main-content">
        <h4 class="fw-bold mb-4">Manajemen Denda</h4>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Judul Buku</th>
                                <th>Terlambat</th>
                                <th>Total Denda</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($denda)) : ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Tidak ada data denda</td>
                                </tr>
                            <?php else : ?>
                                <?php $no = 1; ?>
                                <?php foreach ($denda as $row) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($row['nama_anggota']) ?></td>
                                        <td><?= htmlspecialchars($row['judul_buku']) ?></td>
                                        <td><?= max(0, (int)$row['hari_terlambat']) ?> hari</td>
                                        <td>Rp <?= number_format($row['jumlah_denda'], 0, ',', '.') ?></td>
                                        <td>
                                            <?php if ($row['status_bayar'] === 'lunas') : ?>
                                                <span class="badge bg-success">Lunas</span>
                                            <?php else : ?>
                                                <span class="badge bg-danger">Belum Lunas</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($row['status_bayar'] !== 'lunas') : ?>
                                                <a href="index.php?url=denda&action=lunasi&id=<?= $row['id_denda'] ?>"
                                                   class="btn btn-sm btn-primary"
                                                   onclick="return confirm('Tandai denda ini sebagai lunas?')">
                                                    Lunasi
                                                </a>
                                            <?php else : ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
