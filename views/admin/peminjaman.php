<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Permintaan Peminjaman</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="d-flex">
    <?php require_once BASE_PATH .  '/app/views/layout/sidebar_admin.php'; ?>

    <div class="flex-grow-1 p-4 main-content">
        <h4 class="fw-bold mb-4">Permintaan Peminjaman</h4>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama</th>
                                <th>Buku</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['nama_user']) ?></td>
                                <td><?= htmlspecialchars($p['judul']) ?></td>
                                <td>
                                    <?php if ($p['status'] === 'menunggu'): ?>
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    <?php elseif ($p['status'] === 'disetujui'): ?>
                                        <span class="badge bg-success">Disetujui</span>
                                    <?php elseif ($p['status'] === 'selesai'): ?>
                                        <span class="badge bg-secondary">Selesai</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if ($p['status'] === 'menunggu'): ?>
                                        <a href="index.php?url=peminjaman&action=approve&id=<?= $p['id_peminjaman'] ?>"
                                        class="btn btn-sm btn-success me-1">Setujui</a>

                                        <a href="index.php?url=peminjaman&action=reject&id=<?= $p['id_peminjaman'] ?>"
                                        class="btn btn-sm btn-danger">Tolak</a>

                                    <?php elseif ($p['status'] === 'disetujui'): ?>
                                        <a href="index.php?url=peminjaman&action=selesai&id=<?= $p['id_peminjaman'] ?>"
                                        class="btn btn-sm btn-primary"
                                        onclick="return confirm('Yakin buku sudah dikembalikan?')">
                                        Dikembalikan
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($data)): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada permintaan peminjaman</td>
                            </tr>
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
