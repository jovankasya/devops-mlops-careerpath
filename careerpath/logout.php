<<?php
// Memulai sesi
session_start();

// Cek jika user yang login memiliki role HRD atau jika Anda menggunakan penanda sesi tertentu
// Contoh: $_SESSION['role'] == 'hrd' atau check berdasarkan halaman asal
if (isset($_SESSION['role']) && $_SESSION['role'] === 'hrd') {
    // Hapus semua data sesi
    session_unset();
    session_destroy();
    
    // Alihkan khusus ke halaman login HRD
    header("Location: hrd-login.php");
    exit();
} else {
    // Hapus semua data sesi untuk pelamar/mahasiswa
    session_unset();
    session_destroy();
    
    // Alihkan ke halaman login mahasiswa/umum
    header("Location: login.php");
    exit();
}
?>