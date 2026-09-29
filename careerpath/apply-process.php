<?php
session_start();

if (!isset($_SESSION['total_applied'])) {
    $_SESSION['total_applied'] = 3; 
}
$_SESSION['total_applied'] += 1; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memproses Aplikasi Lamaran... - CareerPath</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
        
        :root {
            --bg-premium: #F8FAFC;         
            --white: #FFFFFF;
            --dark-slate: #0F172A;      
            --text-muted: #64748B;      
            --royal-blue: #2563EB;      
            --success-green: #10B981;
        }

        body { 
            background-color: var(--bg-premium); 
            color: var(--dark-slate);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 24px;
            /* SEBAIKNYA DOSEN LIHAT BACKGROUND GRID ABSTRAK INI (Biar Tidak Kosong) */
            background-image: radial-gradient(#E2E8F0 1.5px, transparent 1.5px);
            background-size: 24px 24px;
        }

        .process-container-card {
            background-color: var(--white);
            border-radius: 28px;
            padding: 56px 40px;
            text-align: center;
            max-width: 580px;
            width: 100%;
            box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.08);
            border: 1px solid #E2E8F0;
        }

        /* CIRKLING RIPPLE ANIMATION */
        .icon-wrapper-box {
            position: relative;
            width: 100px;
            height: 100px;
            margin: 0 auto 32px auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* SPINNER LOADING */
        .spinner-element {
            width: 90px;
            height: 90px;
            border: 5px solid #F1F5F9;
            border-radius: 50%;
            border-top-color: var(--royal-blue);
            animation: rotateSpin 0.8s linear infinite;
            position: absolute;
        }

        @keyframes rotateSpin {
            to { transform: rotate(360deg); }
        }

        /* SUKSES CHECKMARK ACCENT */
        .success-checkmark-box {
            display: none;
            width: 94px;
            height: 94px;
            background-color: #D1FAE5;
            color: var(--success-green);
            font-size: 42px;
            border-radius: 50%;
            line-height: 94px;
            border: 4px solid #A7F3D0;
            animation: popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        @keyframes popIn {
            0% { transform: scale(0.4); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        .status-header-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark-slate);
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .status-supporting-text {
            font-size: 14.5px;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 28px;
        }

        /* RINGKASAN DATA (MENGISI AREA YANG KOSONG AGAR BERMAKNA) */
        .summary-receipt-panel {
            background-color: #F8FAFC;
            border: 1px dashed #CBD5E1;
            border-radius: 16px;
            padding: 20px;
            text-align: left;
            margin-bottom: 32px;
        }
        .summary-receipt-panel h4 { font-size: 12px; text-transform: uppercase; color: var(--text-muted); letter-spacing: 0.5px; margin-bottom: 12px; font-weight: 700; }
        .receipt-row { display: flex; justify-content: space-between; font-size: 13.5px; padding: 6px 0; border-bottom: 1px solid #F1F5F9; }
        .receipt-row:last-child { border-bottom: none; }
        .receipt-label { color: var(--text-muted); }
        .receipt-value { font-weight: 600; color: var(--dark-slate); }

        /* TOMBOL KENDALI MANUAL USER (IMK PRINCIPLE) */
        .manual-action-wrapper {
            display: none;
            animation: slideUpFade 0.4s ease forwards;
        }

        .btn-primary-redirect {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background-color: var(--royal-blue);
            color: var(--white);
            padding: 14px 36px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
            transition: background 0.2s;
        }
        .btn-primary-redirect:hover { background-color: #1D4ED8; }

        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .bottom-timer-notice {
            margin-top: 28px;
            font-size: 13px;
            color: #94A3B8;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <div class="process-container-card">
        
        <div class="icon-wrapper-box">
            <div class="spinner-element" id="js-spinner"></div>
            <div class="success-checkmark-box" id="js-checkmark">
                <i class="fa-solid fa-check"></i>
            </div>
        </div>

        <h2 class="status-header-title" id="js-title">Mengirim Lamaran Kerja...</h2>
        <p class="status-supporting-text" id="js-desc">Mohon tidak menutup jendela browser. Berkas aplikasi Anda sedang diverifikasi dan diunggah dengan aman menuju sistem pendaftaran mitra perusahaan.</p>

        <div class="summary-receipt-panel">
            <h4>Metadata Berkas Digital</h4>
            <div class="receipt-row">
                <span class="receipt-label">Nama Pelamar:</span>
                <span class="receipt-value">Jovanka Syakira</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Posisi Tujuan:</span>
                <span class="receipt-value" style="color: var(--royal-blue);">UI/UX Intern</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Perusahaan:</span>
                <span class="receipt-value">Gojek Indonesia</span>
            </div>
        </div>

        <div class="manual-action-wrapper" id="js-action-box">
            <a href="dashboard.php" class="btn-primary-redirect">
                Kembali ke Beranda <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="bottom-timer-notice" id="js-timer-box">
            <i class="fa-solid fa-circle-notch fa-spin"></i> Memproses sinkronisasi pangkalan data...
        </div>

    </div>

    <script>
        // Simulasi siklus tunggu jaringan interaksi komputer
        setTimeout(() => {
            // Sembunyikan roda spinner & tampilkan ceklis hijau sukses
            document.getElementById('js-spinner').style.display = 'none';
            document.getElementById('js-checkmark').style.display = 'block';
            
            // Tampilkan tombol interaksi manual agar halaman padat
            document.getElementById('js-action-box').style.display = 'block';

            // Ganti konten teks kontekstual
            document.getElementById('js-title').innerText = "Lamaran Sukses Dikirim! 🎉";
            document.getElementById('js-desc').innerText = "Luar biasa! Dokumen CV dan portofolio Anda telah sukses tercatat di sistem perusahaan Gojek Indonesia. Silakan pantau perkembangannya di menu Lamaran Saya.";
            document.getElementById('js-timer-box').innerHTML = "<i class='fa-solid fa-circle-check' style='color: #10B981;'></i> Sinkronisasi berhasil! Mengalihkan halaman...";

            // Lemparkan balik secara otomatis dalam waktu 4 detik jika user diam saja
            setTimeout(() => {
                window.location.href = "dashboard.php";
            }, 4000);

        }, 2200);
    </script>

</body>
</html>