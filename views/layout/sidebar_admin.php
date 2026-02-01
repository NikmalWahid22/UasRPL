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
    z-index: 1200;
    transition: left 0.3s ease;
}

/* MAIN CONTENT SHIFT */
.main-content {
    margin-left: 260px;
    transition: margin-left 0.3s ease;
}

/* TABLET & MOBILE */
@media (max-width: 992px) {
    .sidebar {
        left: -260px;
    }

    .sidebar.active {
        left: 0;
    }

    .main-content {
        margin-left: 0;
    }
}

/* BRAND */
.sidebar .brand {
    font-size: 1.2rem;
    font-weight: 600;
    padding: 20px;
    text-align: center;
    border-bottom: 1px solid #132b4f;
    color: #ffffff;
}

/* MENU */
.sidebar .menu a {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: #cfd8e3;
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
    background: #1f3c88;
    color: #ffffff;
    font-weight: 600;
    box-shadow: inset 3px 0 0 #4da3ff;
}

.sidebar .menu a.active i {
    color: #ffffff;
}

/* LOGOUT */
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
}
</style>

<?php $current = $_GET['url'] ?? ''; ?>

<div class="sidebar d-flex flex-column">
    <div class="brand">
        One Library (Admin)
    </div>

    <div class="menu mt-3">

        <a href="index.php?url=admin"
           class="<?= $current === 'admin' ? 'active' : '' ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="index.php?url=peminjaman"
           class="<?= $current === 'peminjaman' ? 'active' : '' ?>">
            <i class="bi bi-book-half"></i> Peminjaman
        </a>

        <a href="index.php?url=buku"
           class="<?= $current === 'buku' ? 'active' : '' ?>">
            <i class="bi bi-journal-bookmark"></i> Buku
        </a>

        <a href="index.php?url=admin/anggota"
           class="<?= $current === 'admin/anggota' ? 'active' : '' ?>">
            <i class="bi bi-people"></i> Anggota
        </a>

        <a href="index.php?url=admin/laporan"
           class="<?= $current === 'admin/laporan' ? 'active' : '' ?>">
            <i class="bi bi-file-earmark-text"></i> Laporan
        </a>

    </div>

    <div class="logout">
        <a href="index.php?url=logout">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </a>
    </div>
</div>
