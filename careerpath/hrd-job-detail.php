<?php
session_start();
// Halaman Detail Lowongan - HRD Panel
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lowongan - CareerPath HRD</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        :root {
            --bg-main: #F0F4F8;          
            --card-bg: #FFFFFF;
            --sidebar-bg: #1E3A8A;       
            --primary: #1D4ED8;          
            --primary-light: #EFF6FF;
            --text-dark: #1E293B;        
            --text-muted: #64748B;       
            --border-color: #CBD5E1;     
            
            /* Status Warna */
            --success: #15803D;
            --success-bg: #DCFCE7;
            --warning: #B45309;
            --warning-bg: #FEF3C7;
            --danger: #B91C1C;
            --danger-bg: #FEE2E2;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
        }

        /* --- SIDEBAR NAV --- */
        .sidebar {
            width: 260px;
            background-color: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 30px 20px;
            position: fixed;
            height: 100vh;
            box-shadow: 4px 0 24px rgba(30, 58, 138, 0.1);
            z-index: 100;
        }

        .sidebar-top {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 18px;
            font-weight: 800;
            color: #FFFFFF;
            margin-bottom: 35px;
            padding-left: 10px;
        }
        .sidebar-brand i { color: #38BDF8; }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
            width: 100%;
        }

        .menu-item {
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 18px;
            color: #BFDBFE; 
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            border-radius: 10px;
            transition: all 0.2s ease;
            width: 100%;
        }

        .menu-item a:hover, .menu-item.active > a {
            background: rgba(255, 255, 255, 0.15); 
            color: #FFFFFF;
        }

        .menu-item.active > a i { color: #38BDF8; }

        .sub-menu {
            list-style: none;
            padding-left: 0; 
            margin-top: 4px;
            width: 100%;
        }

        .sub-menu li a {
            padding: 10px 18px 10px 46px;
            font-size: 13.5px;
            font-weight: 600;
            color: #93C5FD;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sub-menu li a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #FFFFFF;
        }

        .sidebar-footer {
            margin-top: auto;
            width: 100%;
        }

        /* --- LAYOUT UTAMA --- */
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            gap: 24px;
            width: calc(100% - 260px);
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-area {
            display: flex;
            align-items: center;
            gap: 14px;
            background: var(--card-bg);
            padding: 8px 16px;
            border-radius: 16px;
            border: 1px solid var(--border-color);
        }

        .profile-info h4 { font-size: 14px; font-weight: 700; }
        .profile-info p { font-size: 12px; color: var(--text-muted); }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
        }

        /* Job Detail Specific Style */
        .job-header-card {
            background: var(--card-bg);
            padding: 24px 32px;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 600;
            margin-bottom: 6px;
        }
        .btn-back:hover { color: var(--primary); }

        .dashboard-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        .data-section {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--border-color);
        }

        .section-title {
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .desc-text {
            color: var(--text-muted);
            font-size: 13.5px;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .qual-list {
            color: var(--text-muted);
            font-size: 13.5px;
            padding-left: 20px;
            line-height: 1.7;
        }

        .badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }
        .badge-success { background: var(--success-bg); color: var(--success); }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
            font-size: 13.5px;
        }
        .detail-row:last-child { border-bottom: none; }

        .btn-action {
            display: block;
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            font-weight: 700;
            text-align: center;
            text-decoration: none;
            border: none;
            cursor: pointer;
            margin-top: 12px;
            font-size: 13.5px;
        }
        .btn-edit { background: var(--primary); color: white; }
        .btn-disable { background: var(--danger-bg); color: var(--danger); }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-top">
            <div class="sidebar-brand">
                <i class="fa-solid fa-square-poll-vertical"></i>
                <span>CareerPath HRD</span>
            </div>

            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="hrd-dashboard.php"><i class="fa-solid fa-chart-pie"></i> Dasbor</a>
                </li>
                <li class="menu-item active">
                    <a href="hrd-jobs.php"><i class="fa-solid fa-briefcase"></i> Kelola Lowongan</a>
                </li>
                <li class="menu-item">
                    <a href="hrd-jobs-add.php"><i class="fa-solid fa-circle-plus"></i> Tambah Lowongan</a>
                </li>
                <li class="menu-item">
                    <a href="hrd-applications.php"><i class="fa-solid fa-address-card"></i> Data Pelamar</a>
                    <ul class="sub-menu">
                        <li>
                            <a href="hrd-application-detail.php">Tinjau Berkas</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="hrd-settings.php"><i class="fa-solid fa-sliders"></i> Pengaturan</a>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer">
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="hrd-logout.php" style="color: #FDA4AF;"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
                </li>
            </ul>
        </div>
    </div>

    <main class="main-content">
        
        <div class="content-header" style="justify-content: flex-end;">
            <div class="profile-area">
                <div class="profile-info">
                    <h4>Rian Culik, S.Kom</h4>
                    <p>PT Java Solusi</p>
                </div>
                <div class="avatar">RC</div>
            </div>
        </div>

        <section class="job-header-card">
            <div>
                <a href="hrd-jobs.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali ke Lowongan</a>
                <h1 style="font-size: 22px; font-weight: 800; margin-top: 4px;">Senior Backend Developer</h1>
                <p style="font-size: 13.5px; color: var(--text-muted); margin-top: 2px;"><i class="fa-solid fa-building"></i> Engineering Team</p>
            </div>
            <span class="badge badge-success"><i class="fa-solid fa-circle-check"></i> Lowongan Aktif</span>
        </section>

        <div class="dashboard-layout">
            
            <div class="data-section">
                <h3 class="section-title"><i class="fa-solid fa-file-lines" style="color: var(--primary);"></i> Deskripsi Pekerjaan</h3>
                <p class="desc-text">Kami mencari Senior Backend Developer untuk memimpin arsitektur server dan optimasi database skala besar.</p>
                
                <h3 class="section-title"><i class="fa-solid fa-graduation-cap" style="color: var(--primary);"></i> Kualifikasi</h3>
                <ul class="qual-list">
                    <li>Pengalaman 3-5 tahun di PHP/Node.js.</li>
                    <li>Paham RESTful API & Relational Database.</li>
                </ul>
            </div>

            <div>
                <div class="data-section" style="margin-bottom: 20px;">
                    <div class="section-title" style="margin-bottom: 12px;">Ringkasan</div>
                    <div class="detail-row">
                        <span style="color: var(--text-muted);">Jumlah Pelamar</span> 
                        <strong style="color: var(--primary);">42</strong>
                    </div>
                    <div class="detail-row">
                        <span style="color: var(--text-muted);">Kuota</span> 
                        <strong>5 Orang</strong>
                    </div>
                </div>

                <a href="#" class="btn-action btn-edit"><i class="fa-solid fa-pen"></i> Edit Lowongan</a>
                <button class="btn-action btn-disable"><i class="fa-solid fa-eye-slash"></i> Nonaktifkan Lowongan</button>
            </div>

        </div>

    </main>

</body>
</html>