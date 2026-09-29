<?php
// Jalankan session untuk mengamankan data pengguna
session_start();

// Data profil user (Jovanka Syakira)
$name   = "Jovanka Syakira";
$major  = "S1 Informatika - Universitas Terkemuka";
$email  = "jovanka.syakira@student.ac.id";
$phone  = "+62 812-3456-7890";
$cv     = "CV_Jovanka_Syakira.pdf";
$skills = ['UI/UX Design', 'Figma', 'HTML & CSS', 'User Research'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - CareerPath</title>

    <!-- Google Fonts & FontAwesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* RESET LAYOUT DASAR */
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
        
        :root {
            --bg-main: #F1F5F9;         
            --white: #FFFFFF;
            --border-soft: #CBD5E1;     /* Dipertegas dari E2E8F0 agar lebih kelihatan */
            --dark-slate: #0F172A;      /* Dipergelap dari 1E293B untuk kontras teks utama */
            --text-muted: #475569;      /* Dipergelap dari 64748B agar label terbaca jelas */
            --royal-blue: #2563EB;      
        }

        body { 
            background-color: var(--bg-main); 
            color: var(--dark-slate);
            overflow-x: hidden;
        }
        
        .dashboard-container { 
            display: flex; 
            width: 100vw;
            min-height: 100vh; 
        }

        .main-content { 
            flex: 1; 
            padding: 40px; 
            height: 100vh;
            overflow-y: auto;
        }

        /* BANNER ATAS */
        .welcome-banner {
            background-color: var(--royal-blue);
            border-radius: 20px;
            padding: 36px 40px;
            color: var(--white);
            margin-bottom: 32px;
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.15);
        }

        .welcome-banner h1 { font-size: 28px; font-weight: 700; margin-bottom: 6px; }
        .welcome-banner p { color: #E0F2FE; font-size: 15px; opacity: 0.95; }

        /* KARTU PROFIL UTAMA (DISETTING PROPORSIONAL) */
        .profile-card {
            background-color: var(--white);
            border: 1px solid var(--border-soft);
            border-radius: 20px;
            padding: 40px;
            max-width: 900px; /* Diperlebar sedikit agar komponen bernapas */
            margin: 0 auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        /* BAGIAN ATAS: AVATAR & NAMA UTAMA */
        .profile-header-section {
            display: flex;
            align-items: center;
            gap: 28px;
            padding-bottom: 32px;
            border-bottom: 2px solid #F1F5F9;
            margin-bottom: 36px;
        }

        .profile-avatar {
            width: 90px;
            height: 90px;
            background-color: #EFF6FF;
            color: var(--royal-blue);
            font-size: 32px;
            font-weight: 700;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #DBEAFE;
            flex-shrink: 0;
        }

        .profile-title-meta h2 { font-size: 26px; font-weight: 700; color: var(--dark-slate); }
        .profile-title-meta p { font-size: 15px; color: var(--text-muted); margin-top: 6px; font-weight: 500; }
        .profile-title-meta p i { color: var(--royal-blue); margin-right: 4px; }

        /* INTERFACES FORM DATA DIRI */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
            margin-bottom: 36px;
        }

        .info-box label {
            display: block;
            font-size: 13px; /* Ukuran naik dari 11px */
            font-weight: 700; /* Dibuat lebih tebal bold */
            color: var(--dark-slate); /* Diubah ke warna gelap agar kontras */
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .info-box p {
            font-size: 15px; /* Ukuran naik dari 14px */
            color: var(--dark-slate);
            font-weight: 500;
            background-color: #F8FAFC;
            padding: 14px 18px; /* Padding ditambah agar field box lebih proporsional */
            border-radius: 12px;
            border: 1px solid var(--border-soft);
        }

        /* SEKSI SKILL */
        .skills-section {
            margin-bottom: 36px;
        }

        .skills-section label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--dark-slate);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 14px;
        }

        .skills-flex {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .skill-badge {
            background-color: #EFF6FF;
            color: var(--royal-blue);
            font-size: 14px; /* Ukuran naik dari 12px */
            font-weight: 600; /* Lebih tegas */
            padding: 8px 18px;
            border-radius: 20px;
            border: 1px solid #BFDBFE;
        }

        /* SEKSI DOKUMEN CV */
        .cv-section label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--dark-slate);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 14px;
        }

        .cv-card-mini {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            background-color: #FFF7ED; 
            border: 1px solid #FFEDD5;
            border-radius: 14px;
        }

        .cv-info-flex {
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 15px; /* Ukuran naik dari 13px */
            font-weight: 600;
            color: #C2410C;
        }

        .cv-info-flex i { font-size: 22px; }

        .btn-cv-action {
            background-color: var(--white);
            color: var(--royal-blue);
            border: 1px solid var(--royal-blue);
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-cv-action:hover { 
            background-color: var(--royal-blue);
            color: var(--white);
        }
    </style>
</head>
<body>

<div class="dashboard-container">

    <!-- Memanggil komponen sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Area Konten Utama -->
    <main class="main-content">

        <!-- Banner Atas -->
        <section class="welcome-banner">
            <h1>Profil Karier 👤</h1>
            <p>Data resume personal dan kompetensi keahlian yang terdaftar di sistem.</p>
        </section>

        <!-- Kartu Profil Standar Keterbacaan Tinggi -->
        <div class="profile-card">
            
            <!-- Avatar & Nama Utama -->
            <div class="profile-header-section">
                <div class="profile-avatar">JS</div>
                <div class="profile-title-meta">
                    <h2><?= $name; ?></h2>
                    <p><i class="fa-solid fa-graduation-cap"></i> <?= $major; ?></p>
                </div>
            </div>

            <!-- Detail Informasi Utama -->
            <div class="info-grid">
                <div class="info-box">
                    <label>Alamat Email</label>
                    <p><?= $email; ?></p>
                </div>
                <div class="info-box">
                    <label>Nomor Telepon</label>
                    <p><?= $phone; ?></p>
                </div>
            </div>

            <!-- Bagian Kompetensi Keahlian -->
            <div class="skills-section">
                <label>Fokus Kompetensi Keahlian</label>
                <div class="skills-flex">
                    <?php foreach ($skills as $skill): ?>
                        <span class="skill-badge"><?= $skill; ?></span>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Bagian Lampiran File CV -->
            <div class="cv-section">
                <label>Berkas Resume Aktif</label>
                <div class="cv-card-mini">
                    <div class="cv-info-flex">
                        <i class="fa-solid fa-file-pdf"></i>
                        <span><?= $cv; ?></span>
                    </div>
                    <a href="#" class="btn-cv-action">Ganti Berkas</a>
                </div>
            </div>

        </div>

    </main>
</div>

</body>
</html>