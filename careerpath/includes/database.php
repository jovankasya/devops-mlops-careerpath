<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function db(): PDO
{
    static $connection = null;

    if ($connection instanceof PDO) {
        return $connection;
    }

    $host = getenv('CAREERPATH_DB_HOST') ?: '127.0.0.1';
    $port = getenv('CAREERPATH_DB_PORT') ?: '3306';
    $name = getenv('CAREERPATH_DB_NAME') ?: 'careerpath';
    $user = getenv('CAREERPATH_DB_USER') ?: 'root';
    $password = getenv('CAREERPATH_DB_PASSWORD') ?: '';

    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        $host,
        $port,
        $name
    );

    try {
        $connection = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    } catch (PDOException $exception) {
        error_log('CareerPath database connection failed: ' . $exception->getMessage());
        http_response_code(500);
        exit(
            'Koneksi database gagal. Periksa konfigurasi database di hosting '
            . 'dan pastikan database careerpath sudah diimpor.'
        );
    }

    return $connection;
}

function h($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function currentUser(): ?array
{
    return isset($_SESSION['user']) && is_array($_SESSION['user'])
        ? $_SESSION['user']
        : null;
}

function requireRole(string $role): array
{
    $user = currentUser();

    if ($user === null || ($user['role'] ?? null) !== $role) {
        header('Location: ' . ($role === 'hrd' ? 'hrd-login.php' : 'login.php'));
        exit();
    }

    return $user;
}

function loginUser(array $user): void
{
    session_regenerate_id(true);
    $_SESSION['user'] = [
        'id' => (int) $user['id'],
        'role' => $user['role'],
        'full_name' => $user['full_name'],
        'email' => $user['email'],
    ];
    $_SESSION['role'] = $user['role'];
}

function companyForUser(int $userId): array
{
    $statement = db()->prepare(
        'SELECT c.id, c.name, c.sector, c.website, c.description, c.logo_path,
                cm.position_title
         FROM company_members cm
         JOIN companies c ON c.id = cm.company_id
         WHERE cm.user_id = :user_id
         LIMIT 1'
    );
    $statement->execute(['user_id' => $userId]);
    $company = $statement->fetch();
    if (!$company) {
        http_response_code(403);
        exit('Akun HRD belum terhubung dengan perusahaan.');
    }

    return $company;
}
