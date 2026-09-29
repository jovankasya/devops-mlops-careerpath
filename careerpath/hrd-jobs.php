<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Lowongan - CareerPath Pro</title>
    
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
            --success: #16A34A;
            --success-bg: #DCFCE7;
            --danger: #DC2626;
            --danger-bg: #FEE2E2;
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

        .data-section {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 32px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .section-title { font-size: 16px; font-weight: 800; }

        /* Table Design */
        .custom-table { width: 100%; border-collapse: collapse; }
        .custom-table th {
            padding: 14px;
            color: var(--text-muted);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border-color);
            text-align: left;
            background: #F8FAFC;
        }
        .custom-table td { padding: 20px 14px; border-bottom: 1px solid var(--border-color); font-size: 14px; }
        .custom-table tr:last-child td { border-bottom: none; }

        .job-title { font-weight: 700; color: var(--text-dark); font-size: 14.5px; }
        .job-dept { font-size: 12px; color: var(--text-muted); margin-top: 2px; }

        .badge { display: inline-block; padding: 6px 12px; border-radius: 8px; font-size: 11.5px; font-weight: 700; }
        .badge-active { background: var(--success-bg); color: var(--success); }
        .badge-inactive { background: var(--danger-bg); color: var(--danger); }
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
                <li class="menu-item active">
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
                <h2 style="font-size: 22px; font-weight: 800; letter-spacing: -0.5px;">Kelola Lowongan</h2>
                <p style="font-size: 14px; color: var(--text-muted); margin-top: 4px;">Publikasikan, ubah, atau nonaktifkan lowongan posisi magang perusahaan Anda.</p>
            </div>

            <div class="profile-area">
                <div class="profile-info">
                    <h4>Rian Culik, S.Kom</h4>
                    <p>PT Java Solusi</p>
                </div>
                <div class="avatar">RC</div>
            </div>
        </div>

        <div class="data-section">
            <div class="section-header">
                <div class="section-title">Daftar Lowongan Aktif</div>
            </div>

            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Posisi Magang</th>
                        <th>Kuota</th>
                        <th>Pendaftar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="job-title">UI/UX Designer Intern</div>
                            <div class="job-dept">Departemen Product & Design</div>
                        </td>
                        <td>5 Mahasiswa</td>
                        <td><strong>48</strong> Pelamar</td>
                        <td><span class="badge badge-active">Aktif</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="job-title">Backend Developer (Laravel)</div>
                            <div class="job-dept">Departemen Engineering</div>
                        </td>
                        <td>3 Mahasiswa</td>
                        <td><strong>100</strong> Pelamar</td>
                        <td><span class="badge badge-active">Aktif</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="job-title">Mobile Developer (Flutter)</div>
                            <div class="job-dept">Departemen Engineering</div>
                        </td>
                        <td>2 Mahasiswa</td>
                        <td><strong>0</strong> Pelamar</td>
                        <td><span class="badge badge-inactive">Nonaktif</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>