<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Buku</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-light">

<div class="d-flex min-vh-100">

    <!-- SIDEBAR -->
    <?php require_once BASE_PATH . '/app/views/layout/sidebar.php'; ?>

    <!-- MAIN CONTENT -->
   <div class="flex-grow-1 p-4 main-content"> 

         <div class="container"> 
                    <button class="btn btn-outline-secondary d-lg-none mb-3"
                onclick="toggleSidebar()">
            ☰ Menu
            </button>

        <div class="container">

            <!-- Header -->
            <div class="mb-4">
                <h3 class="fw-bold">Katalog Buku</h3>
                <p class="text-muted mb-0">
                    Temukan dan lihat ketersediaan buku
                </p>
            </div>

            <!-- Search --> 
           <form method="GET" action="index.php">
                <input type="hidden" name="url" value="katalog">

                <div class="row mb-4">
                    <div class="col-md-6">
                        <input type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Cari judul atau penulis..."
                            value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
                    </div>
                </div>
            </form>

            <!-- Katalog Buku -->
            <div class="row g-4">

                <?php if (empty($buku)) : ?>
                    <div class="col-12">
                        <div class="alert alert-warning">
                            Tidak ada buku tersedia.
                        </div>
                    </div>
                <?php endif; ?>

                <?php foreach ($buku as $item) : ?>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0">

                            <div class="card-body">
                                <h5 class="fw-semibold">
                                    <?= htmlspecialchars($item['judul']) ?>
                                </h5>

                                <p class="text-muted mb-1">
                                    <i class="fas fa-user"></i>
                                    <?= htmlspecialchars($item['penulis']) ?>
                                </p>

                                <span class="badge 
                                    <?= $item['stok'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $item['stok'] > 0 ? 'Tersedia' : 'Habis' ?>
                                </span>
                            </div>

                            <div class="card-footer bg-white border-0">
                            <form action="index.php?url=pinjam" method="POST">
                                <input type="hidden" name="id_buku" value="<?= $item['id_buku'] ?>">

                                <button type="submit"
                                    class="btn btn-outline-primary btn-sm w-100"
                                    <?= $item['stok'] == 0 ? 'disabled' : '' ?>>
                                    <i class="fas fa-book"></i> Pinjam Buku
                                </button>
                            </form>
                        </div>



                        </div>
                    </div>
                <?php endforeach; ?>

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
