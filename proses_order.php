<?php
include 'admin-kurir/config/koneksi.php';

// Ambil data dari form
$nama_pengirim = $_POST['nama_pengirim'];
$kabupaten_pengirim = $_POST['kabupaten_pengirim'];
$kecamatan_pengirim = $_POST['kecamatan_pengirim'];
$alamat_pengirim = $_POST['alamat_pengirim'];
$hp_pengirim = $_POST['hp_pengirim'];
$nama_bank = $_POST['nama_bank'];
$no_rekening = $_POST['no_rekening'];

$nama_penerima = $_POST['nama_penerima'];
$kabupaten_penerima = $_POST['kabupaten_penerima'];
$kecamatan_penerima = $_POST['kecamatan_penerima'];
$alamat_penerima = $_POST['alamat_penerima'];
$hp_penerima = $_POST['hp_penerima'];
$link_maps = $_POST['link_maps'];

$jenis_barang = $_POST['jenis_barang'];
$berat_barang = $_POST['berat_barang'];
$harga_barang = $_POST['harga_barang'] ?? 0;

// Generate nomor resi
$resi = 'RESI' . strtoupper(uniqid());

$status_order = 'Menunggu Konfirmasi';
$waktu_konfirmasi = null; // Jika tidak ada, bisa set null
$kurir_jemput = null;
$kurir_antar = null;
$bukti_transfer_admin = null;
$tarif_ongkir = 0; // Asumsikan tarif ongkir defaultnya 0

// 1. Insert Data Pengirim
$query_pengirim = "INSERT INTO tbl_pengirim (nama_pengirim, kabupaten_pengirim, kecamatan_pengirim, alamat_pengirim, hp_pengirim, bank_pengirim, no_rekening) 
                   VALUES ('$nama_pengirim', '$kabupaten_pengirim', '$kecamatan_pengirim', '$alamat_pengirim', '$hp_pengirim', '$nama_bank', '$no_rekening')";
$conn->query($query_pengirim);
$id_pengirim = $conn->insert_id;

// 2. Insert Data Penerima
$query_penerima = "INSERT INTO tbl_penerima (nama_penerima, kabupaten_penerima, kecamatan_penerima, alamat_penerima, hp_penerima, link_maps) 
                   VALUES ('$nama_penerima', '$kabupaten_penerima', '$kecamatan_penerima', '$alamat_penerima', '$hp_penerima', '$link_maps')";
$conn->query($query_penerima);
$id_penerima = $conn->insert_id;

// 3. Insert Data Barang
$query_barang = "INSERT INTO tbl_barang (jenis_barang, berat_barang, harga_barang) 
                 VALUES ('$jenis_barang', '$berat_barang', '$harga_barang')";
$conn->query($query_barang);
$id_barang = $conn->insert_id;

if (empty($waktu_konfirmasi)) {
    $waktu_konfirmasi_sql = "NULL"; // literal NULL tanpa kutip
} else {
    $waktu_konfirmasi_sql = "'" . $waktu_konfirmasi . "'"; // bungkus kutip jika ada
}

// 4. Insert Data Pengiriman
$query_pengiriman = "INSERT INTO tbl_pengiriman (
    id_pengirim, id_penerima, id_barang, kurir_jemput, kurir_antar, resi,
    tarif_ongkir, status_order, bukti_transfer_admin, waktu_konfirmasi
) VALUES (
    $id_pengirim, $id_penerima, $id_barang, '$kurir_jemput', '$kurir_antar', '$resi',
    $tarif_ongkir, '$status_order', '$bukti_transfer_admin', $waktu_konfirmasi_sql
)";
$conn->query($query_pengiriman);


// Redirect ke halaman sukses
header("Location: order_sukses.php?resi=$resi");
exit();
?>