<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lowongan - CareerPath Pro</title>
    
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

        /* Form Container Box */
        .form-section {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 32px;
            border: 1px solid var(--border-color);
            width: 100%;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .form-section-title {
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .form-section-title i { color: var(--primary); }

        .form-group { margin-bottom: 20px; width: 100%; }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            width: 100%;
        }

        label { display: block; font-size: 13.5px; font-weight: 700; margin-bottom: 8px; }

        input[type="text"], select, textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            font-size: 14px;
            background-color: #F8FAFC;
            color: var(--text-dark);
            outline: none;
            transition: all 0.2s;
        }

        input[type="text"]:focus, select:focus, textarea:focus {
            border-color: var(--primary);
            background-color: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.1);
        }

        textarea { resize: vertical; min-height: 120px; }

        .form-actions { display: flex; align-items: center; gap: 12px; margin-top: 10px; }

        .btn-submit {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-cancel {
            background: #E2E8F0;
            color: var(--text-dark);
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
        }
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
                <li class="menu-item active">
                    <a href="hrd-jobs-add.php"><i class="fa-solid fa-square-plus"></i> Tambah Lowongan</a>
                </li>
                <li class="menu-item">
                    <a href="hrd-applications.php"><i class="fa-solid fa-address-card"></i> Data Pelamar</a>
                </li>
                <li class="menu-item">
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
                <h2 style="font-size: 22px; font-weight: 800; letter-spacing: -0.5px;">Tambah Lowongan</h2>
                <p style="font-size: 14px; color: var(--text-muted); margin-top: 4px;">Isi formulir di bawah ini untuk mempublikasikan program magang baru.</p>
            </div>

            <div class="profile-area">
                <div class="profile-info">
                    <h4>Rian Culik, S.Kom</h4>
                    <p>PT Java Solusi</p>
                </div>
                <div class="avatar">RC</div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-title">
                <i class="fa-solid fa-briefcase"></i> Detail Informasi Lowongan
            </div>

            <form action="process-add-job.php" method="POST">
                <div class="form-group">
                    <label for="posisi">Nama Posisi Magang</label>
                    <input type="text" id="posisi" name="posisi" placeholder="Contoh: Frontend Developer Intern" required>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="departemen">Departemen / Divisi</label>
                        <select id="departemen" name="departemen" required>
                            <option value="" disabled selected>Pilih Departemen</option>
                            <option value="tech">Teknologi & Informasi</option>
                            <option value="design">Creative Design</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kuota">Kuota Penerimaan (Mahasiswa)</label>
                        <input type="text" id="kuota" name="kuota" placeholder="Contoh: 3" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Pekerjaan</label>
                    <textarea id="deskripsi" name="deskripsi" placeholder="Tuliskan tugas utama..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="kualifikasi">Kualifikasi & Persyaratan</label>
                    <textarea id="kualifikasi" name="kualifikasi" placeholder="Contoh: Mampu menggunakan Git..." required></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-paper-plane"></i> Publikasikan Lowongan</button>
                    <a href="hrd-jobs.php" class="btn-cancel">Batal</a>
                </div>
            </form>
        </div>

    </div>

</body>
</html>