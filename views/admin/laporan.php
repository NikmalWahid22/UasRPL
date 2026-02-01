<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Perpustakaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="d-flex">

    <?php require_once BASE_PATH .  '/app/views/layout/sidebar_admin.php'; ?>

    <div class="flex-grow-1 p-4 main-content">

        <h4 class="fw-bold mb-4">
            <i class="bi bi-file-earmark-text"></i> Laporan Perpustakaan
        </h4>

        <!-- FILTER -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="get" class="row g-3">

                    <input type="hidden" name="url" value="admin/laporan">

                    <div class="col-md-4">
                        <label class="form-label">Tanggal Awal</label>
                        <input type="date" name="awal" class="form-control"
                               value="<?= $_GET['awal'] ?? '' ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tanggal Akhir</label>
                        <input type="date" name="akhir" class="form-control"
                               value="<?= $_GET['akhir'] ?? '' ?>" required>
                    </div>

                    <div class="col-md-4 d-flex align-items-end gap-2">
                        <button class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Tampilkan
                        </button>

                        <?php if (isset($_GET['awal'])) : ?>
                           <a href="index.php?url=admin/laporan/exportLaporanPdf&awal=<?= $_GET['awal'] ?>&akhir=<?= $_GET['akhir'] ?>"
                            class="btn btn-danger w-100">
                                <i class="bi bi-filetype-pdf"></i> Export PDF
                            </a>

                        <?php endif; ?>
                    </div>

                </form>
            </div>
        </div>

        <!-- HASIL LAPORAN -->
        <?php if (isset($data)) : ?>
        <div class="row g-4">

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h6>Total Peminjaman</h6>
                        <h3 class="fw-bold"><?= $data['total_peminjaman'] ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h6>Total Pengembalian</h6>
                        <h3 class="fw-bold"><?= $data['total_kembali'] ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h6>Total Anggota</h6>
                        <h3 class="fw-bold"><?= $data['total_anggota'] ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h6>Total Buku</h6>
                        <h3 class="fw-bold"><?= $data['total_buku'] ?></h3>
                    </div>
                </div>
            </div>

        </div>
        <?php endif; ?>

        <?php if (!empty($data['detail'])) : ?>
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Detail Peminjaman</h5>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Anggota</th>
                                <th>Buku</th>
                                <th>Pinjam</th>
                                <th>Kembali</th>
                                <th>Status</th>
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data['detail'] as $row) : ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nama_anggota']) ?></td>
                                <td><?= htmlspecialchars($row['judul_buku']) ?></td>
                                <td><?= $row['tanggal_pinjam'] ?></td>
                                <td><?= $row['tanggal_kembali'] ?? '-' ?></td>
                                <td>
                                    <span class="badge bg-<?= $row['status']=='disetujui' ? 'warning' : 'success' ?>">
                                        <?= ucfirst($row['status']) ?>
                                    </span>
                                </td>
                                <td>Rp 0</td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
        <?php endif; ?>


    </div>
</div>
</body>
</html>
