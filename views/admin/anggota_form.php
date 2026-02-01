<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Form Anggota</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="d-flex">

<?php require_once BASE_PATH . '/app/views/layout/sidebar_admin.php'; ?>

<div class="flex-grow-1 p-4 main-content">

<h4 class="fw-bold mb-4">
    <?= isset($anggota) ? 'Edit Anggota' : 'Tambah Anggota' ?>
</h4>
<form method="post"
      action="index.php?url=anggota&action=<?= isset($anggota) ? 'update' : 'store' ?>">

<?php if (isset($anggota)) : ?>
    <input type="hidden" name="id" value="<?= $anggota['id_user'] ?>">
<?php endif; ?>

<div class="mb-3">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control"
           value="<?= $anggota['nama'] ?? '' ?>" required>
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control"
           value="<?= $anggota['email'] ?? '' ?>" required>
</div>

<?php if (!isset($anggota)) : ?>
<div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
</div>
<?php endif; ?>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="index.php?url=admin/anggota" class="btn btn-secondary">Kembali</a>

</form>


</div>
</div>
</body>
</html>
