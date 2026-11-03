<?php
require_once __DIR__ . '/includes/database.php';
$user = requireRole('hrd');
$company = companyForUser((int) $user['id']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Metode permintaan tidak diizinkan.');
}

$title = trim($_POST['posisi'] ?? '');
$department = trim($_POST['departemen'] ?? '');
$quota = filter_input(INPUT_POST, 'kuota', FILTER_VALIDATE_INT);
$description = trim($_POST['deskripsi'] ?? '');
$qualifications = trim($_POST['kualifikasi'] ?? '');
$allowedDepartments = ['tech', 'design'];
if ($title === '' || !in_array($department, $allowedDepartments, true)
    || !$quota || $quota < 1 || $description === '' || $qualifications === '') {
    http_response_code(422);
    exit('Data lowongan tidak valid. Periksa kembali isian formulir.');
}

$statement = db()->prepare(
    "INSERT INTO jobs (
        company_id, created_by, title, department, description, qualifications,
        location, work_mode, employment_type, quota, status, published_at
     ) VALUES (
        :company_id, :created_by, :title, :department, :description, :qualifications,
        'Indonesia', 'onsite', 'internship', :quota, 'published', CURRENT_TIMESTAMP
     )"
);
$statement->execute([
    'company_id' => $company['id'],
    'created_by' => $user['id'],
    'title' => $title,
    'department' => $department,
    'description' => $description,
    'qualifications' => $qualifications,
    'quota' => $quota,
]);

header('Location: hrd-jobs.php?created=1');
exit();
