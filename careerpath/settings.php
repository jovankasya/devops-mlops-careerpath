<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - CareerPath</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
        
        :root {
            --bg-main: #F1F5F9;         
            --white: #FFFFFF;
            --border-soft: #E2E8F0;     
            --dark-slate: #0F172A;      
            --text-muted: #64748B;      
            --royal-blue: #2563EB;      
            --royal-light: #EFF6FF;
            --success-green: #10B981;
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

        /* KEPALA HALAMAN */
        .page-header {
            margin-bottom: 32px;
        }
        .page-header h1 { font-size: 28px; font-weight: 700; color: var(--dark-slate); }
        .page-header p { color: var(--text-muted); font-size: 14.5px; margin-top: 4px; }

        /* CONTAINER CARD PUTIH UTAMA (Menyelaraskan dengan Lamaran Saya & Profil Saya) */
        .settings-main-wrapper {
            background-color: var(--white);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.02);
            border: 1px solid var(--border-soft);
            max-width: 1000px;
            width: 100%;
        }

        /* GRID STRUKTUR SECTION */
        .settings-sections-flex {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .settings-section-block {
            width: 100%;
        }

        .card-title-section {
            margin-bottom: 24px;
            border-bottom: 1px solid #F1F5F9;
            padding-bottom: 16px;
        }
        .card-title-section h2 { font-size: 18px; font-weight: 700; color: var(--dark-slate); display: flex; align-items: center; gap: 10px; }
        .card-title-section p { font-size: 13.5px; color: var(--text-muted); margin-top: 2px; }

        /* PILIHAN STATUS VISUAL DENGAN DROP SHADOW HALUS */
        .status-options-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .status-selectable-card {
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            padding: 24px;
            cursor: pointer;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            transition: all 0.25s ease;
            background: var(--white);
            /* POLESAN MINOR: Efek bayangan elegan */
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03); 
        }

        .status-selectable-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
            border-color: #CBD5E1;
        }

        /* Efek Aktif / Terpilih Secara Visual */
        .status-selectable-card.active {
            border-color: var(--royal-blue);
            background-color: var(--royal-light);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.08);
        }

        .status-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background-color: #F1F5F9;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: all 0.2s;
            flex-shrink: 0;
        }
        .status-selectable-card.active .icon-box-active-1 { background-color: var(--royal-blue); color: var(--white); }
        .status-selectable-card.active .icon-box-active-2 { background-color: var(--success-green); color: var(--white); }

        .status-info-text h3 { font-size: 15px; font-weight: 700; color: var(--dark-slate); }
        .status-info-text p { font-size: 13px; color: var(--text-muted); margin-top: 4px; line-height: 1.5; }

        /* FORM / TOGGLE LIST */
        .toggle-row-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid #F1F5F9;
        }
        .toggle-row-item:last-child { border-bottom: none; }
        
        .toggle-label-meta h4 { font-size: 14.5px; font-weight: 600; color: var(--dark-slate); }
        .toggle-label-meta p { font-size: 13px; color: var(--text-muted); margin-top: 2px; }

        /* CUSTOM TOGGLE SWITCH */
        .switch-control {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
            flex-shrink: 0;
        }
        .switch-control input { opacity: 0; width: 0; height: 0; }
        .slider-round {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #CBD5E1;
            transition: .3s;
            border-radius: 34px;
        }
        .slider-round::before {
            position: absolute;
            content: "";
            height: 18px; width: 18px;
            left: 4px; bottom: 4px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
        }
        input:checked + .slider-round { background-color: var(--royal-blue); }
        input:checked + .slider-round::before { transform: translateX(24px); }

        /* BUTTON SAVE PANEL */
        .save-action-panel {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
            border-top: 1px solid #E2E8F0;
            padding-top: 24px;
        }
        .btn-save-settings {
            background-color: var(--royal-blue);
            color: var(--white);
            padding: 14px 36px;
            border-radius: 12px;
            border: none;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
            transition: all 0.2s;
        }
        .btn-save-settings:hover { 
            background-color: #1D4ED8; 
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
        }
    </style>
