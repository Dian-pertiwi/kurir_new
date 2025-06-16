<?php
include 'config/koneksi.php';

session_start();
if ($_SESSION['level'] !== 'admin') {
    echo "Akses ditolak. Halaman ini hanya untuk admin.";
    exit;
}


$id = $_GET['id'];

$query = "DELETE FROM tbl_data_kurir WHERE id_kurir = '$id'";
mysqli_query($conn, $query);

header("Location: data_kurir.php");
?>