<?php
include 'config/koneksi.php';

if (isset($_POST['konfirmasi'])) {
    $id_order = $_POST['id_order'];  // ID Order yang ingin dikonfirmasi
    $id_kurir_jemput = $_POST['id_kurir_jemput'];  // ID Kurir Jemput
    $id_kurir_antar = $_POST['id_kurir_antar'];  // ID Kurir Antar
    $tarif_ongkir = $_POST['tarif_ongkir'];  // Tarif Ongkir yang diterima
    $waktu_konfirmasi = date('Y-m-d H:i:s');  // Waktu konfirmasi saat ini

    // Ambil nama kurir jemput
    $kurir_jemput = '-';
    $result1 = mysqli_query($conn, "SELECT nama_kurir FROM tbl_data_kurir WHERE id_kurir = '$id_kurir_jemput'");
    if ($row1 = mysqli_fetch_assoc($result1)) {
        $kurir_jemput = $row1['nama_kurir'];
    }

    // Ambil nama kurir antar
    $kurir_antar = '-';
    $result2 = mysqli_query($conn, "SELECT nama_kurir FROM tbl_data_kurir WHERE id_kurir = '$id_kurir_antar'");
    if ($row2 = mysqli_fetch_assoc($result2)) {
        $kurir_antar = $row2['nama_kurir'];
    }

    // Update status order dan informasi lainnya di tbl_pengiriman
    $query = "UPDATE tbl_pengiriman 
              SET kurir_jemput = '$kurir_jemput', 
                  kurir_antar = '$kurir_antar', 
                  tarif_ongkir = '$tarif_ongkir', 
                  status_order = 'terkonfirmasi', 
                  waktu_konfirmasi = '$waktu_konfirmasi' 
              WHERE id_pengiriman = '$id_order'";  // Menggunakan id_pengiriman yang diassosiasikan dengan id_order

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Order berhasil dikonfirmasi.'); window.location='data_order.php';</script>";
    } else {
        echo "<script>alert('Gagal mengkonfirmasi order.'); window.location='data_order.php';</script>";
    }
} else {
    header("Location: data_order.php");
}
?>