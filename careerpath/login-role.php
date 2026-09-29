<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Akses Masuk - CareerPath</title>
    
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
            --royal-blue: #0A66C2;
            --dark-slate: #0F172A;     
            --charcoal: #1E293B;       
            --text-muted: #64748B;     
            --bg-muted: #F1F5F9;       /* Latar belakang teduh anti-silau */
            --white: #FFFFFF;
            --border-soft: #E2E8F0;
            --shadow-premium: 0 20px 40px rgba(15, 23, 42, 0.04);
            --shadow-hover: 0 30px 60px rgba(10, 102, 194, 0.1);
        }

        body {
            background-color: var(--bg-muted);
            color: var(--charcoal);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .role-container {
            width: 100%;
            max-width: 800px;
            text-align: center;
        }

        .role-header {
            margin-bottom: 48px;
        }
        .role-header h1 {
            font-size: 32px;
            font-weight: 800;
            color: var(--dark-slate);
            letter-spacing: -0.5px;
            margin-bottom: 12px;
        }
        .role-header p {
            color: var(--text-muted);
            font-size: 16px;
        }

        .role-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 32px;
            margin-bottom: 40px;
        }

        .role-card {
            background-color: var(--white);
            border-radius: 24px;
            padding: 40px 32px;
            border: 1px solid var(--border-soft);
            box-shadow: var(--shadow-premium);
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .role-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(10, 102, 194, 0.2);
        }

        .role-icon-box {
            width: 72px;
            height: 72px;
            border-radius: 20px;
            background-color: var(--bg-muted);
            color: var(--dark-slate);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 28px;
            transition: all 0.3s;
        }
        .role-card:hover .role-icon-box {
            background-color: var(--royal-blue);
            color: var(--white);
        }

        .role-card h2 {
            font-size: 20px;
            font-weight: 800;
            color: var(--dark-slate);
            margin-bottom: 12px;
        }

        .role-card p {
            font-size: 14.5px;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .role-btn-arrow {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--bg-muted);
            color: var(--charcoal);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: all 0.3s;
        }
        .role-card:hover .role-btn-arrow {
            background-color: var(--royal-blue);
            color: var(--white);
            transform: scale(1.1);
        }

        .btn-back-landing {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 700;
            font-size: 14.5px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: color 0.2s;
        }
        .btn-back-landing:hover {
            color: var(--royal-blue);
        }
    </style>
</head>

<body>

    <div class="role-container">
        <div class="role-header">
            <h1>Selamat Datang di CareerPath</h1>
            <p>Silakan pilih jenis akun Anda untuk melanjutkan akses masuk portal</p>
        </div>

        <div class="role-grid">
            <!-- Pilihan 1: Mahasiswa -->
            <a href="login.php" class="role-card">
                <div class="role-icon-box">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <h2>Portal Mahasiswa</h2>
                <p>Cari lowongan magang terverifikasi, kirim berkas CV, dan pantau status lamaran kerja Anda secara real-time.</p>
                <div class="role-btn-arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <!-- Pilihan 2: HRD / Perusahaan -->
            <a href="hrd-login.php" class="role-card">
                <div class="role-icon-box">
                    <i class="fa-solid fa-building-user"></i>
                </div>
                <h2>Portal Mitra HRD</h2>
                <p>Publikasikan lowongan magang instansi, seleksi portofolio kandidat talent, dan kelola rekrutmen perusahaan.</p>
                <div class="role-btn-arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>
        </div>

        <a href="index.php" class="btn-back-landing">
            <i class="fa-solid fa-chevron-left"></i> Kembali ke Beranda Utama
        </a>
    </div>

</body>
</html>