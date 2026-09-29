<?php
// Wajib jalankan session agar siklus pendaftaran aman
session_start();

// Tangkap ID dari URL, jika tidak ada, default ke ID 1
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// Mock database lowongan kerja
$jobs = [
    1 => [
        'logo' => 'GJ',
        'title' => 'UI/UX Intern',
        'company' => 'Gojek Indonesia',
        'location' => 'Remote',
        'salary' => 'Rp 2 Juta / Bulan',
        'match' => '95%',
        'field' => 'UI/UX Design',
        'bg_logo' => '#EFF6FF',
        'text_logo' => '#2563EB',
    ],
    2 => [
        'logo' => 'TK',
        'title' => 'Frontend Developer',
        'company' => 'Tokopedia',
        'location' => 'Jakarta',
        'salary' => 'Rp 8 Juta / Bulan',
        'match' => '90%',
        'field' => 'Web Development',
        'bg_logo' => '#F0FDF4',
        'text_logo' => '#16A34A',
    ],
    3 => [
        'logo' => 'BN',
        'title' => 'Analis Data Magang',
        'company' => 'BNI',
        'location' => 'Hybrid',
        'salary' => 'Rp 1,5 Juta / Bulan',
        'match' => '88%',
        'field' => 'Data Analytics',
        'bg_logo' => '#FFF7ED',
        'text_logo' => '#EA580C',
    ],
    4 => [
        'logo' => 'SP',
        'title' => 'UI Designer',
        'company' => 'Shopee',
        'location' => 'Jakarta',
        'salary' => 'Rp 4 Juta / Bulan',
        'match' => '92%',
        'field' => 'UI Design',
        'bg_logo' => '#EFF6FF',
        'text_logo' => '#3B82F6',
    ]
];

if (!array_key_exists($id, $jobs)) {
    $id = 1;
}

$job = $jobs[$id];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lowongan: <?= $job['title']; ?> - CareerPath</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* RESET DASAR GLOBAL */
        * { 
            box-sizing: border-box; 
            margin: 0; 
            padding: 0; 
            font-family: 'Poppins', sans-serif; 
        }
        
        :root {
            --bg-main: #EBF3F9;         /* Latar belakang biru pastel super lembut */
            --white: #FFFFFF;
            --border-soft: #CBD5E1;
            --dark-slate: #0F172A;
            --text-muted: #475569;
            --gradient-primary: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
        }

        body { 
            background-color: var(--bg-main); 
            color: var(--dark-slate);
            overflow-x: hidden;
        }
        
        /* PEMBUNGKUS LAYOUT DASHBOARD UTAMA */
        .dashboard-container { 
            display: flex; 
            width: 100vw;
            min-height: 100vh; 
            align-items: stretch;
        }

        /* AREA KONTEN UTAMA KANAN (DIPAKSA SCROLL JIKA KONTEN PANJANG) */
        .main-content { 
            flex: 1; 
            padding: 40px; 
            background-color: var(--bg-main);
            height: 100vh;
            overflow-y: auto;
        }

        /* HERO BANNER ATAS */
        .job-detail-hero {
            background: var(--gradient-primary);
            border-radius: 20px;
            padding: 36px;
            color: var(--white);
            display: flex;
            flex-direction: column;
            gap: 20px;
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.15);
            margin-bottom: 32px;
        }

        .hero-main-info { 
            display: flex; 
            align-items: center; 
            gap: 20px; 
        }
        
        .company-badge { 
            width: 64px; 
            height: 64px; 
            border-radius: 14px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-weight: 700; 
            font-size: 22px; 
        }
        
        .job-detail-hero h1 { 
            font-size: 26px; 
            font-weight: 700; 
            color: var(--white); 
            margin-bottom: 4px;
        }
        
        .job-detail-hero p { 
            color: #BFDBFE; 
            font-size: 14px; 
        }

        .hero-badges { 
            display: flex; 
            flex-wrap: wrap; 
            gap: 12px; 
        }
        
        .salary-box { 
            background: rgba(255, 255, 255, 0.15); 
            border: 1px solid rgba(255, 255, 255, 0.2); 
            color: var(--white); 
            padding: 8px 16px; 
            border-radius: 8px; 
            font-size: 13px; 
            font-weight: 600; 
        }

        /* KARTU KONTEN PUTIH ELEGAN */
        .glass-card { 
            background: var(--white); 
            border-radius: 16px; 
            padding: 28px; 
            border: 1px solid var(--border-soft); 
            box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.02); 
            margin-bottom: 24px; 
        }
        
        .glass-card h2 { 
            font-size: 16px; 
            font-weight: 700; 
            color: var(--dark-slate); 
            margin-bottom: 16px; 
            border-bottom: 2px solid #E2E8F0; 
            padding-bottom: 10px; 
        }
        
        .glass-card p { 
            font-size: 14px; 
            color: #475569; 
            line-height: 1.7; 
        }

        /* GRID PEMBAGI DUA KOLOM */
        .job-detail-layout { 
            display: grid; 
            grid-template-columns: 2fr 1fr; 
            gap: 24px; 
        }

        .detail-list { 
            padding-left: 20px; 
            display: flex; 
            flex-direction: column; 
            gap: 10px; 
        }
        
        .detail-list li { 
            font-size: 14px; 
            color: #475569; 
            line-height: 1.5; 
        }

        /* TOMBOL AKSI DAFTAR */
        .apply-big-btn { 
            display: block; 
            text-align: center; 
            background: var(--gradient-primary); 
            color: var(--white) !important; 
            font-weight: 600; 
            font-size: 14px; 
            padding: 14px; 
            border-radius: 12px; 
            text-decoration: none; 
            margin-bottom: 12px; 
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); 
            transition: all 0.2s ease; 
        }
        
        .apply-big-btn:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.3);
        }
        
        .save-job-btn { 
            display: block; 
            text-align: center; 
            background-color: #F8FAFC; 
            color: var(--text-muted) !important; 
            font-weight: 600; 
            font-size: 14px; 
            padding: 14px; 
            border-radius: 12px; 
            text-decoration: none; 
            border: 1px solid var(--border-soft); 
        }

        /* INDICATOR PROGRESS KECOCOKAN */
        .skill-progress { 
            margin-bottom: 16px; 
        }
        
        .skill-progress span { 
            display: block; 
            font-size: 13px; 
            font-weight: 600; 
            color: var(--dark-slate); 
            margin-bottom: 8px; 
        }
        
        .bar { 
            background-color: #E2E8F0; 
            height: 10px; 
            border-radius: 100px; 
            overflow: hidden; 
        }
        
        .bar-fill { 
            height: 100%; 
            background: var(--gradient-primary); 
            border-radius: 100px; 
            width: 92%; 
        }
    </style>
