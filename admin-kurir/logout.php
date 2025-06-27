<?php
session_start();

// Hapus semua session
session_unset();
session_destroy();

// Hapus cookie username kalau ada
setcookie('username', '', time() - 3600, '/');

// Redirect ke halaman utama (ubah sesuai kebutuhan)
header("Location: index.php");
exit;
?>
