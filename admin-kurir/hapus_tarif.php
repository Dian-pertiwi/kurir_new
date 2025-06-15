<?php
include 'config/koneksi.php';

if (!isset($_GET['id'])) {
    // Kalau tidak ada ID, langsung redirect ke halaman data
    header("Location: data_tarif.php");
    exit;
}

$id = $_GET['id'];

// Hapus data tarif ongkir berdasarkan ID
$hapus_query = "DELETE FROM tbl_tarif WHERE id_tarif = '$id'";
$hapus_result = mysqli_query($conn, $hapus_query);

if ($hapus_result) {
    header("Location: data_tarif.php?pesan=hapus_sukses");
} else {
    echo "Gagal menghapus data: " . mysqli_error($conn);
}
?>