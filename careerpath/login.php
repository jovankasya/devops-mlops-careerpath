<?php
session_start();
// Simulasi login sederhana untuk keperluan prototype IMK
if (isset($_POST['login'])) {
    $_SESSION['total_applied'] = 3; // Mengunci angka dasar statistik awal
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun - CareerPath</title>

    <!-- Google Fonts & FontAwesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
        
        :root {
            --royal-blue: #2563EB;
            --royal-gradient: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
            --dark-slate: #0F172A;
            --text-muted: #64748B;
            --border-soft: #E2E8F0;
            --bg-light: #F8FAFC;
        }

        body {
            background-color: var(--bg-light);
            min-height: 100vh;
            display: flex;
            overflow: hidden;
        }

        /* SPLIT SCREEN LAYOUT */
        .login-wrapper {
            display: flex;
            width: 100vw;
            height: 100vh;
        }

        /* PANEL KIRI (HERO VISUAL BRANDING) */
        .hero-side {
            flex: 1.1;
            background: linear-gradient(rgba(15, 23, 42, 0.75), rgba(29, 78, 216, 0.85)), 
                        url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1000') no-repeat center center;
            background-size: cover;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: white;
            position: relative;
        }

        .brand-logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .brand-logo-area i {
            font-size: 26px;
            background-color: white;
            color: var(--royal-blue);
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .brand-logo-area span { font-size: 22px; font-weight: 800; letter-spacing: -0.5px; }

        .hero-main-caption h1 {
            font-size: 38px;
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }
        .hero-main-caption p {
            color: #93C5FD;
            font-size: 15px;
            line-height: 1.6;
            max-width: 520px;
        }

        /* STATS GRID DI ATAS BACKGROUND TRANSPARAN */
        .hero-stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }
        .stat-glass-box {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 20px;
            border-radius: 16px;
            text-align: center;
        }
        .stat-glass-box h3 { font-size: 24px; font-weight: 800; color: white; }
        .stat-glass-box p { font-size: 11px; color: #BFDBFE; text-transform: uppercase; font-weight: 600; margin-top: 4px; letter-spacing: 0.5px; }

        /* PANEL KANAN (FORM UTAMA DENGAN POLESAN IMK) */
        .form-side {
            flex: 0.9;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background-color: var(--bg-light);
        }

        /* KOTAK WADAH FORM AGAR TIDAK TELANJANG GERSANG */
        .login-card-panel {
            background-color: white;
            border: 1px solid var(--border-soft);
            border-radius: 24px;
            padding: 48px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.04);
        }

        .form-header {
            margin-bottom: 32px;
        }
        .form-header h2 { font-size: 26px; font-weight: 700; color: var(--dark-slate); letter-spacing: -0.5px; }
        .form-header p { font-size: 14px; color: var(--text-muted); margin-top: 6px; }

        .input-group-wrapper {
            margin-bottom: 22px;
        }
        
        /* PRINSIP IMK: LABEL DI ATAS INPUT UNTUK MEMBANTU MEMORI USER */
        .input-group-wrapper label {
            display: block;
            font-size: 13.5px;
            font-weight: 600;
            color: var(--dark-slate);
            margin-bottom: 8px;
        }

        .input-field-relative {
            position: relative;
            display: flex;
            align-items: center;
        }
        .input-field-relative i {
            position: absolute;
            left: 18px;
            color: var(--text-muted);
            font-size: 16px;
            transition: color 0.2s;
        }

        .input-field-relative input {
            width: 100%;
            padding: 14px 16px 14px 50px;
            border: 1px solid var(--border-soft);
            background-color: #F8FAFC;
            border-radius: 12px;
            font-size: 14.5px;
            color: var(--dark-slate);
            font-weight: 500;
            transition: all 0.2s;
        }
        .input-field-relative input:focus {
            outline: none;
            border-color: var(--royal-blue);
            background-color: white;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }
        .input-field-relative input:focus + i {
            color: var(--royal-blue);
        }

        /* ASPEK UTILITY & LINK PENDUKUNG */
        .form-options-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            font-size: 13.5px;
        }
        .remember-me-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: var(--text-muted);
            font-weight: 500;
        }
        .remember-me-checkbox input {
            accent-color: var(--royal-blue);
            width: 16px;
            height: 16px;
        }
        .forgot-link {
            color: var(--royal-blue);
            text-decoration: none;
            font-weight: 600;
        }
        .forgot-link:hover { text-decoration: underline; }

        /* TOMBOL AKSI UTAMA */
        .btn-action-submit {
            width: 100%;
            background: var(--royal-gradient);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
            transition: all 0.2s;
            margin-bottom: 16px;
        }
        .btn-action-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        }

        .btn-action-back {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            background-color: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border-soft);
            padding: 13px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-action-back:hover {
            background-color: #F1F5F9;
            color: var(--dark-slate);
            border-color: #CBD5E1;
        }

        .register-footer-trigger {
            text-align: center;
            margin-top: 24px;
            font-size: 13.5px;
            color: var(--text-muted);
            font-weight: 500;
        }
        .register-footer-trigger a {
            color: var(--royal-blue);
            text-decoration: none;
            font-weight: 700;
        }
        .register-footer-trigger a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="login-wrapper">

    <!-- PANEL KIRI: HERO KAMPANYE KARIR -->
    <div class="hero-side">
        <div class="brand-logo-area">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>CareerPath.</span>
        </div>

        <div class="hero-main-caption">
            <h1>Masa Depanmu<br>Dimulai Di Sini 🚀</h1>
            <p>Temukan program magang, lowongan kerja, dan peluang karier terbaik dari perusahaan terkemuka dalam satu platform yang terstruktur.</p>
        </div>

        <div class="hero-stats-row">
            <div class="stat-glass-box">
                <h3>500+</h3>
                <p>Lowongan Aktif</p>
            </div>
            <div class="stat-glass-box">
                <h3>120+</h3>
                <p>Mitra Bisnis</p>
            </div>
            <div class="stat-glass-box">
                <h3>95%</h3>
                <p>Kelulusan</p>
            </div>
        </div>
    </div>

    <!-- PANEL KANAN: FORM LOGIN BERWARNA SERASI -->
    <div class="form-side">
        <div class="login-card-panel">
            
            <header class="form-header">
                <h2>Selamat Datang Kembali 👋</h2>
                <p>Lanjutkan perjalanan membangun kariermu bersama CareerPath.</p>
            </header>

            <form method="POST" action="">
                
                <!-- Kolom Input 1: NIM / Username -->
                <div class="input-group-wrapper">
                    <label for="username">Nomor Induk Mahasiswa (NIM)</label>
                    <div class="input-field-relative">
                        <i class="fa-solid fa-user-tie"></i>
                        <input type="text" id="username" name="username" placeholder="Masukkan NIM Anda" value="2301530027" required autocomplete="off">
                    </div>
                </div>

                <!-- Kolom Input 2: Password -->
                <div class="input-group-wrapper">
                    <label for="password">Kata Sandi</label>
                    <div class="input-field-relative">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="••••••••••••" value="password123" required>
                    </div>
                </div>

                <!-- Opsi Tambahan -->
                <div class="form-options-flex">
                    <label class="remember-me-checkbox">
                        <input type="checkbox" checked> Ingat Saya
                    </label>
                    <a href="#" class="forgot-link">Lupa Password?</a>
                </div>

                <!-- Tombol Kendali Aksi -->
                <button type="submit" name="login" class="btn-action-submit">Masuk Ke Sistem</button>
                
                <!-- DIUBAH PENUH: Sekarang mengarah ke index.php dengan aman -->
                <a href="index.php" class="btn-action-back">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </form>

            <div class="register-footer-trigger">
                Belum punya akun? <a href="register.php">Daftar Sekarang</a>
            </div>

        </div>
    </div>

</div>

</body>
</html>