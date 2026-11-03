<?php
require_once __DIR__ . '/includes/database.php';
$user = requireRole('mahasiswa');
$pdo = db();
$profileStatement = $pdo->prepare(
    'SELECT u.full_name, u.email, sp.university, sp.major, sp.phone, sp.cv_path, sp.bio
     FROM users u JOIN student_profiles sp ON sp.user_id = u.id
     WHERE u.id = :user_id'
);
$profileStatement->execute(['user_id' => $user['id']]);
$profile = $profileStatement->fetch();
if (!$profile) {
    http_response_code(404);
    exit('Profil mahasiswa tidak ditemukan.');
}
$message = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $university = trim($_POST['university'] ?? '');
    $major = trim($_POST['major'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $bio = trim($_POST['bio'] ?? '');
    if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $university === '' || $major === '') {
        $error = 'Nama, email, universitas, dan program studi wajib diisi dengan benar.';
    } else {
        $cvPath = $profile['cv_path'];
        if (isset($_FILES['cv']) && $_FILES['cv']['error'] !== UPLOAD_ERR_NO_FILE) {
            $file = $_FILES['cv'];
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if ($file['error'] !== UPLOAD_ERR_OK || $file['size'] > 5 * 1024 * 1024
                || !in_array($extension, ['pdf', 'doc', 'docx'], true)) {
                $error = 'CV harus berupa PDF/DOC/DOCX dan maksimal 5 MB.';
            } else {
                $directory = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'cv';
                if (!is_dir($directory) && !mkdir($directory, 0755, true) && !is_dir($directory)) {
                    throw new RuntimeException('Folder penyimpanan CV tidak dapat dibuat.');
                }
                $filename = bin2hex(random_bytes(16)) . '.' . $extension;
                if (!move_uploaded_file($file['tmp_name'], $directory . DIRECTORY_SEPARATOR . $filename)) {
                    throw new RuntimeException('CV gagal disimpan ke server.');
                }
                $cvPath = 'uploads/cv/' . $filename;
            }
        }

        if ($error === '') {
            try {
                $pdo->beginTransaction();
                $pdo->prepare(
                    'UPDATE users SET full_name = :name, email = :email WHERE id = :user_id'
                )->execute(['name' => $name, 'email' => $email, 'user_id' => $user['id']]);
                $pdo->prepare(
                    'UPDATE student_profiles
                     SET university = :university, major = :major, phone = :phone,
                         bio = :bio, cv_path = :cv_path
                     WHERE user_id = :user_id'
                )->execute([
                    'university' => $university,
                    'major' => $major,
                    'phone' => $phone ?: null,
                    'bio' => $bio ?: null,
                    'cv_path' => $cvPath,
                    'user_id' => $user['id'],
                ]);
                $pdo->commit();
                $_SESSION['user']['full_name'] = $name;
                $_SESSION['user']['email'] = $email;
                header('Location: profile.php?saved=1');
                exit();
            } catch (PDOException $exception) {
                if ($pdo->inTransaction()) {
                    $pdo->rollBack();
                }
                if ($exception->getCode() === '23000') {
                    $error = 'Email tersebut sudah digunakan akun lain.';
                } else {
                    throw $exception;
                }
            }
        }
    }
}
if (isset($_GET['saved'])) {
    $message = 'Profil berhasil disimpan.';
    $profileStatement->execute(['user_id' => $user['id']]);
    $profile = $profileStatement->fetch();
}
$skillsStatement = $pdo->prepare(
    'SELECT s.name FROM student_skills ss JOIN skills s ON s.id = ss.skill_id
     WHERE ss.student_id = :student_id ORDER BY s.name'
);
$skillsStatement->execute(['student_id' => $user['id']]);
$skills = array_column($skillsStatement->fetchAll(), 'name');
$name = $profile['full_name'];
$major = $profile['major'] . ' - ' . $profile['university'];
$email = $profile['email'];
$phone = $profile['phone'] ?: 'Belum diisi';
$cv = $profile['cv_path'] ? basename($profile['cv_path']) : 'CV belum diunggah';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - CareerPath</title>

    <!-- Google Fonts & FontAwesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* RESET LAYOUT DASAR */
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
        
        :root {
            --bg-main: #F1F5F9;         
            --white: #FFFFFF;
            --border-soft: #CBD5E1;     /* Dipertegas dari E2E8F0 agar lebih kelihatan */
            --dark-slate: #0F172A;      /* Dipergelap dari 1E293B untuk kontras teks utama */
            --text-muted: #475569;      /* Dipergelap dari 64748B agar label terbaca jelas */
            --royal-blue: #2563EB;      
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
        }

        .main-content { 
            flex: 1; 
            padding: 40px; 
            height: 100vh;
            overflow-y: auto;
        }

        /* BANNER ATAS */
        .welcome-banner {
            background-color: var(--royal-blue);
            border-radius: 20px;
            padding: 36px 40px;
            color: var(--white);
            margin-bottom: 32px;
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.15);
        }

        .welcome-banner h1 { font-size: 28px; font-weight: 700; margin-bottom: 6px; }
        .welcome-banner p { color: #E0F2FE; font-size: 15px; opacity: 0.95; }

        /* KARTU PROFIL UTAMA (DISETTING PROPORSIONAL) */
        .profile-card {
            background-color: var(--white);
            border: 1px solid var(--border-soft);
            border-radius: 20px;
            padding: 40px;
            max-width: 900px; /* Diperlebar sedikit agar komponen bernapas */
            margin: 0 auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        /* BAGIAN ATAS: AVATAR & NAMA UTAMA */
        .profile-header-section {
            display: flex;
            align-items: center;
            gap: 28px;
            padding-bottom: 32px;
            border-bottom: 2px solid #F1F5F9;
            margin-bottom: 36px;
        }

        .profile-avatar {
            width: 90px;
            height: 90px;
            background-color: #EFF6FF;
            color: var(--royal-blue);
            font-size: 32px;
            font-weight: 700;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #DBEAFE;
            flex-shrink: 0;
        }

        .profile-title-meta h2 { font-size: 26px; font-weight: 700; color: var(--dark-slate); }
        .profile-title-meta p { font-size: 15px; color: var(--text-muted); margin-top: 6px; font-weight: 500; }
        .profile-title-meta p i { color: var(--royal-blue); margin-right: 4px; }

        /* INTERFACES FORM DATA DIRI */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
            margin-bottom: 36px;
        }

        .info-box label {
            display: block;
            font-size: 13px; /* Ukuran naik dari 11px */
            font-weight: 700; /* Dibuat lebih tebal bold */
            color: var(--dark-slate); /* Diubah ke warna gelap agar kontras */
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .info-box p {
            font-size: 15px; /* Ukuran naik dari 14px */
            color: var(--dark-slate);
            font-weight: 500;
            background-color: #F8FAFC;
            padding: 14px 18px; /* Padding ditambah agar field box lebih proporsional */
            border-radius: 12px;
            border: 1px solid var(--border-soft);
        }

        /* SEKSI SKILL */
        .skills-section {
            margin-bottom: 36px;
        }

        .skills-section label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--dark-slate);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 14px;
        }

        .skills-flex {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .skill-badge {
            background-color: #EFF6FF;
            color: var(--royal-blue);
            font-size: 14px; /* Ukuran naik dari 12px */
            font-weight: 600; /* Lebih tegas */
            padding: 8px 18px;
            border-radius: 20px;
            border: 1px solid #BFDBFE;
        }

        /* SEKSI DOKUMEN CV */
        .cv-section label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--dark-slate);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 14px;
        }

        .cv-card-mini {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            background-color: #FFF7ED; 
            border: 1px solid #FFEDD5;
            border-radius: 14px;
        }

        .cv-info-flex {
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 15px; /* Ukuran naik dari 13px */
            font-weight: 600;
            color: #C2410C;
        }

        .cv-info-flex i { font-size: 22px; }

        .btn-cv-action {
            background-color: var(--white);
            color: var(--royal-blue);
            border: 1px solid var(--royal-blue);
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-cv-action:hover { 
            background-color: var(--royal-blue);
            color: var(--white);
        }
    </style>
</head>
<body>

<div class="dashboard-container">

    <!-- Memanggil komponen sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Area Konten Utama -->
    <main class="main-content">

        <!-- Banner Atas -->
        <section class="welcome-banner">
            <h1>Profil Karier 👤</h1>
            <p>Data resume personal dan kompetensi keahlian yang terdaftar di sistem.</p>
        </section>

        <!-- Kartu Profil Standar Keterbacaan Tinggi -->
        <form class="profile-card" method="post" enctype="multipart/form-data">
            <?php if ($message !== ''): ?><p role="status"><?= h($message); ?></p><?php endif; ?>
            <?php if ($error !== ''): ?><p role="alert" style="color:#DC2626;"><?= h($error); ?></p><?php endif; ?>
            
            <!-- Avatar & Nama Utama -->
            <div class="profile-header-section">
                <div class="profile-avatar">JS</div>
                <div class="profile-title-meta">
                    <h2><?= h($name); ?></h2>
                    <p><i class="fa-solid fa-graduation-cap"></i> <?= h($major); ?></p>
                </div>
            </div>

            <!-- Detail Informasi Utama -->
            <div class="info-grid">
                <div class="info-box">
                    <label>Nama Lengkap</label>
                    <p><input type="text" name="full_name" required value="<?= h($profile['full_name']); ?>" aria-label="Nama lengkap"></p>
                </div>
                <div class="info-box">
                    <label>Alamat Email</label>
                    <p><input type="email" name="email" required value="<?= h($profile['email']); ?>" aria-label="Email"></p>
                </div>
                <div class="info-box">
                    <label>Nomor Telepon</label>
                    <p><input type="text" name="phone" value="<?= h($profile['phone']); ?>" aria-label="Nomor telepon"></p>
                </div>
                <div class="info-box">
                    <label>Universitas</label>
                    <p><input type="text" name="university" required value="<?= h($profile['university']); ?>" aria-label="Universitas"></p>
                </div>
                <div class="info-box">
                    <label>Program Studi</label>
                    <p><input type="text" name="major" required value="<?= h($profile['major']); ?>" aria-label="Program studi"></p>
                </div>
            </div>

            <!-- Bagian Kompetensi Keahlian -->
            <div class="skills-section">
                <label>Fokus Kompetensi Keahlian</label>
                <div class="skills-flex">
                    <?php foreach ($skills as $skill): ?>
                        <span class="skill-badge"><?= h($skill); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Bagian Lampiran File CV -->
            <div class="cv-section">
                <label>Berkas Resume Aktif</label>
                <div class="cv-card-mini">
                    <div class="cv-info-flex">
                        <i class="fa-solid fa-file-pdf"></i>
                        <span><?= h($cv); ?></span>
                    </div>
                    <?php if ($profile['cv_path']): ?><a href="download-cv.php" class="btn-cv-action">Unduh CV</a><?php endif; ?>
                    <label class="btn-cv-action">Ganti Berkas <input type="file" name="cv" accept=".pdf,.doc,.docx"></label>
                </div>
            </div>
            <label>Ringkasan diri <textarea name="bio"><?= h($profile['bio']); ?></textarea></label>
            <button type="submit" class="btn-cv-action">Simpan Profil</button>

        </form>

    </main>
</div>

</body>
</html>