<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor HRD - CareerPath Pro</title>
    
    <!-- Google Fonts & FontAwesome -->
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

        /* Style khusus untuk Sub-menu Tinjau Berkas agar sejajar presisi */
        .sub-menu {
            list-style: none;
            padding-left: 0; 
            margin-top: 4px;
            width: 100%;
        }

        .sub-menu li a {
            padding: 10px 18px 10px 46px; /* Dorong sedikit ke kanan agar sejajar teks atasnya */
            font-size: 13.5px;
            font-weight: 600;
            color: #93C5FD;
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

        /* Stats Grid Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .stat-card {
            background: var(--card-bg);
            padding: 24px;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-info h3 { font-size: 28px; font-weight: 800; margin-bottom: 4px; }
        .stat-info p { font-size: 13.5px; color: var(--text-muted); font-weight: 600; }
        
        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        /* Content Layout Grid */
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

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title { font-size: 16px; font-weight: 800; }

        .btn-add {
            background: var(--primary);
            color: white;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 6px;
            border: none;
            cursor: pointer;
        }

        /* Table Design */
        .custom-table { width: 100%; border-collapse: collapse; }
        .custom-table th {
            padding: 12px 14px;
            color: var(--text-muted);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border-color);
            text-align: left;
            background: #F8FAFC;
        }
        .custom-table td { padding: 16px 14px; border-bottom: 1px solid var(--border-color); font-size: 13.5px; }
        .custom-table tr:last-child td { border-bottom: none; }

        .student-name { font-weight: 700; color: var(--text-dark); }
        
        .badge { display: inline-block; padding: 4px 8px; border-radius: 6px; font-size: 11px; font-weight: 700; }
        .badge-warning { background: var(--warning-bg); color: var(--warning); }
        .badge-success { background: var(--success-bg); color: var(--success); }

        .link-detail { color: var(--primary); text-decoration: none; font-weight: 700; }
        .link-detail:hover { text-decoration: underline; }

        /* Widget Kanan */
        .widget-column { display: flex; flex-direction: column; gap: 24px; }
        
        .activity-list { list-style: none; display: flex; flex-direction: column; gap: 16px; margin-top: 14px; }
        .activity-item { display: flex; gap: 12px; font-size: 13px; line-height: 1.4; }
        .activity-item i { color: var(--primary); margin-top: 4px; font-size: 8px; }
        .activity-time { font-size: 11px; color: var(--text-muted); display: block; margin-top: 2px; }

        .quota-box {
            background: var(--primary);
            color: white;
            border-radius: 16px;
            padding: 24px;
        }
        .quota-box h4 { font-size: 14px; font-weight: 700; display: flex; align-items: center; gap: 8px; }
        .quota-box p { font-size: 12.5px; margin: 12px 0; opacity: 0.9; line-height: 1.5; }
        
        .progress-bar-bg { background: rgba(255, 255, 255, 0.2); height: 8px; border-radius: 4px; overflow: hidden; }
        .progress-bar-fill { background: #38BDF8; height: 100%; width: 55%; border-radius: 4px; }
    </style>
</head>

<body>

    <!-- SIDEBAR NAVIGATION DENGAN SUBMENU CORRECTIONS -->
    <div class="sidebar">
        <div class="sidebar-top">
            <div class="sidebar-brand">
                <i class="fa-solid fa-square-poll-vertical"></i>
                <span>CareerPath HRD</span>
            </div>

            <ul class="sidebar-menu">
                <!-- 1. DASHBOARD (ACTIVE) -->
                <li class="menu-item active">
                    <a href="hrd-dashboard.php"><i class="fa-solid fa-chart-pie"></i> Dasbor</a>
                </li>
                
                <!-- 2. KELOLA LOWONGAN -->
                <li class="menu-item">
                    <a href="hrd-jobs.php"><i class="fa-solid fa-briefcase"></i> Kelola Lowongan</a>
                </li>

                <!-- 3. TAMBAH LOWONGAN -->
                <li class="menu-item">
                    <a href="hrd-jobs-add.php"><i class="fa-solid fa-circle-plus"></i> Tambah Lowongan</a>
                </li>

                <!-- 4. DATA PELAMAR & SUB-MENU TINJAU BERKAS -->
                <li class="menu-item">
                    <a href="hrd-applications.php"><i class="fa-solid fa-address-card"></i> Data Pelamar</a>
                    <!-- Sub-menu dibungkus di dalam li agar link hidup & bisa diklik -->
                    <ul class="sub-menu">
                        <li>
                            <a href="hrd-application-detail.php">Tinjau Berkas</a>
                        </li>
                    </ul>
                </li>

                <!-- 5. PENGATURAN -->
                <li class="menu-item">
                    <a href="hrd-settings.php"><i class="fa-solid fa-sliders"></i> Pengaturan</a>
                </li>
            </ul>
        </div>

        <!-- 6. TOMBOL KELUAR -->
        <div class="sidebar-footer">
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="hrd-logout.php" style="color: #FDA4AF;"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- MAIN CONTENT AREA -->
    <div class="main-content">
        
        <!-- HEADER -->
        <div class="content-header">
            <div>
                <h2 style="font-size: 22px; font-weight: 800; letter-spacing: -0.5px;">Overview Data</h2>
                <p style="font-size: 14px; color: var(--text-muted); margin-top: 4px;">Selamat datang kembali, Mitra HRD PT Java Solusi.</p>
            </div>

            <div class="profile-area">
                <div class="profile-info">
                    <h4>Rian Culik, S.Kom</h4>
                    <p>PT Java Solusi</p>
                </div>
                <div class="avatar">RC</div>
            </div>
        </div>

        <!-- STATS GRID -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-info">
                    <h3>12</h3>
                    <p>Lowongan Aktif</p>
                </div>
                <div class="stat-icon"><i class="fa-solid fa-folder-open"></i></div>
            </div>
            <div class="stat-card">
                <div class="stat-info">
                    <h3>148</h3>
                    <p>Total Pelamar</p>
                </div>
                <div class="stat-icon" style="color: #16A34A; background: #DCFCE7;"><i class="fa-solid fa-users"></i></div>
            </div>
            <div class="stat-card">
                <div class="stat-info">
                    <h3>24</h3>
                    <p>Pending</p>
                </div>
                <div class="stat-icon" style="color: #D97706; background: #FEF3C7;"><i class="fa-solid fa-clock"></i></div>
            </div>
        </div>

        <!-- TWO COLUMN LAYOUT -->
        <div class="dashboard-layout">
            
            <!-- LEFT COLUMN: TABLE -->
            <div class="data-section">
                <div class="section-header">
                    <div class="section-title">Pelamar Magang Terbaru</div>
                    <a href="hrd-jobs-add.php" class="btn-add"><i class="fa-solid fa-plus"></i> Tambah Lowongan</a>
                </div>

                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Mahasiswa</th>
                            <th>Posisi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="student-name">Jovanka Syakira</div>
                            </td>
                            <td>UI/UX Designer</td>
                            <td><span class="badge badge-warning">Review</span></td>
                            <td><a href="hrd-application-detail.php" class="link-detail">Detail</a></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="student-name">Budi Setiawan</div>
                            </td>
                            <td>Backend Dev</td>
                            <td><span class="badge badge-success">Lolos</span></td>
                            <td><a href="hrd-application-detail.php" class="link-detail">Detail</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- RIGHT COLUMN: WIDGETS -->
            <div class="widget-column">
                
                <!-- Aktivitas Sistem -->
                <div class="data-section">
                    <div class="section-title">Aktivitas Sistem</div>
                    <ul class="activity-list">
                        <li class="activity-item">
                            <i class="fa-solid fa-circle"></i>
                            <div>
                                <strong>Budi Setiawan</strong> mengirim berkas lamaran baru
                                <span class="activity-time">10 Menit yang lalu</span>
                            </div>
                        </li>
                        <li class="activity-item">
                            <i class="fa-solid fa-circle" style="color: #16A34A;"></i>
                            <div>
                                Lowongan <strong>'UI/UX Designer'</strong> berhasil dipublikasikan
                                <span class="activity-time">2 Jam yang lalu</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Ringkasan Kuota -->
                <div class="quota-box">
                    <h4><i class="fa-solid fa-circle-info"></i> Ringkasan Kuota</h4>
                    <p>Kuota magang bulan ini tersisa <strong>45%</strong> dari total kapasitas penerimaan.</p>
                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill"></div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>
</html>