</head>
<body>

<div class="dashboard-container">

    <?php include 'includes/sidebar.php'; ?>

    <main class="main-content">

        <header class="page-header">
            <h1>Pengaturan Sistem ⚙️</h1>
            <p>Personalisasi preferensi akun, visibilitas pencarian kerja, dan hak akses notifikasi Anda.</p>
        </header>

        <div class="settings-main-wrapper">
            <div class="settings-sections-flex">
                
                <section class="settings-section-block">
                    <div class="card-title-section">
                        <h2><i class="fa-solid fa-user-clock" style="color: var(--royal-blue);"></i> Status Visibilitas Profil</h2>
                        <p>Atur bagaimana algoritma sistem merekomendasikan lowongan magang di beranda Anda.</p>
                    </div>

                    <div class="status-options-group">
                        <div class="status-selectable-card active" id="card-aktif" onclick="selectStatus('aktif')">
                            <div class="status-icon-box icon-box-active-1" id="icon-aktif">
                                <i class="fa-solid fa-fire"></i>
                            </div>
                            <div class="status-info-text">
                                <h3>Aktif Mencari Kerja</h3>
                                <p>Sistem akan memprioritaskan rekomendasi lowongan terbaru di dashboard utama.</p>
                            </div>
                        </div>

                        <div class="status-selectable-card" id="card-pasif" onclick="selectStatus('pasif')">
                            <div class="status-icon-box" id="icon-pasif">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div class="status-info-text">
                                <h3>Sudah Bekerja / Magang</h3>
                                <p>Sembunyikan rekomendasi pencarian kerja sementara waktu dari halaman beranda.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="settings-section-block">
                    <div class="card-title-section">
                        <h2><i class="fa-solid fa-bell" style="color: #EF4444;"></i> Pusat Pemberitahuan</h2>
                        <p>Kendali penuh terhadap jalur masuk informasi untuk mencegah gangguan kebisingan pesan.</p>
                    </div>

                    <div class="toggle-row-item">
                        <div class="toggle-label-meta">
                            <h4>Notifikasi Email Berkas Masuk</h4>
                            <p>Kirimkan surel rangkuman berkala setiap kali status lamaran berubah.</p>
                        </div>
                        <label class="switch-control">
                            <input type="checkbox" checked>
                            <span class="slider-round"></span>
                        </label>
                    </div>

                    <div class="toggle-row-item">
                        <div class="toggle-label-meta">
                            <h4>Rekomendasi Lowongan Mingguan</h4>
                            <p>Dapatkan update lowongan magang populer berdasarkan minat bakat profil.</p>
                        </div>
                        <label class="switch-control">
                            <input type="checkbox">
                            <span class="slider-round"></span>
                        </label>
                    </div>
                </section>

                <div class="save-action-panel">
                    <button type="button" class="btn-save-settings" onclick="alert('Preferensi visual berhasil diperbarui!')">
                        Simpan Perubahan
                    </button>
                </div>

            </div>
        </div>

    </main>
</div>

<script>
    function selectStatus(type) {
        const cardAktif = document.getElementById('card-aktif');
        const cardPasif = document.getElementById('card-pasif');
        const iconAktif = document.getElementById('icon-aktif');
        const iconPasif = document.getElementById('icon-pasif');

        if (type === 'aktif') {
            cardAktif.classList.add('active');
            cardPasif.classList.remove('active');
            
            iconAktif.style.backgroundColor = '#2563EB';
            iconAktif.style.color = '#FFFFFF';
            iconPasif.style.backgroundColor = '#F1F5F9';
            iconPasif.style.color = '#64748B';
        } else {
            cardPasif.classList.add('active');
            cardAktif.classList.remove('active');
            
            iconPasif.style.backgroundColor = '#10B981';
            iconPasif.style.color = '#FFFFFF';
            iconAktif.style.backgroundColor = '#F1F5F9';
            iconAktif.style.color = '#64748B';
        }
    }
</script>

</body>
</html>