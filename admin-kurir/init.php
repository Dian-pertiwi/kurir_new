<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'config/koneksi.php';

// Cek apakah sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

// Total pengiriman hari ini
$today = date('Y-m-d');
$q_pengiriman_hari_ini = mysqli_query($conn, "
    SELECT COUNT(*) AS total 
    FROM tbl_pengiriman_paket 
    WHERE DATE(waktu_konfirmasi) = '$today'
");
$total_pengiriman_hari_ini = mysqli_fetch_assoc($q_pengiriman_hari_ini)['total'] ?? 0;

// Total pengiriman berhasil hari ini
$q_berhasil_hari_ini = mysqli_query($conn, "
    SELECT COUNT(*) AS total 
    FROM tbl_pengiriman_paket 
    WHERE DATE(waktu_konfirmasi) = '$today' 
      AND id_status_order = 5
");
$total_berhasil_hari_ini = mysqli_fetch_assoc($q_berhasil_hari_ini)['total'] ?? 0;

// Total pengguna
$q_pengguna = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_user");
$total_pengguna = mysqli_fetch_assoc($q_pengguna)['total'] ?? 0;

// Paket pending (% dari total)
$q_pending = mysqli_query($conn, "
    SELECT COUNT(*) AS total FROM tbl_pengiriman_paket 
    WHERE id_status_order IN (1, 2, 3)
");
$total_pending = mysqli_fetch_assoc($q_pending)['total'] ?? 0;

$q_total_all = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_pengiriman_paket");
$total_all = mysqli_fetch_assoc($q_total_all)['total'] ?? 1; // avoid div by 0

// $presentase_pending = round(($total_pending / $total_all) * 100);

$presentase_pending = ($total_all > 0) 
    ? round(($total_pending / $total_all) * 100)
    : 0;


    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    include 'config/koneksi.php';
    
    // Cek login
    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }