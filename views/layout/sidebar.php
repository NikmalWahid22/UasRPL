<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 260px;
        height: 100vh;
        background: #0b1f3a;
        border-right: 1px solid #0a1a30;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        z-index: 1000;
    }

    .main-content {
        margin-left: 260px;
        transition: all 0.3s ease;
    }

    /* TABLET & MOBILE */
    @media (max-width: 992px) {
        .sidebar {
            left: -260px; /* sembunyikan */
        }

        .sidebar.active {
            left: 0; /* tampil saat toggle */
        }

        .main-content {
            margin-left: 0;
        }
    }

    @media (max-width: 992px) {
    .riwayat-page {
        height: 100vh;
        overflow-y: auto;
    }
}


    .sidebar .brand {
        font-size: 1.2rem;
        font-weight: 600;
        padding: 20px;
        text-align: center;
        border-bottom: 1px solid #132b4f;
        color: #ffffff;
        letter-spacing: 0.3px;
    }

    .sidebar .menu a {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: #cfd8e3; /* teks abu terang */
        text-decoration: none;
        transition: all 0.2s ease;
        border-radius: 8px;
        margin: 5px 10px;
        font-weight: 500;
    }

    .sidebar .menu a i {
        margin-right: 12px;
        font-size: 1.1rem;
        color: #9fb4d9;
    }

    .sidebar .menu a:hover {
        background: #132b4f;
        color: #ffffff;
    }

    .sidebar .menu a:hover i {
        color: #ffffff;
    }

    .sidebar .menu a.active {
        background: #1f3c88; /* biru aktif */
        color: #ffffff;
        font-weight: 600;
        box-shadow: inset 3px 0 0 #4da3ff;
    }

    .sidebar .menu a.active i {
        color: #ffffff;
    }

    .sidebar .logout {
        margin-top: auto;
        padding: 15px;
    }

    .sidebar .logout a {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #132b4f;
        border: 1px solid #1f3c88;
        color: #ffffff;
        border-radius: 8px;
        padding: 10px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .sidebar .logout a:hover {
        background: #1f3c88;
        color: #ffffff;
    }

    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.4);
        z-index: 900;
    }

    .sidebar.active ~ .sidebar-overlay {
        display: block;
    }

</style>


<?php $current = $_GET['url'] ?? ''; ?>

<div class="sidebar d-flex flex-column"> 

    <button class="btn btn-sm btn-light d-lg-none m-3 align-self-end"
            onclick="toggleSidebar()">
            <i class="bi bi-x-lg"></i>
        </button>
    <div class="brand">
        One Library
    </div>

    <div class="menu mt-3">

        <a href="index.php?url=user"
           class="<?= $current === 'user' ? 'active' : '' ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="index.php?url=katalog"
           class="<?= $current === 'katalog' ? 'active' : '' ?>">
            <i class="bi bi-book"></i> Katalog
        </a>

        <a href="index.php?url=riwayat"
           class="<?= $current === 'riwayat' ? 'active' : '' ?>">
            <i class="bi bi-clock-history"></i> Riwayat
        </a>

    </div>

    <div class="logout mt-auto">
        <a href="index.php?url=logout">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </a>
    </div>
</div>
