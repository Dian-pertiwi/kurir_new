<?php
session_start();
session_unset();    // Menghapus semua variabel sesi
session_destroy();  // Mengakhiri sesi

// Redirect ke halaman utama
header("Location: index.php");
exit;
?>