</head>
<body>

<div class="dashboard-container">

    <?php include 'includes/sidebar.php'; ?>

    <main class="main-content">

        <section class="job-detail-hero">
            <div class="hero-main-info">
                <div class="company-badge" style="background-color: <?= $job['bg_logo']; ?>; color: <?= $job['text_logo']; ?>;">
                    <?= $job['logo']; ?>
                </div>
                <div>
                    <h1><?= $job['title']; ?></h1>
                    <p><?= $job['company']; ?> • <i class="fa-solid fa-location-dot" style="margin-left: 4px; margin-right: 2px;"></i> <?= $job['location']; ?></p>
                </div>
            </div>
            <div class="hero-badges">
                <div class="salary-box"><i class="fa-solid fa-wallet" style="margin-right: 6px;"></i><?= $job['salary']; ?></div>
                <div class="salary-box"><i class="fa-solid fa-circle-check" style="margin-right: 6px;"></i>Profil Cocok <?= $job['match']; ?></div>
            </div>
        </section>

        <div class="job-detail-layout">
            
            <div>
                <div class="glass-card">
                    <h2>Deskripsi Lowongan</h2>
                    <p>Membuka kesempatan emas bagi mahasiswa aktif tingkat akhir maupun fresh graduate yang berdedikasi tinggi serta memiliki minat karir besar di bidang <strong><?= $job['field']; ?></strong> untuk bergabung bersama tim akselerasi perusahaan.</p>
                </div>

                <div class="glass-card">
                    <h2>Tanggung Jawab Pekerjaan</h2>
                    <ul class="detail-list">
                        <li>Membantu proses riset, pemetaan masalah, dan pengumpulan data lapangan dari pengguna.</li>
                        <li>Membuat komponen aset digital, kerangka kawat (wireframe), serta prototype interaktif beresolusi tinggi.</li>
                        <li>Berkolaborasi intensif setiap minggunya bersama tim manajemen produk dan tim engineer software.</li>
                    </ul>
                </div>

                <div class="glass-card">
                    <h2>Kecocokan Kompetensi Kurikulum</h2>
                    <div class="skill-progress">
                        <span>Kesesuaian Transkrip & Portofolio Anda</span>
                        <div class="bar">
                            <div class="bar-fill"></div>
                        </div>
                    </div>
                    <p style="font-size: 13px; color: var(--text-muted); margin-top: 8px;">Mata kuliah Rekayasa Perangkat Lunak & Desain Antarmuka Anda sangat mendukung posisi ini.</p>
                </div>
            </div>

            <div>
                <div class="glass-card">
                    <h2>Aksi Pendaftaran</h2>
                    <a href="apply-form.php?id=<?= $id; ?>" class="apply-big-btn">
                        Kirim Lamaran Sekarang
                    </a>
                    <a href="#" class="save-job-btn"><i class="fa-regular fa-bookmark" style="margin-right: 6px;"></i> Simpan Lowongan</a>
                </div>

                <div class="glass-card">
                    <h2>Ringkasan Kontrak</h2>
                    <p style="font-size: 13.5px; color: var(--text-muted); line-height: 1.8;">
                        <i class="fa-solid fa-calendar-day" style="width: 20px;"></i> Durasi: 6 Bulan Magang<br>
                        <i class="fa-solid fa-tags" style="width: 20px;"></i> Kategori: <?= $job['field']; ?><br>
                        <i class="fa-solid fa-clock" style="width: 20px;"></i> Batas Akhir: 30 Juni 2026
                    </p>
                </div>
            </div>

        </div>

    </main>
</div>

</body>
</html>