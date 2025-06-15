<?php
include 'config/koneksi.php';

if (isset($_POST['konfirmasi'])) {
    $id_order = (int) $_POST['id_order'];
    $id_kurir_jemput = (int) $_POST['id_kurir_jemput'];
    $id_kurir_antar = (int) $_POST['id_kurir_antar'];
    $waktu_konfirmasi = date('Y-m-d H:i:s');


    $id_status_order = 2;

    // Update tbl_pengiriman_paket
    $update = mysqli_query($conn, "
        UPDATE tbl_pengiriman_paket SET 
            id_kurir_jemput = $id_kurir_jemput,
            id_kurir_antar = $id_kurir_antar,
            id_status_order = $id_status_order,
            waktu_konfirmasi = '$waktu_konfirmasi'
        WHERE id_pengiriman = $id_order
    ");

    if ($update) {
        echo "<script>alert('Order berhasil dikonfirmasi dan diproses.'); window.location='data_order.php';</script>";
    } else {
        echo "<script>alert('Gagal mengkonfirmasi order.'); window.location='data_order.php';</script>";
    }
} else {
    header("Location: data_order.php");
}
?>