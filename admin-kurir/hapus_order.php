<?php
session_start();
include 'config/koneksi.php';

// Validasi login
if (!isset($_SESSION['id_user'])) {
    echo "<script>alert('Anda belum login'); window.location='login.php';</script>";
    exit;
}

// Gunakan POST karena data dikirim dari modal
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_pengiriman'])) {
    $id_pengiriman = (int) $_POST['id_pengiriman'];

    // Pastikan data ada dulu
    $cek = mysqli_query($conn, "SELECT id_pengiriman FROM tbl_pengiriman_paket WHERE id_pengiriman = $id_pengiriman");
    if (mysqli_num_rows($cek) === 0) {
        echo "<script>alert('ID Order tidak ditemukan.'); window.location='data_order.php';</script>";
        exit;
    }

    // Lakukan penghapusan
    $sql = "DELETE FROM tbl_pengiriman_paket WHERE id_pengiriman = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_pengiriman);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus.'); window.location='data_order.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data.'); window.location='data_order.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Permintaan tidak valid.'); window.location='data_order.php';</script>";
}

$conn->close();
?>
