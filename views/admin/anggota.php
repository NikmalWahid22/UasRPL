<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="d-flex">

<?php require_once BASE_PATH .  '/app/views/layout/sidebar_admin.php'; ?>

<div class="flex-grow-1 p-4 main-content">

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">
        <i class="bi bi-people"></i> Kelola Anggota
    </h4>

    <!-- TAMBAH -->
    <a href="index.php?url=anggota&action=create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Anggota
    </a>
</div>

<div class="card border-0 shadow-sm">
<div class="card-body">

<table class="table table-hover align-middle">
<thead class="table-light">
<tr>
    <th>#</th>
    <th>Nama</th>
    <th>Email</th>
    <th>Status</th>
    <th width="260">Aksi</th>
</tr>
</thead>

<tbody>
<?php foreach ($anggota as $i => $a): ?>
<tr>
    <td><?= $i + 1 ?></td>
    <td><?= htmlspecialchars($a['nama']) ?></td>
    <td><?= htmlspecialchars($a['email']) ?></td>
    <td>
        <?= $a['status_aktif']
            ? '<span class="badge bg-success">Aktif</span>'
            : '<span class="badge bg-danger">Nonaktif</span>' ?>
    </td>

    <td class="d-flex gap-1">

        <!-- EDIT -->
        <a href="index.php?url=anggota&action=edit&id=<?= $a['id_user'] ?>"
           class="btn btn-sm btn-warning">
            <i class="bi bi-pencil"></i>
        </a>

        <!-- HAPUS -->
        <a href="index.php?url=anggota&action=delete&id=<?= $a['id_user'] ?>"
           class="btn btn-sm btn-dark"
           onclick="return confirm('Hapus anggota ini?')">
            <i class="bi bi-trash"></i>
        </a>

        <!-- AKTIF / NONAKTIF -->
        <?php if ($a['status_aktif']): ?>
            <a href="index.php?url=admin/anggota-nonaktifkan&id=<?= $a['id_user'] ?>"
               class="btn btn-sm btn-danger">
                <i class="bi bi-x-circle"></i>
            </a>
        <?php else: ?>
            <a href="index.php?url=admin/anggota-aktifkan&id=<?= $a['id_user'] ?>"
               class="btn btn-sm btn-success">
                <i class="bi bi-check-circle"></i>
            </a>
        <?php endif; ?>

    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>
</div>

</div>
</div>
</body>
</html>
