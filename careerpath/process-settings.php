<?php
require_once __DIR__ . '/includes/database.php';
$user = requireRole('hrd');
$company = companyForUser((int) $user['id']);
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Metode permintaan tidak diizinkan.');
}

$companyName = trim($_POST['nama_perusahaan'] ?? '');
$sector = trim($_POST['sektor'] ?? '');
$website = trim($_POST['website'] ?? '');
$description = trim($_POST['deskripsi'] ?? '');
$hrdName = trim($_POST['nama_hrd'] ?? '');
$email = trim($_POST['email_hrd'] ?? '');
if ($companyName === '' || $hrdName === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)
    || ($website !== '' && !filter_var($website, FILTER_VALIDATE_URL))) {
    http_response_code(422);
    exit('Data pengaturan tidak valid.');
}

$pdo = db();
try {
    $pdo->beginTransaction();
    $pdo->prepare(
        'UPDATE companies SET name = :name, sector = :sector,
            website = :website, description = :description
         WHERE id = :company_id'
    )->execute([
        'name' => $companyName,
        'sector' => $sector ?: null,
        'website' => $website ?: null,
        'description' => $description ?: null,
        'company_id' => $company['id'],
    ]);
    $pdo->prepare(
        'UPDATE users SET full_name = :name, email = :email WHERE id = :user_id'
    )->execute(['name' => $hrdName, 'email' => $email, 'user_id' => $user['id']]);
    $pdo->commit();
    $_SESSION['user']['full_name'] = $hrdName;
    $_SESSION['user']['email'] = $email;
    header('Location: hrd-settings.php?saved=1');
    exit();
} catch (PDOException $exception) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    if ($exception->getCode() === '23000') {
        http_response_code(409);
        exit('Email HRD atau nama perusahaan sudah digunakan.');
    }
    throw $exception;
}
