<?php
include 'config/koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM tbl_kecamatan WHERE id_kecamatan = $id";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<script>alert('Data berhasil dihapus!'); window.location='data_wilayah.php';</script>";
} else {
    echo "Gagal menghapus data: " . mysqli_error($conn);
}