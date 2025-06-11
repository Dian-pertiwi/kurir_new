<?php
// Include koneksi database
include 'config/koneksi.php';

// Cek apakah parameter id ada
if (isset($_GET['id'])) {
    // Ambil id dari URL
    $id_order = $_GET['id'];

    // Query untuk menghapus data berdasarkan id_order_masuk
    $sql = "DELETE FROM tbl_order_masuk WHERE id_order_masuk = ?";
    
    // Siapkan statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameter (i = integer)
        $stmt->bind_param("i", $id_order);

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