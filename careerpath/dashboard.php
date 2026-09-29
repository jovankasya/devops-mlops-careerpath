<?php
session_start();

// Mengunci angka agar sinkron dengan simulasi lamaran kerja
if (!isset($_SESSION['total_applied'])) {
    $_SESSION['total_applied'] = 3; 
}

$user_name = "Jovanka Syakira";
$major = "S1 Informatika";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Dashboard - CareerPath</title>

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

        /* BANNER ATAS - KEMBALI KE ROYAL BLUE SEGAR */
        .welcome-banner {
            background: var(--royal-gradient);
            border-radius: 24px;
            padding: 40px;
            color: var(--white);
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 12px 30px -10px rgba(37, 99, 235, 0.3);
        }

        .welcome-text h1 { font-size: 30px; font-weight: 700; margin-bottom: 6px; }
        .welcome-text p { color: #BFDBFE; font-size: 15px; margin-bottom: 24px; max-width: 550px; }

        .btn-banner-action {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background-color: var(--white);
            color: var(--royal-blue);
            padding: 14px 28px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
            transition: all 0.2s;
        }
        .btn-banner-action:hover { 
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .target-badge-box {
            background-color: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 24px 32px;
            border-radius: 20px;
            text-align: center;
        }
        .target-badge-box span { display: block; font-size: 12px; color: #E0F2FE; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
        .target-badge-box .badge-circle {
            width: 70px;
            height: 70px;
            background-color: var(--white);
            color: var(--royal-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 16px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.06);
        }

        /* CARDS STATISTIK */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background-color: var(--white);
            border: 1px solid var(--border-soft);
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.01);
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-3px); }
        .stat-card h3 { font-size: 36px; font-weight: 800; margin-bottom: 6px; line-height: 1; }
        .stat-card p { font-size: 14px; color: var(--text-muted); font-weight: 600; }

        /* QUICK ACTION BUTTONS */
        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .action-link-card {
            background-color: var(--white);
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            text-decoration: none;
            color: var(--dark-slate);
            font-weight: 600;
            font-size: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.01);
            transition: all 0.2s;
        }
        .action-link-card:hover {
            border-color: var(--royal-blue);
            color: var(--royal-blue);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.05);
        }
        .action-link-card i { font-size: 20px; color: var(--royal-blue); }

        /* LAYOUT DOUBLE BLOCK */
        .bottom-layout-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        .content-block {
            background-color: var(--white);
            border: 1px solid var(--border-soft);
            border-radius: 24px;
            padding: 32px;
        }

        .content-block h2 { font-size: 18px; font-weight: 700; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; }

        .recommendation-item {
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .rec-meta h4 { font-size: 16px; font-weight: 700; color: var(--dark-slate); }
        .rec-meta p { font-size: 14px; color: var(--text-muted); margin-top: 2px; }

        .btn-view-job {
            background-color: #EFF6FF;
            color: var(--royal-blue);
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: all 0.2s;
        }
        .btn-view-job:hover { background-color: var(--royal-blue); color: var(--white); }

        .notif-list { display: flex; flex-direction: column; gap: 16px; list-style: none; }
        .notif-list li { font-size: 14px; color: #334155; line-height: 1.6; position: relative; padding-left: 24px; font-weight: 500; }
        .notif-list li::before { content: '•'; color: #EF4444; font-size: 24px; position: absolute; left: 2px; top: -4px; }
    </style>
</head>
<body>

<div class="dashboard-container">

    <?php include 'includes/sidebar.php'; ?>

    <main class="main-content">

        <section class="welcome-banner">
            <div class="welcome-text">
                <h1>Selamat Datang, <?= $user_name; ?> 👋</h1>
                <p>Temukan berbagai lowongan program magang terbaik yang sesuai dengan kompetensi dan bidang fokus akademismu.</p>
                <a href="jobs.php" class="btn-banner-action">
                    <i class="fa-solid fa-magnifying-glass"></i> Cari Lowongan Baru
                </a>
            </div>
            <div class="target-badge-box">
                <span>Target Bidang</span>
                <div class="badge-circle">UI/UX</div>
            </div>
        </section>

        <section class="stats-grid">
            <div class="stat-card" style="border-left: 4px solid #3B82F6;">
                <h3 style="color: #3B82F6;">12</h3>
                <p>Lowongan Tersimpan</p>
            </div>
            
            <div class="stat-card" style="border-left: 4px solid #8B5CF6;">
                <h3 style="color: #8B5CF6;"><?= $_SESSION['total_applied']; ?></h3>
                <p>Lamaran Dikirim</p>
            </div>

            <div class="stat-card" style="border-left: 4px solid #06B6D4;">
                <h3 style="color: #06B6D4;">1</h3>
                <p>Undangan Wawancara</p>
            </div>
            <div class="stat-card" style="border-left: 4px solid #10B981;">
                <h3 style="color: #10B981;">5</h3>
                <p>Rekomendasi Karier</p>
            </div>
        </section>

        <section class="quick-actions-grid">
            <a href="profile.php" class="action-link-card">
                <i class="fa-solid fa-file-arrow-up"></i> Unggah Berkas CV
            </a>
            <a href="jobs.php" class="action-link-card">
                <i class="fa-solid fa-briefcase"></i> Eksplorasi Lowongan
            </a>
            <a href="profile.php" class="action-link-card">
                <i class="fa-solid fa-user-gear"></i> Perbarui Profil Saya
            </a>
            <a href="#" class="action-link-card">
                <i class="fa-solid fa-handshake"></i> Info Perusahaan Mitra
            </a>
        </section>

        <div class="bottom-layout-grid">
            <div class="content-block">
                <h2><i class="fa-solid fa-star" style="color: #F59E0B;"></i> Rekomendasi Teratas Untuk Anda</h2>
                <div class="recommendation-item">
                    <div class="rec-meta">
                        <h4>UI/UX Intern</h4>
                        <p>Gojek Indonesia • Jasa Teknologi • Remote</p>
                    </div>
                    <a href="job-detail.php?id=1" class="btn-view-job">Lihat Posisi</a>
                </div>
            </div>

            <div class="content-block">
                <h2><i class="fa-solid fa-bell" style="color: #EF4444;"></i> Pemberitahuan</h2>
                <ul class="notif-list">
                    <li>Undangan pengisian kuesioner jadwal wawancara dari Gojek Indonesia telah masuk.</li>
                </ul>
            </div>
        </div>

    </main>
</div>

</body>
</html>