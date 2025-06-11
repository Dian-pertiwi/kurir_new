<?php
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kabupaten = mysqli_real_escape_string($conn, $_POST['nama_kabupaten']);
    $nama_kecamatan = mysqli_real_escape_string($conn, $_POST['nama_kecamatan']);

    // 1. Cek apakah kabupaten sudah ada
    $cek_kabupaten = mysqli_query($conn, "SELECT id_kabupaten FROM tbl_kabupaten WHERE nama_kabupaten = '$nama_kabupaten'");
    
    if (mysqli_num_rows($cek_kabupaten) > 0) {
        $data_kab = mysqli_fetch_assoc($cek_kabupaten);
        $id_kabupaten = $data_kab['id_kabupaten'];
    } else {
        $insert_kab = mysqli_query($conn, "INSERT INTO tbl_kabupaten (nama_kabupaten) VALUES ('$nama_kabupaten')");
        if ($insert_kab) {
            $id_kabupaten = mysqli_insert_id($conn);
        } else {
            die("Gagal menambahkan kabupaten: " . mysqli_error($conn));
        }
    }

    // 2. Cek apakah kecamatan sudah ada untuk kabupaten tersebut
    $cek_kecamatan = mysqli_query($conn, "SELECT * FROM tbl_kecamatan WHERE nama_kecamatan = '$nama_kecamatan' AND id_kabupaten = '$id_kabupaten'");
    
    if (mysqli_num_rows($cek_kecamatan) > 0) {
        echo "<script>alert('Nama kecamatan sudah ada untuk kabupaten ini!'); window.location='data_wilayah.php';</script>";
        exit;
    }

    // 3. Insert kecamatan
    $insert_kec = mysqli_query($conn, "INSERT INTO tbl_kecamatan (id_kabupaten, nama_kecamatan) VALUES ('$id_kabupaten', '$nama_kecamatan')");

    if ($insert_kec) {
        echo "<script>alert('Wilayah berhasil ditambahkan!'); window.location='data_wilayah.php';</script>";
    } else {
        echo "Gagal menambahkan kecamatan: " . mysqli_error($conn);
    }
} else {
    echo "<script>window.location='data_wilayah.php';</script>";
}
?>