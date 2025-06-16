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