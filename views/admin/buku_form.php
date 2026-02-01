<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title><?= isset($buku) ? 'Edit Buku' : 'Tambah Buku' ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h4 class="fw-bold mb-3"><?= isset($buku) ? 'Edit Buku' : 'Tambah Buku' ?></h4>
    <a href="index.php?url=buku" class="btn btn-secondary mb-3">Kembali</a>

    <div class="card shadow-sm border-0">
        <div class="card-body">
               <form action="index.php?url=buku&action=<?= isset($buku) ? 'update' : 'store' ?>" method="POST">
                    <?php if (isset($buku)) : ?>
                        <input type="hidden" name="id_buku" value="<?= $buku['id_buku'] ?>">
                    <?php endif; ?>

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" required
                           value="<?= isset($buku) ? htmlspecialchars($buku['judul']) : '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-control" required
                           value="<?= isset($buku) ? htmlspecialchars($buku['penulis']) : '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" required
                           value="<?= isset($buku) ? htmlspecialchars($buku['penerbit']) : '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" class="form-control" required
                           value="<?= isset($buku) ? (int)$buku['tahun_terbit'] : date('Y') ?>" min="1900" max="<?= date('Y') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" required
                           value="<?= isset($buku) ? (int)$buku['stok'] : 0 ?>" min="0">
                </div>

                <button type="submit" class="btn btn-success"><?= isset($buku) ? 'Update' : 'Simpan' ?></button>
                <a href="index.php?url=buku" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
