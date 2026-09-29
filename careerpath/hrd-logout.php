<?php
// Memulai session
session_start();

// Hapus semua data session HRD
session_unset();
session_destroy();

// Alihkan langsung ke halaman login khusus HRD
header("Location: hrd-login.php");
exit();
?>