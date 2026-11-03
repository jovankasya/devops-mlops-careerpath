<?php
require_once __DIR__ . '/includes/database.php';
$user = currentUser();
if (!$user) {
    http_response_code(401);
    exit('Silakan masuk terlebih dahulu.');
}

$applicationId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($user['role'] === 'mahasiswa' && !$applicationId) {
    $statement = db()->prepare(
        'SELECT cv_path FROM student_profiles WHERE user_id = :user_id'
    );
    $statement->execute(['user_id' => $user['id']]);
    $cvPath = $statement->fetchColumn();
} elseif ($user['role'] === 'hrd' && $applicationId) {
    $company = companyForUser((int) $user['id']);
    $statement = db()->prepare(
        'SELECT a.cv_path
         FROM applications a JOIN jobs j ON j.id = a.job_id
         WHERE a.id = :application_id AND j.company_id = :company_id'
    );
    $statement->execute([
        'application_id' => $applicationId,
        'company_id' => $company['id'],
    ]);
    $cvPath = $statement->fetchColumn();
} else {
    http_response_code(403);
    exit('Anda tidak memiliki izin untuk mengakses berkas ini.');
}

if (!$cvPath || strpos($cvPath, 'uploads/cv/') !== 0) {
    http_response_code(404);
    exit('CV tidak ditemukan.');
}

$directory = realpath(__DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'cv');
$file = realpath(__DIR__ . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $cvPath));
if (!$directory || !$file || strpos($file, $directory . DIRECTORY_SEPARATOR) !== 0 || !is_file($file)) {
    http_response_code(404);
    exit('CV tidak ditemukan.');
}

$extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
$contentTypes = [
    'pdf' => 'application/pdf',
    'doc' => 'application/msword',
    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
];
if (!isset($contentTypes[$extension])) {
    http_response_code(415);
    exit('Format CV tidak didukung.');
}

header('Content-Type: ' . $contentTypes[$extension]);
header('Content-Length: ' . filesize($file));
header('Content-Disposition: attachment; filename="CV-' . (int) $user['id'] . '.' . $extension . '"');
readfile($file);
exit();
