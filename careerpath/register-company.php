<?php
require_once __DIR__ . '/includes/database.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $companyName = trim($_POST['company_name'] ?? '');
    $sector = trim($_POST['sector'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name === '' || $companyName === '' || $sector === ''
        || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) {
        $error = 'Lengkapi semua data dan gunakan kata sandi minimal 8 karakter.';
    } else {
        try {
            $pdo = db();
            $pdo->beginTransaction();
            $userStatement = $pdo->prepare(
                "INSERT INTO users (role, full_name, email, password_hash)
                 VALUES ('hrd', :name, :email, :password_hash)"
            );
            $userStatement->execute([
                'name' => $name,
                'email' => $email,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            ]);
            $userId = (int) $pdo->lastInsertId();

            $companyStatement = $pdo->prepare(
                'SELECT id FROM companies WHERE name = :name LIMIT 1'
            );
            $companyStatement->execute(['name' => $companyName]);
            $companyId = $companyStatement->fetchColumn();
            if (!$companyId) {
                $companyStatement = $pdo->prepare(
                    'INSERT INTO companies (name, sector) VALUES (:name, :sector)'
                );
                $companyStatement->execute(['name' => $companyName, 'sector' => $sector]);
                $companyId = $pdo->lastInsertId();
            }
            $memberStatement = $pdo->prepare(
                'INSERT INTO company_members (company_id, user_id, position_title)
                 VALUES (:company_id, :user_id, :position_title)'
            );
            $memberStatement->execute([
                'company_id' => $companyId,
                'user_id' => $userId,
                'position_title' => 'HRD',
            ]);

            $pdo->commit();
            loginUser([
                'id' => $userId,
                'role' => 'hrd',
                'full_name' => $name,
                'email' => $email,
            ]);
            header('Location: hrd-dashboard.php');
            exit();
        } catch (PDOException $exception) {
            if (isset($pdo) && $pdo->inTransaction()) {
                $pdo->rollBack();
            }
            if ($exception->getCode() === '23000') {
                $error = 'Email atau nama perusahaan sudah terdaftar.';
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
    <title>Daftar Mitra HRD - CareerPath</title>
</head>
<body>
    <main style="max-width: 560px; margin: 48px auto; padding: 32px; background: #fff; border-radius: 16px;">
        <h1>Daftar Mitra HRD</h1>
        <?php if ($error !== ''): ?><p role="alert" style="color:#DC2626;"><?= h($error); ?></p><?php endif; ?>
        <form method="post">
            <p><label>Nama HRD <input name="full_name" required value="<?= h($_POST['full_name'] ?? ''); ?>"></label></p>
            <p><label>Email perusahaan <input type="email" name="email" required value="<?= h($_POST['email'] ?? ''); ?>"></label></p>
            <p><label>Nama perusahaan <input name="company_name" required value="<?= h($_POST['company_name'] ?? ''); ?>"></label></p>
            <p><label>Sektor industri <input name="sector" required value="<?= h($_POST['sector'] ?? ''); ?>"></label></p>
            <p><label>Kata sandi (minimal 8 karakter) <input type="password" name="password" minlength="8" required></label></p>
            <button type="submit">Daftar</button>
        </form>
        <p>Sudah memiliki akun? <a href="hrd-login.php">Masuk</a></p>
    </main>
</body>
</html>
