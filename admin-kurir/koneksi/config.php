<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_kurir"; 
$port = "3306";

$conn = mysqli_connect($host, $user, $pass, $db, $port);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>