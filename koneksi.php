<?php
$host = "localhost";
$user = "root";
<<<<<<< HEAD
$pass = "";
=======
$pass = "root";
>>>>>>> 0464179c3e94ea5fd7b1d40261c46ef89d21f997
$db   = "db_becat_kurir"; 

$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>