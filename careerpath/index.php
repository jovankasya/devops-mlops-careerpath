<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerPath - Platform Karier Mahasiswa</title>
    
    <!-- Google Fonts & FontAwesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ==========================================================================
           RESET & GLOBAL VARIABLES (Luxurious & Clean Corporate)
           ========================================================================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
            scroll-behavior: smooth;
        }

        :root {
            --royal-blue: #0A66C2;
            --electric-blue: #0077B5;
            --dark-slate: #0F172A;     
            --charcoal: #1E293B;       
            --text-muted: #64748B;     
            --bg-muted: #F1F5F9;       
            --white: #FFFFFF;
            --border-soft: #E2E8F0;
            --shadow-premium: 0 15px 35px -10px rgba(15, 23, 42, 0.04);
            --shadow-hover: 0 25px 50px -12px rgba(10, 102, 194, 0.1);
        }

        body {
            background-color: var(--bg-muted); 
            color: var(--charcoal);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .section-title {
            text-align: center;
            font-size: 32px;
            font-weight: 800;
            color: var(--dark-slate);
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }
        .section-title span { color: var(--royal-blue); }
        .section-subtitle {
            text-align: center;
            color: var(--text-muted);
            margin-bottom: 48px;
            font-size: 15px;
        }

        /* ==========================================================================
           HEADER / NAVBAR (CLEAN & TRANSPARENT EFFECT)
           ========================================================================== */
        header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 100;
            padding: 28px 0;
        }

        .navbar-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--white);
            text-decoration: none;
            font-weight: 800;
            font-size: 24px;
            letter-spacing: -0.5px;
        }
        .brand-logo i {
            background: linear-gradient(135deg, #FFF 0%, #E2E8F0 100%);
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--royal-blue);
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .btn-nav-login {
            color: var(--white);
            text-decoration: none;
            font-weight: 600;
            font-size: 14.5px;
            padding: 10px 24px;
            transition: opacity 0.2s;
        }
        .btn-nav-login:hover { opacity: 0.85; }
        
        .btn-nav-register {
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: var(--white);
            text-decoration: none;
            font-weight: 600;
            font-size: 14.5px;
            padding: 10px 26px;
            border-radius: 12px;
            transition: all 0.2s ease;
        }
        .btn-nav-register:hover {
            background-color: var(--white);
            color: var(--dark-slate);
            transform: translateY(-1px);
        }

        /* ==========================================================================
           HERO SECTION
           ========================================================================== */
        .hero-banner {
            position: relative;
            min-height: 80vh;
            background: linear-gradient(135deg, rgba(10, 102, 194, 0.85) 0%, rgba(15, 23, 42, 0.7) 100%), 
                        url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=1600') no-repeat center center;
            background-size: cover;
            display: flex;
            align-items: center;
            padding-top: 120px;
            padding-bottom: 60px;
        }

        .hero-text-wrapper {
            max-width: 700px;
            color: var(--white);
        }

        .hero-text-wrapper h1 {
            font-size: 52px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
            letter-spacing: -1.5px;
        }

        .hero-text-wrapper p {
            font-size: 16.5px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 36px;
            font-weight: 400;
            line-height: 1.7;
        }

        .btn-hero-start {
            background: var(--white);
            color: var(--royal-blue);
            padding: 14px 36px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 15px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.2s ease;
        }
        .btn-hero-start:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            background-color: #F8FAFC;
        }

        /* ==========================================================================
           SEARCH BAR FLOATING
           ========================================================================== */
        .floating-search-container {
            margin-top: -45px;
            position: relative;
            z-index: 5;
        }

        .floating-search-card {
            background: var(--white);
            padding: 14px;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.08);
            border: 1px solid var(--border-soft);
            max-width: 950px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .search-input-wrapper {
            flex: 1;
            position: relative;
            display: flex;
            align-items: center;
        }
        .search-input-wrapper i {
            position: absolute;
            left: 20px;
            color: var(--text-muted);
            font-size: 16px;
        }
        .search-input-wrapper input {
            width: 100%;
            border: none;
            outline: none;
            background-color: var(--bg-muted);
            padding: 16px 16px 16px 52px;
            font-size: 15px;
            border-radius: 14px;
            color: var(--charcoal);
            font-weight: 500;
        }

        .btn-search-trigger {
            background-color: var(--dark-slate);
            color: var(--white);
            border: none;
            padding: 16px 36px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-search-trigger:hover {
            background-color: var(--royal-blue);
        }

        /* ==========================================================================
           INFO HIGHLIGHT SECTION
           ========================================================================== */
        .info-highlight-section {
            padding: 80px 0 40px 0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 32px;
        }

        .info-card {
            background: var(--white);
            padding: 32px;
            border-radius: 20px;
            border: 1px solid rgba(226, 232, 240, 0.7);
            box-shadow: var(--shadow-premium);
            transition: transform 0.2s;
        }
        .info-card:hover {
            transform: translateY(-3px);
        }

        .info-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background-color: rgba(10, 102, 194, 0.08);
            color: var(--royal-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .info-card h3 {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark-slate);
            margin-bottom: 8px;
        }

        .info-card p {
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* ==========================================================================
           SECTION 3: MOST VIEWED / LOWONGAN POPULER
           ========================================================================== */
        .popular-section {
            padding: 40px 0 100px 0;
        }

        .jobs-layout-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 28px;
        }

        .premium-job-card {
            background: var(--white);
            border-radius: 24px;
            padding: 32px;
            border: 1px solid rgba(226, 232, 240, 0.7);
            box-shadow: var(--shadow-premium);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 250px;
        }
        .premium-job-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(10, 102, 194, 0.15);
        }

        .job-card-top h3 {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark-slate);
            margin-bottom: 6px;
            letter-spacing: -0.3px;
        }
        .job-card-top p {
            color: var(--text-muted);
            font-size: 14.5px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .job-tag {
            display: inline-flex;
            font-size: 13px;
            font-weight: 700;
            color: var(--royal-blue);
            background-color: rgba(10, 102, 194, 0.06);
            padding: 6px 14px;
            border-radius: 8px;
            margin-bottom: 24px;
        }

        .btn-job-apply {
            display: block;
            text-align: center;
            background-color: var(--bg-muted);
            color: var(--charcoal);
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14.5px;
            text-decoration: none;
            border: 1px solid rgba(226, 232, 240, 0.5);
            transition: all 0.2s;
        }
        .premium-job-card:hover .btn-job-apply {
            background: var(--royal-blue);
            color: var(--white);
            border-color: transparent;
            box-shadow: 0 8px 20px rgba(10, 102, 194, 0.2);
        }

        /* ==========================================================================
           FOOTER
           ========================================================================== */
        .premium-footer {
            background-color: var(--white);
            border-top: 1px solid var(--border-soft);
            padding: 80px 0 30px 0;
            color: var(--charcoal);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1.5fr;
            gap: 64px;
            margin-bottom: 60px;
        }

        @media (max-width: 768px) {
            .footer-grid { grid-template-columns: 1fr; gap: 40px; }
        }

        .footer-brand-col p {
            color: var(--text-muted);
            font-size: 14.5px;
            margin-top: 16px;
            margin-bottom: 24px;
            max-width: 340px;
        }

        .footer-socials {
            display: flex;
            gap: 12px;
        }

        .footer-socials a {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: var(--bg-muted);
            color: var(--charcoal);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 15px;
            transition: all 0.2s;
        }
        .footer-socials a:hover {
            background-color: var(--royal-blue);
            color: var(--white);
        }

        .footer-col h4 {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark-slate);
            margin-bottom: 24px;
            position: relative;
        }

        .footer-links {
            list-style: none;
        }
        .footer-links li {
            margin-bottom: 12px;
        }
        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14.5px;
            transition: color 0.2s;
        }
        .footer-links a:hover {
            color: var(--royal-blue);
        }

        .contact-list {
            list-style: none;
        }
        .contact-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            color: var(--text-muted);
            font-size: 14.5px;
            margin-bottom: 16px;
            line-height: 1.5;
        }
        .contact-list i {
            color: var(--royal-blue);
            margin-top: 4px;
            font-size: 15px;
        }

        .footer-bottom {
            border-top: 1px solid var(--border-soft);
            padding-top: 30px;
            text-align: center;
            color: var(--text-muted);
            font-size: 14px;
        }
    </style>
