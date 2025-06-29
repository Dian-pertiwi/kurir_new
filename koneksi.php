<?php
$host = "localhost";
$user = "root";
$pass = "root";
$db   = "db_becat_kurir"; 

$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>