<?php
require_once __DIR__ . '/includes/database.php';
$user = requireRole('mahasiswa');
$applicationId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$statement = db()->prepare(
    'SELECT a.id, a.status, a.applied_at, j.title, j.location, j.employment_type,
            j.logo_text, c.name AS company
     FROM applications a
     JOIN jobs j ON j.id = a.job_id
     JOIN companies c ON c.id = j.company_id
     WHERE a.id = :application_id AND a.student_id = :student_id'
);
$statement->execute([
    'application_id' => $applicationId ?: 0,
    'student_id' => $user['id'],
]);
$application = $statement->fetch();
if (!$application) {
    http_response_code(404);
    exit('Lamaran tidak ditemukan.');
}
$historyStatement = db()->prepare(
    'SELECT status, note, created_at
     FROM application_status_history
     WHERE application_id = :application_id
     ORDER BY created_at ASC, id ASC'
);
$historyStatement->execute(['application_id' => $application['id']]);
$history = $historyStatement->fetchAll();
$statusLabels = [
    'submitted' => 'Lamaran terkirim',
    'document_review' => 'Seleksi berkas',
    'interview' => 'Wawancara',
    'accepted' => 'Diterima',
    'rejected' => 'Ditolak',
    'withdrawn' => 'Dibatalkan',
];
$workTypeLabels = ['internship' => 'Magang', 'full_time' => 'Penuh waktu', 'part_time' => 'Paruh waktu', 'contract' => 'Kontrak'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progres Seleksi - CareerPath</title>

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
            --success-green: #10B981;
        }

        body { 
            background-color: var(--bg-main); 
            color: var(--dark-slate);
            overflow-x: hidden;
        }
        
        /* Layout Pembungkus Utama (Wajib sama persis dengan dashboard.php) */
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

        /* Tombol Kembali */
        .btn-back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--royal-blue);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 24px;
            transition: transform 0.2s;
        }
        .btn-back-link:hover {
            transform: translateX(-4px);
        }

        /* HEADER DETAIL DETAIL PEKERJAAN */
        .job-detail-header-card {
            background-color: var(--white);
            border: 1px solid var(--border-soft);
            border-radius: 24px;
            padding: 32px;
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.01);
        }

        .company-profile-meta {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .company-logo-large {
            width: 64px;
            height: 64px;
            background-color: #EFF6FF;
            color: var(--royal-blue);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: 800;
        }

        .job-info-text h1 { font-size: 22px; font-weight: 700; color: var(--dark-slate); }
        .job-info-text p { font-size: 14px; color: var(--text-muted); font-weight: 500; margin-top: 2px; }

        .current-status-tag {
            background-color: #FEF3C7;
            color: #D97706;
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 700;
        }

        /* LAYOUT UTAMA: TIMELINE & SUMMARY DETAIL */
        .progress-layout-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        @media (max-width: 1024px) {
            .progress-layout-grid { grid-template-columns: 1fr; }
        }

        /* TIMELINE SELEKSI VERTIKAL KREATIF */
        .timeline-card {
            background-color: var(--white);
            border: 1px solid var(--border-soft);
            border-radius: 24px;
            padding: 40px;
        }

        .timeline-card h2 { font-size: 18px; font-weight: 700; margin-bottom: 32px; }

        .timeline-container {
            position: relative;
            padding-left: 36px;
        }

        /* Garis vertikal penghubung timeline */
        .timeline-container::before {
            content: '';
            position: absolute;
            left: 11px;
            top: 6px;
            bottom: 6px;
            width: 2px;
            background-color: #E2E8F0;
        }

        .timeline-step {
            position: relative;
            margin-bottom: 36px;
        }
        .timeline-step:last-child { margin-bottom: 0; }

        /* Lingkaran Indikator */
        .timeline-icon-node {
            position: absolute;
            left: -36px;
            top: 2px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: var(--white);
            border: 2px solid #CBD5E1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            color: #94A3B8;
            z-index: 2;
        }

        /* Kondisi Tahap Selesai / Sukses */
        .timeline-step.completed .timeline-icon-node {
            background-color: var(--success-green);
            border-color: var(--success-green);
            color: var(--white);
        }

        /* Kondisi Tahap Sedang Aktif saat ini */
        .timeline-step.current .timeline-icon-node {
            background-color: var(--royal-blue);
            border-color: var(--royal-blue);
            color: var(--white);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.2);
        }

        .timeline-content-box h3 { font-size: 15px; font-weight: 700; color: var(--dark-slate); }
        .timeline-content-box .time-stamp { font-size: 12px; color: var(--text-muted); font-weight: 500; margin-top: 2px; display: block; }
        .timeline-content-box p { font-size: 13.5px; color: #475569; margin-top: 8px; line-height: 1.5; }

        /* BLOK INFORMASI KANAN (SUMMARY AKSI) */
        .info-sidebar-block {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .summary-card {
            background-color: var(--white);
            border: 1px solid var(--border-soft);
            border-radius: 24px;
            padding: 28px;
        }

        .summary-card h3 { font-size: 15px; font-weight: 700; margin-bottom: 16px; }
        
        .summary-info-list { list-style: none; display: flex; flex-direction: column; gap: 14px; }
        .summary-info-list li { font-size: 13px; color: #475569; display: flex; justify-content: space-between; }
        .summary-info-list li span:last-child { font-weight: 600; color: var(--dark-slate); }

        .btn-action-wawancara {
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
            margin-top: 16px;
        }
        .btn-action-wawancara:hover { opacity: 0.9; }
    </style>
</head>
<body>

<div class="dashboard-container">

    <?php include 'includes/sidebar.php'; ?>

    <main class="main-content">

        <a href="applications.php" class="btn-back-link">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Lamaran Saya
        </a>

        <section class="job-detail-header-card">
            <div class="company-profile-meta">
                <div class="company-logo-large"><?= h($application['logo_text'] ?: strtoupper(substr($application['company'], 0, 2))); ?></div>
                <div class="job-info-text">
                    <h1><?= h($application['title']); ?></h1>
                    <p><?= h($application['company']); ?> • <?= h($workTypeLabels[$application['employment_type']] ?? $application['employment_type']); ?> • <?= h($application['location']); ?></p>
                </div>
            </div>
            <div class="current-status-tag">
                <i class="fa-solid fa-clock"></i> <?= h($statusLabels[$application['status']] ?? $application['status']); ?>
            </div>
        </section>

        <div class="progress-layout-grid">
            
            <div class="timeline-card">
                <h2>Alur Seleksi Lamaran Kerja Anda</h2>
                
                <div class="timeline-container">
                    <?php foreach ($history as $index => $event): ?>
                        <div class="timeline-step <?= $index === count($history) - 1 ? 'current' : 'completed'; ?>">
                            <div class="timeline-icon-node"><i class="fa-solid <?= $index === count($history) - 1 ? 'fa-clock' : 'fa-check'; ?>"></i></div>
                            <div class="timeline-content-box">
                                <h3><?= h($statusLabels[$event['status']] ?? $event['status']); ?></h3>
                                <span class="time-stamp"><?= h(date('d M Y H:i', strtotime($event['created_at']))); ?></span>
                                <p><?= h($event['note'] ?: 'Status lamaran diperbarui.'); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="info-sidebar-block">
                
                <div class="summary-card">
                    <h3>Informasi Lamaran</h3>
                    <ul class="summary-info-list">
                        <li><span>ID Lamaran</span> <span>#<?= (int) $application['id']; ?></span></li>
                        <li><span>Tanggal Kirim</span> <span><?= h(date('d M Y', strtotime($application['applied_at']))); ?></span></li>
                        <li><span>Posisi</span> <span><?= h($application['title']); ?></span></li>
                        <li><span>Tipe Kerja</span> <span><?= h($application['location']); ?></span></li>
                    </ul>
                    
                </div>

                <div class="summary-card" style="border-left: 4px solid var(--royal-blue);">
                    <h3>Butuh Bantuan?</h3>
                    <p style="font-size: 13px; color: var(--text-muted); line-height: 1.5;">Jika mengalami kendala teknis mengenai pemanggilan jadwal wawancara, harap hubungi Helpdesk Kampus / Career Center Mitra.</p>
                </div>

            </div>

        </div>

    </main>
</div>

</body>
</html>