</head>

<body>

    <!-- NAVBAR PINTAR (Diubah ke login-role) -->
    <header>
        <div class="container navbar-flex">
            <a href="index.php" class="brand-logo">
                <i class="fa-solid fa-briefcase"></i> CareerPath
            </a>
            <div class="nav-actions">
                <a href="login-role.php" class="btn-nav-login">Masuk</a>
                <a href="login-role.php" class="btn-nav-register">Daftar</a>
            </div>
        </div>
    </header>

    <!-- HERO BANNER (Diubah ke login-role) -->
    <section class="hero-banner">
        <div class="container">
            <div class="hero-text-wrapper">
                <h1>Finding Your Dream Intern Is Simple</h1>
                <p>Jembatan eksklusif mahasiswa untuk meraih peluang magang terverifikasi. Kami memotong jalur birokrasi rumit langsung menuju rekruter perusahaan impian Anda.</p>
                <a href="login-role.php" class="btn-hero-start">Mulai Sekarang <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!-- FLOATING SEARCH BAR (Diubah memicu gerbang login-role) -->
    <section class="floating-search-container">
        <div class="container">
            <div class="floating-search-card">
                <div class="search-input-wrapper">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari posisi magang, keahlian, atau nama perusahaan...">
                </div>
                <button onclick="window.location.href='login-role.php'" class="btn-search-trigger">Cari Peluang</button>
            </div>
        </div>
    </section>

    <!-- INFO HIGHLIGHT -->
    <section class="info-highlight-section">
        <div class="container">
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-icon-box">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <h3>Kemitraan Terverifikasi</h3>
                    <p>Seluruh lowongan dipublikasi langsung oleh HR resmi mitra perusahaan nasional hingga multinasional guna mencegah penipuan.</p>
                </div>
                <div class="info-card">
                    <div class="info-icon-box">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <h3>Fast-Track Resume</h3>
                    <p>Format profil standar industri memudahkan berkas lamaran Anda langsung dibaca oleh sistem rekrutmen internal mitra.</p>
                </div>
                <div class="info-card">
                    <div class="info-icon-box">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3>100% Khusus Mahasiswa</h3>
                    <p>Ekosistem platform dirancang spesifik bagi mahasiswa aktif dan fresh graduate yang membutuhkan pengalaman kerja perdana.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- MOST VIEWED INTERNSHIPS (Semua tombol mengarah ke login-role) -->
    <section class="popular-section">
        <div class="container">
            <h2 class="section-title">Most Viewed <span>Internships</span></h2>
            <p class="section-subtitle">Daftar rekomendasi posisi magang dengan antusiasme pelamar tertinggi minggu ini.</p>
            
            <div class="jobs-layout-grid">
                <div class="premium-job-card">
                    <div class="job-card-top">
                        <h3>UI/UX Designer Intern</h3>
                        <p><i class="fa-solid fa-building"></i> Gojek Tech • Remote / WFH</p>
                        <span class="job-tag">IDR 1.5M - 2.5M / Bln</span>
                    </div>
                    <a href="login-role.php" class="btn-job-apply">Lamar Sekarang</a>
                </div>

                <div class="premium-job-card">
                    <div class="job-card-top">
                        <h3>Frontend Developer</h3>
                        <p><i class="fa-solid fa-building"></i> Tokopedia • Jakarta Barat</p>
                        <span class="job-tag">IDR 2.0M - 3.5M / Bln</span>
                    </div>
                    <a href="login-role.php" class="btn-job-apply">Lamar Sekarang</a>
                </div>

                <div class="premium-job-card">
                    <div class="job-card-top">
                        <h3>Data Analyst Intern</h3>
                        <p><i class="fa-solid fa-building"></i> PT Bank Mandiri • Hybrid</p>
                        <span class="job-tag">IDR 1.8M - 2.5M / Bln</span>
                    </div>
                    <a href="login-role.php" class="btn-job-apply">Lamar Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="premium-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand-col">
                    <a href="index.php" class="brand-logo" style="color: var(--dark-slate);">
                        <i class="fa-solid fa-briefcase" style="background: var(--royal-blue); color: #fff;"></i> CareerPath
                    </a>
                    <p>Platform akselerasi karier mahasiswa dan talenta muda terbaik bangsa menuju industri profesional.</p>
                    <div class="footer-socials">
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Tautan Pintar</h4>
                    <ul class="footer-links">
                        <li><a href="login-role.php">Cari Lowongan</a></li>
                        <li><a href="login-role.php">Gabung Mitra HR</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Hubungi Kami</h4>
                    <ul class="contact-list">
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            <span>Gedung Synergy Tower Lantai 18, Jl. Jalur Sutera Barat No.17, Alam Sutera, Tangerang, Banten 15143.</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-envelope"></i>
                            <span>support@careerpath.id</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-phone"></i>
                            <span>+62 (21) 5098-7721 (Jam Kerja)</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 CareerPath Indonesia. Seluruh hak cipta dilindungi undang-undang.</p>
            </div>
        </div>
    </footer>

</body>
</html>