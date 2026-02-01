<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="d-flex">

    <!-- Sidebar Admin -->
    <?php require_once BASE_PATH .  '/app/views/layout/sidebar_admin.php'; ?>

    <!-- Konten Utama -->
    <div class="flex-grow-1 p-4 main-content">

        <!-- Header / Judul & Tombol Tambah -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Daftar Buku</h4>
            <a href="index.php?url=buku&action=create" class="btn btn-primary">Tambah Buku</a>
        </div>

        <!-- Card Table Buku -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($buku)) : ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">
                                        Belum ada data buku
                                    </td>
                                </tr>
                            <?php else : ?>
                                <?php $no = 1; ?>
                                <?php foreach ($buku as $row) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($row['judul']) ?></td>
                                        <td><?= htmlspecialchars($row['penulis']) ?></td>
                                        <td><?= htmlspecialchars($row['penerbit']) ?></td>
                                        <td><?= (int)$row['tahun_terbit'] ?></td>
                                        <td><?= (int)$row['stok'] ?></td>
                                        <td>
                                            <a href="index.php?url=buku&action=edit&id=<?= $row['id_buku'] ?>" 
                                               class="btn btn-sm btn-warning">
                                                Edit
                                            </a>
                                            <a href="index.php?url=buku&action=delete&id=<?= $row['id_buku'] ?>" 
                                               class="btn btn-sm btn-danger" 
                                               onclick="return confirm('Yakin hapus buku ini?')">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div> <!-- tutup konten utama -->

</div> <!-- tutup d-flex -->

<!-- Footer & JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
