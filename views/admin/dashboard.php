<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="d-flex">

<?php require_once BASE_PATH .  '/app/views/layout/sidebar_admin.php'; ?>

<div class="flex-grow-1 p-4 main-content">

<h4 class="fw-bold mb-4">Dashboard Admin</h4>

<div class="row g-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6>Total Buku</h6>
                <h4><?= $totalBuku ?></h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6>Total Anggota</h6>
                <h4><?= $totalUser ?></h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6>Peminjaman Aktif</h6>
                <h4><?= $peminjamanAktif ?></h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6>Denda Belum Lunas</h6>
                <h4>Rp <?= number_format($totalDenda,0,',','.') ?></h4>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</body>
</html>
