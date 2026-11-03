<?php
// Jalankan session untuk mengamankan data
session_start();

// Mock database semua lowongan kerja yang tersedia untuk dicari
$all_jobs = [
    [
        'id' => 1,
        'logo' => 'GJ',
        'title' => 'UI/UX Intern',
        'company' => 'Gojek Indonesia',
        'location' => 'Remote',
        'salary' => 'Rp 2 Juta / Bulan',
        'match' => '95% Cocok',
        'tags' => ['Figma', 'User Research', 'Prototype'],
        'bg_logo' => '#EFF6FF',
        'text_logo' => '#2563EB',
    ],
    [
        'id' => 2,
        'logo' => 'TK',
        'title' => 'Frontend Developer',
        'company' => 'Tokopedia',
        'location' => 'Jakarta',
        'salary' => 'Rp 8 Juta / Bulan',
        'match' => '90% Cocok',
        'tags' => ['React', 'NextJS', 'TypeScript'],
        'bg_logo' => '#F0FDF4',
        'text_logo' => '#16A34A',
    ],
    [
        'id' => 3,
        'logo' => 'BN',
        'title' => 'Analis Data Magang',
        'company' => 'BNI',
        'location' => 'Hybrid',
        'salary' => 'Rp 1,5 Juta / Bulan',
        'match' => '88% Cocok',
        'tags' => ['Python', 'SQL', 'Tableau'],
        'bg_logo' => '#FFF7ED',
        'text_logo' => '#EA580C',
    ],
    [
        'id' => 4,
        'logo' => 'SP',
        'title' => 'UI Designer',
        'company' => 'Shopee',
        'location' => 'Jakarta',
        'salary' => 'Rp 4 Juta / Bulan',
        'match' => '92% Cocok',
        'tags' => ['UI Design', 'Wireframing', 'Illustrator'],
        'bg_logo' => '#EFF6FF',
        'text_logo' => '#3B82F6',
    ],
    [
        'id' => 5,
        'logo' => 'TL',
        'title' => 'Digital Marketing Intern',
        'company' => 'Traveloka',
        'location' => 'Remote',
        'salary' => 'Rp 2 Juta / Bulan',
        'match' => '91% Cocok',
        'tags' => ['SEO', 'Copywriting', 'Google Ads'],
        'bg_logo' => '#F5F3FF',
        'text_logo' => '#8B5CF6',
    ],
    [
        'id' => 6,
        'logo' => 'BM',
        'title' => 'Business Analyst',
        'company' => 'Bank Mandiri',
        'location' => 'Jakarta',
        'salary' => 'Rp 6 Juta / Bulan',
        'match' => '87% Cocok',
        'tags' => ['Excel', 'BI Tools', 'Finance'],
        'bg_logo' => '#FEF2F2',
        'text_logo' => '#EF4444',
    ]
];

