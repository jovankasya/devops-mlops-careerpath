<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Instansi - CareerPath Pro</title>
    
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

        /* --- SETTINGS CONTENT GRID --- */
        .settings-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 24px;
            align-items: start;
        }

        .settings-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 28px;
            border: 1px solid var(--border-color);
        }

        .card-subtitle {
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 20px;
            color: var(--text-dark);
        }

        /* Logo Upload Section */
        .logo-upload-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
            text-align: center;
        }

        .logo-placeholder {
            width: 100px;
            height: 100px;
            background: #EFF6FF;
            border: 2px dashed #38BDF8;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .btn-upload-logo {
            background: #EFF6FF;
            color: var(--primary);
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s;
        }
        .btn-upload-logo:hover { background: #DBEAFE; }

        .upload-hint {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 12px;
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        input[type="text"], input[type="email"], select, textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            font-size: 13.5px;
            background-color: #FFFFFF;
            color: var(--text-dark);
            outline: none;
            transition: all 0.2s;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn-save {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
        }
        .btn-save:hover { background: #1E40AF; }
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
                <li class="menu-item">
                    <a href="hrd-application-detail.php"><i class="fa-solid fa-file-signature"></i> Tinjau Berkas</a>
                </li>
                <li class="menu-item active">
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
        
        <!-- HEADER -->
        <div class="content-header">
            <div>
                <h2 style="font-size: 22px; font-weight: 800; letter-spacing: -0.5px;">Pengaturan Instansi</h2>
                <p style="font-size: 14px; color: var(--text-muted); margin-top: 4px;">Kelola identitas perusahaan dan informasi akun perwakilan HRD Anda.</p>
            </div>

            <div class="profile-area">
                <div class="profile-info">
                    <h4>Aris Wijaya, S.Kom</h4>
                    <p>PT Java Solusi</p>
                </div>
                <div class="avatar">AW</div>
            </div>
        </div>

        <!-- SETTINGS GRID CONTENT -->
        <form action="process-settings.php" method="POST" enctype="multipart/form-data">
            <div class="settings-grid">
                
                <!-- Left Column: Logo -->
                <div class="settings-card">
                    <div class="card-subtitle">Logo Perusahaan</div>
                    <div class="logo-upload-container">
                        <div class="logo-placeholder">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <button type="button" class="btn-upload-logo">
                            <i class="fa-solid fa-cloud-arrow-up"></i> Ganti Logo
                        </button>
                        <span class="upload-hint">Maksimal file 2MB (JPG, PNG)</span>
                    </div>
                </div>

                <!-- Right Column: Profiles -->
                <div class="settings-card">
                    <div class="card-subtitle" style="margin-bottom: 24px;">Informasi Profil Perusahaan</div>
                    
                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan / Instansi</label>
                        <input type="text" id="nama_perusahaan" name="nama_perusahaan" value="PT Java Solusi Solusindo">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="sektor">Sektor Industri</label>
                            <select id="sektor" name="sektor">
                                <option value="tech" selected>Teknologi & Informasi</option>
                                <option value="finance">Keuangan</option>
                                <option value="creative">Industri Kreatif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="website">Situs Web Perusahaan</label>
                            <input type="text" id="website" name="website" value="https://javasolusi.co.id">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Ringkas Perusahaan</label>
                        <textarea id="deskripsi" name="deskripsi">PT Java Solusi adalah perusahaan teknologi yang berfokus membangun ekosistem digital untuk kemajuan bisnis di Indonesia.</textarea>
                    </div>

                    <div class="card-subtitle" style="margin: 32px 0 20px 0; padding-top: 12px; border-top: 1px solid var(--border-color);">
                        Kontak Penanggung Jawab (HRD)
                    </div>

                    <div class="form-row" style="margin-bottom: 10px;">
                        <div class="form-group">
                            <label for="nama_hrd">Nama Lengkap Perwakilan</label>
                            <input type="text" id="nama_hrd" name="nama_hrd" value="Aris Wijaya, S.Kom">
                        </div>
                        <div class="form-group">
                            <label for="email_hrd">Email Kerja</label>
                            <input type="email" id="email_hrd" name="email_hrd" value="aris.wijaya@javasolusi.co.id">
                        </div>
                    </div>

                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>

            </div>
        </form>

    </div>

</body>
</html>