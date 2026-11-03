<?php
require_once __DIR__ . '/includes/database.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['full_name'] ?? '');
    $nim = trim($_POST['nim'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $university = trim($_POST['university'] ?? '');
    $major = trim($_POST['major'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name === '' || $nim === '' || $university === '' || $major === ''
        || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) {
        $error = 'Lengkapi semua data dan gunakan kata sandi minimal 8 karakter.';
    } else {
        try {
            $pdo = db();
            $pdo->beginTransaction();
            $userStatement = $pdo->prepare(
                "INSERT INTO users (role, full_name, email, password_hash)
                 VALUES ('mahasiswa', :name, :email, :password_hash)"
            );
            $userStatement->execute([
                'name' => $name,
                'email' => $email,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            ]);
            $userId = (int) $pdo->lastInsertId();

            $profileStatement = $pdo->prepare(
                'INSERT INTO student_profiles (user_id, nim, university, major)
                 VALUES (:user_id, :nim, :university, :major)'
            );
            $profileStatement->execute([
                'user_id' => $userId,
                'nim' => $nim,
                'university' => $university,
                'major' => $major,
            ]);
            $pdo->prepare(
                'INSERT INTO student_preferences (student_id) VALUES (:student_id)'
            )->execute(['student_id' => $userId]);

            $pdo->commit();
            loginUser([
                'id' => $userId,
                'role' => 'mahasiswa',
                'full_name' => $name,
                'email' => $email,
            ]);
            header('Location: dashboard.php');
            exit();
        } catch (PDOException $exception) {
            if (isset($pdo) && $pdo->inTransaction()) {
                $pdo->rollBack();
            }
            if ($exception->getCode() === '23000') {
                $error = 'Email atau NIM sudah terdaftar.';
            } else {
                throw $exception;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Mahasiswa - CareerPath</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <main style="max-width: 560px; margin: 48px auto; padding: 32px; background: #fff; border-radius: 16px;">
        <h1>Daftar Akun Mahasiswa</h1>
        <p>Buat akun untuk menyimpan profil dan mengirim lamaran.</p>
        <?php if ($error !== ''): ?><p role="alert" style="color:#DC2626;"><?= h($error); ?></p><?php endif; ?>
        <form method="post">
            <p><label>Nama lengkap <input name="full_name" required value="<?= h($_POST['full_name'] ?? ''); ?>"></label></p>
            <p><label>NIM <input name="nim" required value="<?= h($_POST['nim'] ?? ''); ?>"></label></p>
            <p><label>Email <input type="email" name="email" required value="<?= h($_POST['email'] ?? ''); ?>"></label></p>
            <p><label>Universitas <input name="university" required value="<?= h($_POST['university'] ?? ''); ?>"></label></p>
            <p><label>Program studi <input name="major" required value="<?= h($_POST['major'] ?? ''); ?>"></label></p>
            <p><label>Kata sandi (minimal 8 karakter) <input type="password" name="password" minlength="8" required></label></p>
            <button type="submit">Daftar</button>
        </form>
        <p>Sudah memiliki akun? <a href="login.php">Masuk</a></p>
    </main>
</body>
</html>
