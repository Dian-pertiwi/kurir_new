<?php
// Include koneksi database
include 'config/koneksi.php';

// Cek apakah parameter id ada
if (isset($_GET['id'])) {
    // Ambil id dari URL
    $id_order = $_GET['id'];

    $sql = "DELETE FROM tbl_pengiriman_paket WHERE id_pengiriman = ?";
    
    // Siapkan statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameter (i = integer)
        $stmt->bind_param("i", $id_pengiriman);

        // Eksekusi query
        if ($stmt->execute()) {
            // Jika berhasil, redirect ke halaman daftar
            header("Location: daftar_penugasan.php?status=success");
            exit();
        } else {
            // Jika gagal, tampilkan pesan error
            echo "Error: " . $stmt->error;
        }

        // Tutup statement
        $stmt->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }
} else {
    echo "ID Order tidak ditemukan.";
}

// Tutup koneksi
$conn->close();
?>