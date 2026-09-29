<?php
session_start();

// Mock data posisi yang sedang dilamar (dinamis berdasarkan alur)
$job_title = "UI/UX Intern";
$company = "Gojek Indonesia";
$logo = "GJ";
$bg_logo = "#EFF6FF";
$text_logo = "#2563EB";

// Data berkas pelamar saat ini
$user_cv = "CV_Jovanka_Syakira.pdf";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Lamaran - CareerPath</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
        
        :root {
            --bg-main: #F1F5F9;         
            --white: #FFFFFF;
            --border-soft: #CBD5E1;     
            --dark-slate: #0F172A;      
            --text-muted: #475569;      
            --royal-blue: #2563EB;      
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

        /* BANNER TOP */
        .welcome-banner {
            background-color: var(--royal-blue);
            border-radius: 20px;
            padding: 32px 40px;
            color: var(--white);
            margin-bottom: 32px;
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.15);
        }

        .welcome-banner h1 { font-size: 26px; font-weight: 700; margin-bottom: 4px; }
        .welcome-banner p { color: #E0F2FE; font-size: 14px; opacity: 0.95; }

        /* FORM CARD */
        .form-card {
            background-color: var(--white);
            border: 1px solid var(--border-soft);
            border-radius: 20px;
            padding: 40px;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        /* REVIU PEKERJAAN YANG DILAMAR */
        .job-review-box {
            display: flex;
            align-items: center;
            gap: 20px;
            background-color: #F8FAFC;
            padding: 20px;
            border-radius: 14px;
            border: 1px solid #E2E8F0;
            margin-bottom: 32px;
        }

        .company-logo {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 20px;
        }

        .job-review-meta h3 { font-size: 18px; font-weight: 700; color: var(--dark-slate); }
        .job-review-meta p { font-size: 14px; color: var(--text-muted); font-weight: 500; }

        /* INPUT FIELD STYLES */
        .form-group {
            margin-bottom: 28px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--dark-slate);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        /* BERKAS CV BOX */
        .attached-cv-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            background-color: #EFF6FF;
            border: 1px solid #BFDBFE;
            border-radius: 12px;
        }

        .cv-file-info {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            font-weight: 600;
            color: var(--royal-blue);
        }
        .cv-file-info i { font-size: 20px; }

        .change-link {
            font-size: 13px;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
        }
        .change-link:hover { color: var(--royal-blue); }

        /* TEXTAREA */
        .form-textarea {
            width: 100%;
            height: 150px;
            padding: 16px;
            border-radius: 12px;
            border: 1px solid var(--border-soft);
            background-color: #F8FAFC;
            font-size: 14px;
            color: var(--dark-slate);
            outline: none;
            resize: none;
            transition: border-color 0.2s;
        }

        .form-textarea:focus {
            border-color: var(--royal-blue);
            background-color: var(--white);
        }

        /* BUTTON GROUP */
        .action-group {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 16px;
            border-top: 2px solid #F1F5F9;
            padding-top: 28px;
            margin-top: 12px;
        }

        .btn-cancel {
            padding: 12px 24px;
            background-color: #F1F5F9;
            color: var(--text-muted);
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: background 0.2s;
        }
        .btn-cancel:hover { background-color: #E2E8F0; color: var(--dark-slate); }

        .btn-submit {
            padding: 12px 32px;
            background-color: var(--royal-blue);
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-submit:hover { background-color: #1D4ED8; }
    </style>
</head>
<body>

<div class="dashboard-container">

    <?php include 'includes/sidebar.php'; ?>

    <main class="main-content">

        <section class="welcome-banner">
            <h1>Konfirmasi Berkas Lamaran 📝</h1>
            <p>Tinjau kembali kelengkapan profil dan dokumen Anda sebelum dikirimkan ke perusahaan mitra.</p>
        </section>

        <div class="form-card">
            
            <div class="job-review-box">
                <div class="company-logo" style="background-color: <?= $bg_logo; ?>; color: <?= $text_logo; ?>;">
                    <?= $logo; ?>
                </div>
                <div class="job-review-meta">
                    <h3><?= $job_title; ?></h3>
                    <p><?= $company; ?></p>
                </div>
            </div>

            <form action="apply-process.php" method="POST">
                
                <div class="form-group">
                    <label>Dokumen Utama (CV / Resume)</label>
                    <div class="attached-cv-box">
                        <div class="cv-file-info">
                            <i class="fa-solid fa-file-pdf"></i>
                            <span><?= $user_cv; ?></span>
                        </div>
                        <a href="profile.php" class="change-link"><i class="fa-solid fa-pen-to-square"></i> Ubah di Profil</a>
                    </div>
                </div>

                <div class="form-group">
                    <label>Pesan Pengantar / Cover Letter (Opsional)</label>
                    <textarea class="form-textarea" name="cover_letter" placeholder="Tuliskan perkenalan singkat dan alasan mengapa Anda tertarik dengan posisi magang ini..."></textarea>
                </div>

                <div class="action-group">
                    <a href="job-detail.php?id=1" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit">
                        Kirim Lamaran Sekarang <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>

            </form>

        </div>

    </main>
</div>

</body>
</html>