<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Buku</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="d-flex">

    <!-- Sidebar -->
    <?php require_once BASE_PATH . '/app/views/layout/sidebar.php'; ?>

    <!-- Konten -->
    <div class="flex-grow-1 p-4">

        <a href="index.php?url=katalog" class="text-decoration-none mb-3 d-inline-block">
            <i class="bi bi-arrow-left"></i> Kembali ke Katalog
        </a>

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <h4 class="fw-bold mb-3"><?= htmlspecialchars($buku['judul']) ?></h4>

                <table class="table table-borderless mb-4">
                    <tr>
                        <th width="180">Penulis</th>
                        <td><?= htmlspecialchars($buku['penulis']) ?></td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td><?= htmlspecialchars($buku['penerbit']) ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td><?= $buku['tahun_terbit'] ?></td>
                    </tr>
                    <tr>
                        <th>Stok Tersedia</th>
                        <td>
                            <?php if ($buku['stok'] > 0) : ?>
                                <span class="badge bg-success"><?= $buku['stok'] ?> Buku</span>
                            <?php else : ?>
                                <span class="badge bg-danger">Habis</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>

                <?php if ($buku['stok'] > 0) : ?>
                    <form method="POST" action="index.php?url=pinjam">
                        <input type="hidden" name="buku[<?= $buku['id_buku'] ?>]" value="1">
                        <button class="btn btn-primary">
                            <i class="bi bi-cart-plus"></i> Pinjam Buku
                        </button>
                    </form>
                <?php else : ?>
                    <button class="btn btn-secondary" disabled>
                        Buku tidak tersedia
                    </button>
                <?php endif; ?>

            </div>
        </div>

    </div>
</div>

</body>
</html>
