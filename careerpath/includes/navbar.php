<?php
// Mendeteksi nama file aktif untuk menu navigasi utama
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar-v3">
    <div class="nav-container-v3">
        <div class="logo-v3">
            <a href="index.php">
                <div class="logo-icon-v3">CP</div>
                <span>CareerPath</span>
            </a>
        </div>

        <ul class="nav-menu-v3">
            <li>
                <a href="index.php" class="<?= ($currentPage == 'index.php') ? 'active-nav-link' : ''; ?>">Beranda</a>
            </li>
            <li>
                <a href="jobs.php" class="<?= ($currentPage == 'jobs.php') ? 'active-nav-link' : ''; ?>">Cari Lowongan</a>
            </li>
            <li>
                <a href="applications.php" class="<?= ($currentPage == 'applications.php') ? 'active-nav-link' : ''; ?>">Lamaran Saya</a>
            </li>
            <li>
                <a href="profile.php" class="<?= ($currentPage == 'profile.php') ? 'active-nav-link' : ''; ?>">Profil</a>
            </li>
        </ul>

        <div class="nav-btn-v3">
            <a href="login.php" class="btn-outline-v3">Masuk</a>
            <a href="dashboard.php" class="btn-primary-v3">Dashboard <i class="fa-solid fa-arrow-right" style="margin-left: 6px; font-size: 11px;"></i></a>
        </div>

        <div class="menu-toggle-v3" onclick="alert('Menu responsif ponsel sedang disiapkan!');">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>
</nav>

<style>
    :root {
        --primary: #2563EB;
        --primary-hover: #1D4ED8;
        --dark-slate: #0F172A;
        --charcoal: #1E293B;
        --text-muted: #64748B;
        --white: #FFFFFF;
        --border-soft: rgba(226, 232, 240, 0.8);
    }

    /* FLOATING STICKY NAVBAR */
    .navbar-v3 {
        position: fixed;
        top: 16px;
        left: 50%;
        transform: translateX(-50%);
        width: calc(100% - 48px);
        max-width: 1200px;
        background-color: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid var(--border-soft);
        border-radius: 16px;
        padding: 0 24px;
        height: 70px;
        display: flex;
        align-items: center;
        z-index: 2000;
        box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05);
    }

    /* Dorong konten halaman ke bawah agar tidak tertutup navbar floating */
    body {
        padding-top: 100px;
    }

    .nav-container-v3 {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    /* LOGO BRAND DESIGN */
    .logo-v3 a {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }
    .logo-icon-v3 {
        width: 32px;
        height: 32px;
        background-color: var(--primary);
        color: var(--white);
        font-weight: 800;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }
    .logo-v3 span {
        font-size: 18px;
        font-weight: 700;
        color: var(--dark-slate);
        letter-spacing: -0.3px;
    }

    /* CENTER MENU LIST */
    .nav-menu-v3 {
        display: flex;
        list-style: none;
        gap: 32px;
        margin: 0;
        padding: 0;
    }
    .nav-menu-v3 a {
        font-size: 14px;
        font-weight: 500;
        color: #475569;
        text-decoration: none;
        transition: all 0.2s ease;
        position: relative;
        padding: 6px 0;
    }
    .nav-menu-v3 a:hover {
        color: var(--primary);
    }

    /* EFEK GARIS BAWAH MENU AKTIF */
    .nav-menu-v3 a.active-nav-link {
        color: var(--primary);
        font-weight: 600;
    }
    .nav-menu-v3 a.active-nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: var(--primary);
        border-radius: 100px;
    }

    /* CALL TO ACTION BUTTONS */
    .nav-btn-v3 {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .btn-outline-v3 {
        font-size: 13.5px;
        font-weight: 600;
        color: var(--charcoal);
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 10px;
        transition: background 0.2s;
    }
    .btn-outline-v3:hover {
        background-color: #F1F5F9;
    }
    .btn-primary-v3 {
        font-size: 13.5px;
        font-weight: 600;
        color: var(--white);
        background-color: var(--primary);
        text-decoration: none;
        padding: 10px 22px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
        transition: background 0.2s, transform 0.2s;
    }
    .btn-primary-v3:hover {
        background-color: var(--primary-hover);
        transform: translateY(-1px);
    }

    /* RESPONSIVE MOBILE TOGGLE BUTTON */
    .menu-toggle-v3 {
        display: none;
        font-size: 20px;
        color: var(--charcoal);
        cursor: pointer;
    }

    /* RESPONSIVE BREAKPOINT */
    @media (max-width: 768px) {
        .nav-menu-v3, .nav-btn-v3 { display: none; }
        .menu-toggle-v3 { display: block; }
        .navbar-v3 { top: 12px; width: calc(100% - 24px); padding: 0 16px; }
    }
</style>