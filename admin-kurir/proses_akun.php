<?php
session_start();
include 'config/koneksi.php';

// Fungsi untuk redirect
function redirect() {
    header("Location: akun.php");
    exit;
}

// Tambah akun baru
if (isset($_POST['tambah'])) {
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role     = mysqli_real_escape_string($conn, $_POST['role']);

    // Cek apakah username sudah ada
    $cek = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['pesan'] = "Username sudah digunakan!";
        redirect();
    }

    // Hash password
    $password_hash = md5($password);

    $query = "INSERT INTO tbl_user (nama, username, password, role) 
              VALUES ('$nama', '$username', '$password_hash', '$role')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['pesan'] = "Akun berhasil ditambahkan.";
    } else {
        $_SESSION['pesan'] = "Gagal menambahkan akun: " . mysqli_error($conn);
    }

    redirect();
}

// Update akun
if (isset($_POST['update'])) {
    $id_user  = (int)$_POST['id_user'];
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role     = mysqli_real_escape_string($conn, $_POST['role']);

    $query = "UPDATE tbl_user 
              SET nama = '$nama', username = '$username', role = '$role' 
              WHERE id_user = $id_user";

    if (mysqli_query($conn, $query)) {
        $_SESSION['pesan'] = "Akun berhasil diperbarui.";
    } else {
        $_SESSION['pesan'] = "Gagal memperbarui akun: " . mysqli_error($conn);
    }

    redirect();
}

// Hapus akun
if (isset($_GET['hapus'])) {
    $id_user = (int)$_GET['hapus'];

    // Jangan hapus diri sendiri
    if ($_SESSION['id_user'] == $id_user) {
        $_SESSION['pesan'] = "Tidak bisa menghapus akun sendiri.";
        redirect();
    }

    $query = "DELETE FROM tbl_user WHERE id_user = $id_user";

    if (mysqli_query($conn, $query)) {
        $_SESSION['pesan'] = "Akun berhasil dihapus.";
    } else {
        $_SESSION['pesan'] = "Gagal menghapus akun: " . mysqli_error($conn);
    }

    redirect();
}

// Jika tidak ada aksi valid
redirect();
