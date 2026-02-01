<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
</head>

<body class="bg-light">

<div class="d-flex min-vh-100">

    <!-- SIDEBAR -->
    <?php require BASE_PATH . '/app/views/layout/sidebar.php'; ?>

    <!-- MAIN CONTENT -->
    <div class="flex-grow-1 p-4 main-content">

            <div class="container"> 
                    <button class="btn btn-outline-secondary d-lg-none mb-3"
                onclick="toggleSidebar()">
            ☰ Menu
            </button>

            <!-- Header -->
            <div class="mb-4">
                <h3 class="fw-bold">Hai, Selamat Datang</h3>
                <p class="text-muted mb-0">
                    Selamat datang di Sistem Informasi Perpustakaan
                </p>
            </div>

            <!-- Statistik -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-book fs-3 text-primary me-3"></i>
                            <div>
                                <h6 class="mb-0">Total Buku</h6>
                                <small class="text-muted"><?= $totalBuku ?> Buku</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-book-reader fs-3 text-success me-3"></i>
                            <div>
                                <h6 class="mb-0">Sedang Dipinjam</h6>
                                <small class="text-muted"><?= $dipinjam ?> Buku</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-money-bill-wave fs-3 text-danger me-3"></i>
                            <div>
                                <h6 class="mb-0">Total Denda</h6>
                                <small class="text-muted">
                                    Rp <?= number_format($totalDenda) ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tentang Perpustakaan -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="fw-semibold mb-2">
                        <i class="fas fa-info-circle me-2 text-primary"></i>
                        Tentang Perpustakaan
                    </h5>
                    <p class="text-muted mb-0">
                        Sistem Informasi Perpustakaan ini digunakan untuk membantu pengguna
                        dalam mengakses katalog buku, memantau status peminjaman,
                        serta meningkatkan efisiensi layanan perpustakaan secara digital.
                    </p>
                </div>
            </div>

            <!-- Informasi & Aturan -->
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h6 class="fw-semibold mb-2">
                                <i class="fas fa-bullhorn me-2 text-success"></i>
                                Informasi
                            </h6>
                            <p class="text-muted mb-0">
                                Gunakan menu katalog untuk mencari buku, melihat detail ketersediaan,
                                serta mengajukan peminjaman secara online.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h6 class="fw-semibold mb-2">
                                <i class="fas fa-clipboard-list me-2 text-warning"></i>
                                Aturan Singkat
                            </h6>
                            <ul class="text-muted mb-0 ps-3">
                                <li>Maksimal peminjaman sesuai kebijakan perpustakaan</li>
                                <li>Durasi peminjaman dibatasi waktu tertentu</li>
                                <li>Keterlambatan dapat dikenakan denda</li>
                            </ul>
                        </div>
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
