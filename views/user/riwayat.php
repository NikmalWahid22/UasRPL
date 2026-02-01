<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Peminjaman</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="d-flex min-vh-100">

    <!-- Sidebar -->
    <?php require_once BASE_PATH . '/app/views/layout/sidebar.php'; ?>

    <!-- Konten -->
    <div class="flex-grow-1 p-4 main-content riwayat-page">

        <div class="container-fluid">

            <button class="btn btn-outline-secondary d-lg-none mb-3"
                onclick="toggleSidebar()">
                ☰ Menu
            </button>

            <h4 class="fw-bold mb-1">Riwayat Peminjaman</h4>
            <p class="text-muted mb-4">
                Daftar seluruh peminjaman buku yang pernah Anda lakukan
            </p>

            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if (empty($data)) : ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            Belum ada riwayat peminjaman
                                        </td>
                                    </tr>
                                <?php else : ?>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data as $row) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= htmlspecialchars($row['judul_buku']) ?></td>
                                            <td><?= date('d M Y', strtotime($row['tanggal_pinjam'])) ?></td>
                                            <td>
                                                <?= $row['tanggal_kembali']
                                                    ? date('d M Y', strtotime($row['tanggal_kembali']))
                                                    : '-' ?>
                                            </td>
                                            <td>
                                                <?php if ($row['status'] === 'disetujui') : ?>
                                                    <span class="badge bg-primary">Disetujui</span>
                                                <?php elseif ($row['status'] === 'ditolak') : ?>
                                                    <span class="badge bg-danger">Ditolak</span>
                                                <?php elseif ($row['status'] === 'selesai') : ?>
                                                    <span class="badge bg-success">Selesai</span>
                                                <?php else : ?>
                                                    <span class="badge bg-warning text-dark">Menunggu</span>
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

</div>

<script>
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('active');
    }
</script>

</body>
</html>
