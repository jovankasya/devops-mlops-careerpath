<?php
session_start();

// Mengunci data agar sinkron dengan dashboard.php
$user_name = "Jovanka Syakira";
$major = "S1 Informatika";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lamaran Saya - CareerPath</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
        
        :root {
            --bg-main: #F8FAFC;         
            --white: #FFFFFF;
            --border-soft: #E2E8F0;     
            --dark-slate: #0F172A;      
            --text-muted: #64748B;      
            --royal-blue: #2563EB;      
            --royal-gradient: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
        }

        body { 
            background-color: var(--bg-main); 
            color: var(--dark-slate);
            overflow-x: hidden;
        }
        
        /* Layout Container utama (Wajib sama dengan dashboard.php) */
        .dashboard-container { 
            display: flex; 
            width: 100vw;
            min-height: 100vh; 
        }

        /* Area Konten Utama */
        .main-content { 
            flex: 1; 
            padding: 40px; 
            height: 100vh;
            overflow-y: auto;
        }

        /* BANNER ATAS - KEMBALI KE ROYAL BLUE SEGAR (SINKRON DASHBOARD) */
        .welcome-banner {
            background: var(--royal-gradient);
            border-radius: 24px;
            padding: 40px;
            color: var(--white);
            margin-bottom: 32px;
            box-shadow: 0 12px 30px -10px rgba(37, 99, 235, 0.3);
        }

        .welcome-text h1 { font-size: 30px; font-weight: 700; margin-bottom: 6px; }
        .welcome-text p { color: #BFDBFE; font-size: 15px; max-width: 700px; }

        /* GRID SYSTEM UNTUK 3 KOLOM CARD */
        .jobs-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 1200px) {
            .jobs-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .jobs-grid { grid-template-columns: 1fr; }
        }

        .job-card {
            background: var(--white);
            border-radius: 24px;
            padding: 32px;
            border: 1px solid var(--border-soft);
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.01);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.2s;
        }
        
        .job-card:hover {
            transform: translateY(-3px);
        }

        .card-header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        /* Inisial Perusahaan Bulat */
        .company-logo-badge {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
        }

        /* Status Badge Pills */
        .badge-status {
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .badge-wawancara { background-color: #FEF3C7; color: #D97706; }
        .badge-berkas { background-color: #E0F2FE; color: #0284C7; }
        .badge-diterima { background-color: #D1FAE5; color: #059669; }

        .badge-status::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: currentColor;
        }

        .job-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark-slate);
            margin-bottom: 4px;
        }

        .company-name {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 20px;
        }

        /* Detail Meta Konten */
        .job-meta-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 24px;
        }
        
        .job-meta-info span {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .job-meta-info span i { 
            width: 16px;
            color: #94A3B8; 
        }

        /* Tags Kategori */
        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 28px;
        }

        .tag-item {
            background-color: #F1F5F9;
            color: #64748B;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Tombol Biru Solid Kreatif */
        .btn-progress {
            display: block;
            width: 100%;
            background: var(--royal-gradient);
            color: var(--white) !important;
            text-align: center;
            text-decoration: none;
            padding: 14px 0;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
            transition: opacity 0.2s;
        }

        .btn-progress:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<div class="dashboard-container">

    <?php include 'includes/sidebar.php'; ?>

    <main class="main-content">

        <section class="welcome-banner">
            <div class="welcome-text">
                <h1>Status Lamaran Saya 📂</h1>
                <p>Pantau seluruh riwayat berkas, tahapan seleksi, dan undangan wawancara aktif Anda secara transparan.</p>
            </div>
        </section>

        <div class="jobs-grid">
            
            <div class="job-card">
                <div>
                    <div class="card-header-top">
                        <div class="company-logo-badge" style="background-color: #EFF6FF; color: #2563EB;">GJ</div>
                        <span class="badge-status badge-wawancara">Wawancara</span>
                    </div>
                    <h3 class="job-title">UI/UX Intern</h3>
                    <p class="company-name">Gojek Indonesia</p>
                    
                    <div class="job-meta-info">
                        <span><i class="fa-solid fa-location-dot"></i> Remote</span>
                        <span><i class="fa-solid fa-calendar"></i> Dikirim: 08 Juli 2026</span>
                    </div>
                    
                    <div class="tags-container">
                        <span class="tag-item">Figma</span>
                        <span class="tag-item">User Research</span>
                        <span class="tag-item">Prototype</span>
                    </div>
                </div>
                <a href="application-progress.php" class="btn-progress">Lihat Progres Seleksi</a>
            </div>

            <div class="job-card">
                <div>
                    <div class="card-header-top">
                        <div class="company-logo-badge" style="background-color: #F0FDF4; color: #16A34A;">TK</div>
                        <span class="badge-status badge-berkas">Seleksi Berkas</span>
                    </div>
                    <h3 class="job-title">Frontend Developer</h3>
                    <p class="company-name">Tokopedia</p>
                    
                    <div class="job-meta-info">
                        <span><i class="fa-solid fa-location-dot"></i> Jakarta</span>
                        <span><i class="fa-solid fa-calendar"></i> Dikirim: 02 Juli 2026</span>
                    </div>
                    
                    <div class="tags-container">
                        <span class="tag-item">React</span>
                        <span class="tag-item">NextJS</span>
                        <span class="tag-item">TypeScript</span>
                    </div>
                </div>
                <a href="application-progress.php" class="btn-progress">Lihat Progres Seleksi</a>
            </div>

            <div class="job-card">
                <div>
                    <div class="card-header-top">
                        <div class="company-logo-badge" style="background-color: #FFF7ED; color: #EA580C;">BN</div>
                        <span class="badge-status badge-diterima">Diterima</span>
                    </div>
                    <h3 class="job-title">Analis Data Magang</h3>
                    <p class="company-name">BNI</p>
                    
                    <div class="job-meta-info">
                        <span><i class="fa-solid fa-location-dot"></i> Hybrid</span>
                        <span><i class="fa-solid fa-calendar"></i> Dikirim: 25 Juni 2026</span>
                    </div>
                    
                    <div class="tags-container">
                        <span class="tag-item">Python</span>
                        <span class="tag-item">SQL</span>
                        <span class="tag-item">Tableau</span>
                    </div>
                </div>
                <a href="application-progress.php" class="btn-progress">Lihat Progres Seleksi</a>
            </div>

        </div>

    </main>
</div>

</body>
</html>