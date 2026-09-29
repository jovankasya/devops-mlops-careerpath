<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Mitra HRD - CareerPath Pro</title>
    
    <!-- Google Fonts & FontAwesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        :root {
            /* Palette Baru: Cerah, Segar, Mewah & Tidak Serem */
            --bright-blue: #0284C7;     /* Biru Safir Terang untuk tombol utama */
            --bright-blue-hover: #0369A1;
            --text-dark: #0F172A;       /* Teks utama hitam pekat agar kontras */
            --text-muted: #475569;      /* Teks sekunder abu gelap yang jelas */
            --input-bg: #F1F5F9;        /* Input abu-abu muda bersih */
            --premium-orange: #EA580C;  /* Aksen orange-gold cerah */
            --orange-hover: #C2410C;
            --white: #FFFFFF;
        }

        body {
            background-color: #F8FAFC;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* Container Utama Split Screen */
        .split-container {
            display: flex;
            width: 100vw;
            height: 100vh;
            background-color: var(--white);
        }

        /* KIRI: Sisi Form Login (Diberi hiasan background abstrak tipis agar tidak monoton) */
        .form-side {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 80px;
            max-width: 580px;
            background: radial-gradient(circle at top left, rgba(2, 132, 199, 0.05) 0%, rgba(255, 255, 255, 0) 50%),
                        radial-gradient(circle at bottom right, rgba(234, 88, 12, 0.03) 0%, rgba(255, 255, 255, 0) 50%);
            overflow-y: auto;
            position: relative;
        }

        @media (max-width: 950px) {
            .form-side {
                max-width: 100%;
                padding: 40px 24px;
            }
            .visual-side {
                display: none;
            }
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: var(--text-dark);
            color: var(--white);
            padding: 10px 18px;
            border-radius: 14px;
            font-size: 13px;
            font-weight: 700;
            width: fit-content;
            margin-bottom: 32px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.1);
        }
        .brand-badge i { color: #FBBF24; }

        .form-header h1 {
            font-size: 34px;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -1px;
            line-height: 1.2;
        }

        .form-header p {
            color: var(--text-muted);
            font-size: 15.5px;
            margin-top: 12px;
            margin-bottom: 40px;
            line-height: 1.5;
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 18px;
            color: #94A3B8;
            font-size: 16px;
            transition: color 0.3s;
        }

        .input-wrapper input {
            width: 100%;
            padding: 16px 16px 16px 52px;
            font-size: 15px;
            border-radius: 14px;
            border: 1.5px solid #E2E8F0;
            background-color: var(--input-bg);
            outline: none;
            color: var(--text-dark);
            font-weight: 600;
            transition: all 0.3s;
        }

        .input-wrapper input:focus {
            border-color: var(--bright-blue);
            background-color: var(--white);
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.15);
        }

        .input-wrapper input:focus + i {
            color: var(--bright-blue);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            color: var(--text-dark);
            cursor: pointer;
        }

        .forgot-link {
            color: var(--premium-orange);
            text-decoration: none;
            font-weight: 700;
        }
        .forgot-link:hover { color: var(--orange-hover); }

        /* Tombol Login Dibikin Cerah Terang Berkelas */
        .btn-submit {
            width: 100%;
            background-color: var(--bright-blue);
            color: var(--white);
            border: none;
            padding: 16px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 8px 24px rgba(2, 132, 199, 0.25);
        }

        .btn-submit:hover {
            background-color: var(--bright-blue-hover);
            transform: translateY(-1px);
            box-shadow: 0 12px 28px rgba(2, 132, 199, 0.35);
        }

        .register-hint {
            text-align: center;
            margin-top: 36px;
            font-size: 14.5px;
            color: var(--text-muted);
        }

        .register-hint a {
            color: var(--bright-blue);
            text-decoration: none;
            font-weight: 700;
        }
        .register-hint a:hover { color: var(--bright-blue-hover); }

        .btn-back {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 40px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: color 0.2s;
        }
        .btn-back:hover { color: var(--text-dark); }


        /* KANAN: Sisi Visual Dibuat Sangat Cerah (Soft Light Blue-Gray Gradient) */
        .visual-side {
            flex: 1;
            position: relative;
            /* Overlay putih transparan + biru muda cerah melidungi background gambar agar terang benderang */
            background: linear-gradient(135deg, rgba(240, 246, 252, 0.85) 0%, rgba(224, 236, 248, 0.8) 100%), 
                        url('https://images.unsplash.com/photo-1606857521015-7f9fcf423740?q=80&w=1470&auto=format&fit=crop') no-repeat center center;
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 80px;
        }

        /* Hiasan lingkaran estetik versi cerah */
        .visual-side::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 75%;
            height: 75%;
            border: 2px dashed rgba(2, 132, 199, 0.15);
            border-radius: 50%;
            pointer-events: none;
        }

        .visual-content {
            position: relative;
            z-index: 5;
            color: var(--text-dark); /* Teks di kanan diganti hitam agar kontras & jelas di latar terang */
            max-width: 520px;
        }

        .visual-content h2 {
            font-size: 34px;
            font-weight: 800;
            letter-spacing: -0.5px;
            line-height: 1.3;
            margin-bottom: 16px;
            color: #0369A1; /* Judul biru premium segar */
        }

        .visual-content p {
            color: #334155;
            font-size: 16px;
            line-height: 1.6;
            font-weight: 500;
        }

        /* Dots Slider Cerah */
        .visual-dots {
            display: flex;
            gap: 8px;
            margin-top: 32px;
        }
        .dot {
            width: 8px;
            height: 8px;
            background-color: rgba(2, 132, 199, 0.2);
            border-radius: 50%;
        }
        .dot.active {
            width: 24px;
            background-color: var(--bright-blue);
            border-radius: 4px;
        }
    </style>
</head>

<body>

    <div class="split-container">
        
        <!-- SISI KIRI: FORM LOGIN (KONTRAST & CERAH) -->
        <div class="form-side">
            <div class="brand-badge">
                <i class="fa-solid fa-crown"></i> CareerPath Corporate
            </div>
            
            <div class="form-header">
                <h1>Selamat Datang<br>Mitra HRD</h1>
                <p>Kelola lowongan magang eksklusif dan saring berkas pelamar mahasiswa terbaik.</p>
            </div>

            <form action="hrd-dashboard.php" method="POST">
                <div class="form-group">
                    <label for="email">Email Institusi / Perusahaan</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" id="email" name="email" placeholder="nama@perusahaan.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi Korporat</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" style="accent-color: var(--bright-blue);"> Ingat Sesi Saya
                    </label>
                    <a href="#" class="forgot-link">Lupa Sandi?</a>
                </div>

                <button type="submit" class="btn-submit">Otorisasi Masuk Portal</button>
            </form>

            <div class="register-hint">
                Belum mendaftarkan instansi Anda? <a href="register-company.php">Gabung Mitra Baru</a>
            </div>

            <a href="login-role.php" class="btn-back">
                <i class="fa-solid fa-arrow-left-long"></i> Kembali ke Pemilihan Akses
            </a>
        </div>

        <!-- SISI KANAN: PANEL VISUAL (SUPER BRIGHT & CLEAN GRAPHIC) -->
        <div class="visual-side">
            <div class="visual-content">
                <h2>Efisiensi Rekrutmen Talenta Muda dari Berbagai Kampus</h2>
                <p>Akses langsung ribuan portofolio mahasiswa aktif dan persiapkan akselerasi pertumbuhan bisnis Anda bersama talenta terbaik.</p>
                
                <div class="visual-dots">
                    <div class="dot active"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>