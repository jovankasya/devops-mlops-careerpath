<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tinjau Berkas Pelamar - CareerPath Pro</title>
    
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
            --text-dark: #1E293B;        
            --text-muted: #64748B;       
            --border-color: #CBD5E1;     
            --warning: #B45309;
            --warning-bg: #FEF3C7;
            --danger: #DC2626;
            --danger-bg: #FEE2E2;
            --success: #16A34A;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
        }

        /* --- SIDEBAR NAV FULL FIVE MENU --- */
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
            gap: 6px;
            width: 100%;
        }

        .menu-item {
            width: 100%;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 11px 16px;
            color: #BFDBFE; 
            text-decoration: none;
            font-weight: 700;
            font-size: 13.5px;
            border-radius: 10px;
            transition: all 0.2s ease;
            width: 100%;
        }

        .menu-item a:hover, .menu-item.active a {
            background: rgba(255, 255, 255, 0.15); 
            color: #FFFFFF;
        }

        .menu-item.active a i { color: #38BDF8; }

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

        /* Layout Detail Columns */
        .detail-layout { display: grid; grid-template-columns: 1fr 2fr; gap: 24px; width: 100%; }

        .card-panel {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 28px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
        }

        .applicant-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 24px;
        }

        .big-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #E2E8F0;
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .badge-status {
            display: inline-block;
            margin-top: 10px;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            background: var(--warning-bg);
            color: var(--warning);
        }

        .info-title { font-size: 13.5px; font-weight: 800; margin-bottom: 16px; text-transform: uppercase; }
        .info-list { list-style: none; display: flex; flex-direction: column; gap: 14px; }
        .info-item { display: flex; align-items: flex-start; gap: 12px; font-size: 13.5px; }

        .document-box {
            margin-top: 24px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #F8FAFC;
        }

        .section-block { margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid var(--border-color); }
        .section-block:last-of-type { border-bottom: none; }

        .block-title { font-size: 12px; font-weight: 800; color: var(--text-muted); text-transform: uppercase; margin-bottom: 8px; }
        .pos-title { font-size: 15px; font-weight: 700; }

        .action-container { display: flex; justify-content: flex-end; gap: 12px; margin-top: auto; padding-top: 20px; }
        .btn-action { padding: 12px 20px; border-radius: 10px; font-size: 13.5px; font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 8px; border: none; }
        .btn-back { background: #E2E8F0; color: var(--text-dark); }
        .btn-reject { background: var(--danger-bg); color: var(--danger); }
        .btn-accept { background: var(--success); color: white; }
    </style>
</head>

<body>

    <!-- SIDEBAR NAV -->
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
                <li class="menu-item">
                    <a href="hrd-jobs.php"><i class="fa-solid fa-briefcase"></i> Kelola Lowongan</a>
                </li>
                <li class="menu-item">
                    <a href="hrd-jobs-add.php"><i class="fa-solid fa-square-plus"></i> Tambah Lowongan</a>
                </li>
                <li class="menu-item">
                    <a href="hrd-applications.php"><i class="fa-solid fa-address-card"></i> Data Pelamar</a>
                </li>
                <li class="menu-item active">
                    <a href="hrd-application-detail.php"><i class="fa-solid fa-file-signature"></i> Tinjau Berkas</a>
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

    <!-- MAIN CONTENT AREA -->
    <div class="main-content">
        
        <div class="content-header">
            <div>
                <h2 style="font-size: 22px; font-weight: 800; letter-spacing: -0.5px;">Tinjau Berkas Pelamar</h2>
                <p style="font-size: 14px; color: var(--text-muted); margin-top: 4px;">Periksa kompetensi dan dokumen pelamar sebelum mengambil keputusan seleksi.</p>
            </div>

            <div class="profile-area">
                <div class="profile-info">
                    <h4>Rian Culik, S.Kom</h4>
                    <p>PT Java Solusi</p>
                </div>
                <div class="avatar">RC</div>
            </div>
        </div>

        <div class="detail-layout">
            <div class="card-panel">
                <div class="applicant-profile">
                    <div class="big-avatar">JS</div>
                    <h3 style="font-size: 18px; font-weight: 800;">Jovanka Syakira</h3>
                    <p style="font-size: 13px; color: var(--text-muted);">Universitas Indonesia</p>
                    <span class="badge-status">Status: Review</span>
                </div>

                <div class="info-title">Kontak & Informasi</div>
                <ul class="info-list">
                    <li class="info-item"><i class="fa-solid fa-envelope"></i> <div>jovanka@student.ui.ac.id</div></li>
                    <li class="info-item"><i class="fa-solid fa-phone"></i> <div>+62 812-3456-7890</div></li>
                </ul>

                <div class="document-box">
                    <div style="display: flex; align-items: center; gap: 12px; font-size: 13.5px; font-weight: 700;">
                        <i class="fa-solid fa-file-pdf" style="color: #EF4444; font-size: 24px;"></i>
                        <span>CV_Jovanka.pdf</span>
                    </div>
                    <a href="#" style="color: var(--primary);"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                </div>
            </div>

            <div class="card-panel">
                <div class="section-block">
                    <div class="block-title">Posisi Yang Dilamar</div>
                    <div class="pos-title">UI/UX Designer Intern <span style="color: var(--text-muted); font-weight: 400;">– Product & Design</span></div>
                </div>

                <div class="section-block">
                    <div class="block-title">Tentang Diri / Ringkasan Profil</div>
                    <p style="font-size: 14px; line-height: 1.6;">Mahasiswi Teknik Informatika semester 6 yang berfokus pada User Experience Design & prototyping fidelitas tinggi menggunakan Figma.</p>
                </div>

                <div class="action-container">
                    <a href="hrd-applications.php" class="btn-action btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                    <button class="btn-action btn-reject"><i class="fa-solid fa-circle-xmark"></i> Tolak</button>
                    <button class="btn-action btn-accept"><i class="fa-solid fa-circle-check"></i> Terima</button>
                </div>
            </div>
        </div>

    </div>

</body>
</html>