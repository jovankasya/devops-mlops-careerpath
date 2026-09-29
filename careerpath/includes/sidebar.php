<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="main-sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <div class="brand-text">
            <span>Career</span>Path
        </div>
    </div>

    <div class="menu-group">
        <p class="menu-label">Menu Utama</p>
        
        <a href="dashboard.php" class="menu-item <?= ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
            <i class="fa-solid fa-chart-pie"></i>
            <span>Dashboard</span>
        </a>
        
        <a href="jobs.php" class="menu-item <?= ($current_page == 'jobs.php' || $current_page == 'job-detail.php' || $current_page == 'apply-form.php') ? 'active' : ''; ?>">
            <i class="fa-solid fa-briefcase"></i>
            <span>Cari Lowongan</span>
        </a>
        
        <a href="applications.php" class="menu-item <?= ($current_page == 'applications.php') ? 'active' : ''; ?>">
            <i class="fa-solid fa-receipt"></i>
            <span>Lamaran Saya</span>
            <span class="badge-count"></span>
        </a>
    </div>

    <div class="menu-group" style="margin-top: auto;">
        <p class="menu-label">Personal & Sistem</p>
        
        <a href="profile.php" class="menu-item <?= ($current_page == 'profile.php') ? 'active' : ''; ?>">
            <i class="fa-solid fa-user-gear"></i>
            <span>Profil Saya</span>
        </a>
        
        <a href="settings.php" class="menu-item <?= ($current_page == 'settings.php') ? 'active' : ''; ?>">
            <i class="fa-solid fa-sliders"></i>
            <span>Pengaturan</span>
        </a>
        
        <hr class="sidebar-divider">
        
        <a href="logout.php" class="menu-item logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Keluar Akun</span>
        </a>
    </div>

    <div class="sidebar-user-footer">
        <div class="user-avatar">JS</div>
        <div class="user-meta">
            <h4>Jovanka Syakira</h4>
            <p>Mahasiswa Informatika</p>
        </div>
    </div>
</aside>

<style>
    /* UTAMA: Merubah Warna Sidebar Menjadi Biru Sesuai Referensimu */
    .main-sidebar {
        width: 280px;
        background: linear-gradient(180deg, #0A4174 0%, #001D39 100%); /* Tema Biru Deep Sesuai Gambar Referensi */
        border-right: 1px solid rgba(255, 255, 255, 0.1);
        padding: 32px 20px;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* BRAND LOGO */
    .sidebar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0 12px;
        margin-bottom: 40px;
    }
    .brand-icon {
        width: 38px;
        height: 38px;
        background: #7BBDE8; /* Biru muda cerah */
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #001D39;
        font-size: 18px;
    }
    .brand-text {
        font-size: 20px;
        font-weight: 700;
        color: #FFFFFF;
    }
    .brand-text span {
        color: #7BBDE8;
    }

    /* MENU ITEMS */
    .menu-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 28px;
    }
    .menu-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #49769F; /* Biru abu-abu kalem */
        padding: 0 12px 6px 12px;
    }
    .menu-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 16px;
        border-radius: 12px;
        color: #BDD8E9; /* Teks biru muda kalem */
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    /* HOVER STATE */
    .menu-item:hover {
        background-color: rgba(255, 255, 255, 0.08);
        color: #FFFFFF;
    }

    /* ACTIVE STATE: Sorotan Biru Cerah Bergradasi */
    .menu-item.active {
        background: linear-gradient(135deg, #7BBDE8 0%, #4E8EA2 100%);
        color: #001D39; /* Teks kontras gelap di atas latar cerah */
        font-weight: 600;
    }
    
    .badge-count {
        margin-left: auto;
        font-size: 12px;
    }

    .logout:hover {
        background-color: rgba(239, 68, 68, 0.2);
        color: #F87171;
    }

    .sidebar-divider {
        border: none;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin: 12px 0;
    }

    /* FOOTER USER CARD */
    .sidebar-user-footer {
        display: flex;
        align-items: center;
        gap: 12px;
        background-color: rgba(255, 255, 255, 0.05);
        padding: 12px;
        border-radius: 14px;
        margin-top: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .user-avatar {
        width: 36px;
        height: 36px;
        background: #7BBDE8;
        color: #001D39;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 13px;
    }
    .user-meta h4 {
        font-size: 13px;
        font-weight: 600;
        color: #FFFFFF;
    }
    .user-meta p {
        font-size: 11px;
        color: #BDD8E9;
    }
</style>