require_once __DIR__ . '/includes/database.php';
$query = trim($_GET['q'] ?? '');
$statement = db()->prepare(
    "SELECT j.id, j.title, j.location, j.salary_min, j.salary_max,
            j.logo_text, j.logo_background_color, j.logo_text_color, c.name AS company,
            GROUP_CONCAT(DISTINCT s.name ORDER BY s.name SEPARATOR '|') AS skills
     FROM jobs j
     JOIN companies c ON c.id = j.company_id
     LEFT JOIN job_skills js ON js.job_id = j.id
     LEFT JOIN skills s ON s.id = js.skill_id
     WHERE j.status = 'published'
       AND (j.deadline IS NULL OR j.deadline >= CURRENT_DATE)
       AND (:query = '' OR j.title LIKE :title_query OR c.name LIKE :company_query
            OR j.location LIKE :location_query)
     GROUP BY j.id
     ORDER BY j.published_at DESC, j.id"
);
$searchTerm = '%' . $query . '%';
$statement->execute([
    'query' => $query,
    'title_query' => $searchTerm,
    'company_query' => $searchTerm,
    'location_query' => $searchTerm,
]);
$all_jobs = [];
foreach ($statement->fetchAll() as $row) {
    $salaryMin = $row['salary_min'] === null ? null : (float) $row['salary_min'];
    $salaryMax = $row['salary_max'] === null ? null : (float) $row['salary_max'];
    $salary = $salaryMin === null ? 'Gaji tidak dicantumkan' : 'Rp ' . number_format($salaryMin, 0, ',', '.');
    if ($salaryMax !== null && $salaryMax !== $salaryMin) {
        $salary .= ' - Rp ' . number_format($salaryMax, 0, ',', '.');
    }

    $all_jobs[] = [
        'id' => (int) $row['id'],
        'logo' => $row['logo_text'] ?: strtoupper(substr($row['company'], 0, 2)),
        'title' => $row['title'],
        'company' => $row['company'],
        'location' => $row['location'],
        'salary' => $salary,
        'match' => 'Lowongan aktif',
        'tags' => $row['skills'] ? explode('|', $row['skills']) : [],
        'bg_logo' => $row['logo_background_color'] ?: '#EFF6FF',
        'text_logo' => $row['logo_text_color'] ?: '#2563EB',
    ];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Lowongan - CareerPath</title>

    <!-- Google Fonts & FontAwesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
        
        :root {
            --bg-main: #F1F5F9;         /* Latar abu-abu terang bersih */
            --white: #FFFFFF;
            --border-soft: #E2E8F0;
            --dark-slate: #1E293B;
            --text-muted: #64748B;
            --royal-blue: #2563EB;      /* Aksen Royal Blue menyala */
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
            align-items: stretch;
        }

        .main-content { 
            flex: 1; 
            padding: 40px; 
            background-color: var(--bg-main);
            height: 100vh;
            overflow-y: auto;
        }

        /* JUMBOTRON BANNER ATAS */
        .welcome-banner {
            background-color: var(--royal-blue);
            border-radius: 24px;
            padding: 40px;
            color: var(--white);
            margin-bottom: 32px;
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.2);
        }

        .welcome-banner h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .welcome-banner p {
            color: #E0F2FE;
            font-size: 14px;
            opacity: 0.9;
        }

        /* BAR PENCARIAN PUTIH TENGAH */
        .search-filter-card {
            background-color: var(--white);
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 32px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        }

        .search-input-wrapper {
            position: relative;
            flex: 1;
        }

        .search-input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .search-input-wrapper input {
            width: 100%;
            padding: 12px 16px 12px 48px;
            border: none;
            outline: none;
            font-size: 14px;
            color: var(--dark-slate);
        }

        .btn-search-trigger {
            background-color: var(--royal-blue);
            color: var(--white);
            border: none;
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-search-trigger:hover {
            background-color: #1D4ED8;
        }

        /* CARD GRID SYSTEM (3 KOLOM SEPERTI CONTOH) */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .job-card {
            background-color: var(--white);
            border: 1px solid var(--border-soft);
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.2s;
        }

        .job-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px -5px rgba(0,0,0,0.05);
        }

        .card-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .company-logo-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 16px;
        }

        /* BADGE KECOCOKAN HIJAU */
        .match-badge {
            background-color: #DCFCE7;
            color: #15803D;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .job-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark-slate);
            margin-bottom: 4px;
        }

        .company-name {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 16px;
        }

        /* METADATA INFO */
        .meta-info-wrapper {
            display: flex;
            flex-direction: column;
            gap: 8px;
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 20px;
        }

        .meta-info-wrapper span i {
            width: 18px;
            color: #94A3B8;
        }

        /* SKILL TAGS */
        .tags-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 24px;
        }

        .tag-item {
            background-color: #F1F5F9;
            color: #475569;
            font-size: 12px;
            padding: 4px 12px;
            border-radius: 6px;
            font-weight: 500;
        }

        /* BUTTON LIHAT DETAIL */
        .btn-action-view {
            display: block;
            text-align: center;
            background-color: var(--royal-blue);
            color: var(--white) !important;
            padding: 12px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .btn-action-view:hover {
            background-color: #1D4ED8;
        }
    </style>
</head>
<body>

<div class="dashboard-container">

    <!-- Memanggil komponen sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Area Konten Utama -->
    <main class="main-content">

        <!-- Banner Banner Eksplorasi Karir -->
        <section class="welcome-banner">
            <h1>Eksplorasi Karir Impianmu 🚀</h1>
            <p>Temukan program magang terbaik dengan kecocokan kompetensi akademismu secara transparan.</p>
        </section>

        <!-- Input Filter Pencarian -->
        <form class="search-filter-card" method="get">
            <div class="search-input-wrapper">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="q" value="<?= h($query); ?>" placeholder="Cari posisi magang atau nama perusahaan...">
            </div>
            <button type="submit" class="btn-search-trigger">Cari Lowongan</button>
        </form>

        <!-- Grid Tampilan Lowongan Kerja -->
        <div class="cards-grid">
            <?php foreach ($all_jobs as $job): ?>
            <div class="job-card">
                <div>
                    <!-- Header Card: Logo & Match Score -->
                    <div class="card-header-flex">
                        <div class="company-logo-box" style="background-color: <?= h($job['bg_logo']); ?>; color: <?= h($job['text_logo']); ?>;">
                            <?= h($job['logo']); ?>
                        </div>
                        <span class="match-badge">
                            <i class="fa-solid fa-star" style="font-size: 11px;"></i> <?= h($job['match']); ?>
                        </span>
                    </div>

                    <!-- Informasi Judul -->
                    <h3 class="job-title"><?= h($job['title']); ?></h3>
                    <p class="company-name"><?= h($job['company']); ?></p>

                    <!-- Lokasi & Gaji -->
                    <div class="meta-info-wrapper">
                        <span><i class="fa-solid fa-location-dot"></i> <?= h($job['location']); ?></span>
                        <span><i class="fa-solid fa-wallet"></i> <?= h($job['salary']); ?></span>
                    </div>

                    <!-- Tags Kunci Kompetensi -->
                    <div class="tags-wrapper">
                        <?php foreach ($job['tags'] as $tag): ?>
                            <span class="tag-item"><?= h($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Tombol Aksi Detail -->
                <a href="job-detail.php?id=<?= $job['id']; ?>" class="btn-action-view">
                    Lihat Detail Pekerjaan
                </a>
            </div>
            <?php endforeach; ?>
        </div>

    </main>
</div>

</body>
</html>