<?php
include 'admin-kurir/config/koneksi.php';

// Fungsi sederhana untuk escape input (kalau belum pakai prepared statement)
function escape($conn, $val) {
    return $conn->real_escape_string(trim($val));
}

// Ambil data dari form & sanitasi
$nama_pengirim        = escape($conn, $_POST['nama_pengirim']);
$id_kab_asal          = (int)$_POST['id_kab_asal'];
$kecamatan_pengirim   = escape($conn, $_POST['kecamatan_pengirim']);
$alamat_pengirim      = escape($conn, $_POST['alamat_pengirim']);
$hp_pengirim          = escape($conn, $_POST['hp_pengirim']);
$id_bank              = (int)$_POST['id_bank'];
$no_rekening          = escape($conn, $_POST['no_rekening']);

$nama_penerima        = escape($conn, $_POST['nama_penerima']);
$id_kab_tujuan        = (int)$_POST['id_kab_tujuan'];
$kecamatan_penerima   = escape($conn, $_POST['kecamatan_penerima']);
$alamat_penerima      = escape($conn, $_POST['alamat_penerima']);
$hp_penerima          = escape($conn, $_POST['hp_penerima']);
$link_maps            = escape($conn, $_POST['link_maps']);

$id_jenis_paket       = (int)$_POST['jenis_paket'];
$berat_barang         = (float)$_POST['berat_barang'];
$harga_barang         = (float)($_POST['harga_barang'] ?? 0);
$status_pembayaran    = escape($conn, $_POST['status_pembayaran']);
$tarif_ongkir         = (float)($_POST['tarif_ongkir'] ?? 0);

$id_status_order      = 1; // default: Menunggu Konfirmasi
$resi                 = 'RESI' . strtoupper(uniqid());

// Cari id_tarif berdasarkan kabupaten asal & tujuan
$id_tarif = null;
$sql_tarif = "SELECT id_tarif FROM tbl_tarif WHERE id_kab_asal = $id_kab_asal AND id_kab_tujuan = $id_kab_tujuan LIMIT 1";
$res_tarif = $conn->query($sql_tarif);
if ($res_tarif && $res_tarif->num_rows > 0) {
    $data_tarif = $res_tarif->fetch_assoc();
    $id_tarif = (int)$data_tarif['id_tarif'];
} else {
    die("Gagal: Tidak ditemukan data tarif dari asal ke tujuan.");
}

// Validasi tarif ditemukan
if (!$id_tarif) {
    die("Tarif ongkir tidak ditemukan untuk kabupaten yang dipilih.");
}

// Query simpan ke tabel tbl_pengiriman_paket
$sql = "INSERT INTO tbl_pengiriman_paket (
    id_tarif, id_bank, id_status_order, id_kurir_antar, id_kurir_jemput,
    id_kab_asal, id_kab_tujuan,
    nama_pengirim, kecamatan_pengirim, alamat_pengirim, hp_pengirim, no_rekening,
    nama_penerima, kecamatan_penerima, alamat_penerima, hp_penerima, link_maps,
    id_jenis_paket, berat_barang, harga_barang, status_pembayaran, resi
) VALUES (
    $id_tarif, $id_bank, $id_status_order, NULL, NULL,
    $id_kab_asal, $id_kab_tujuan,
    '$nama_pengirim', '$kecamatan_pengirim', '$alamat_pengirim', '$hp_pengirim', '$no_rekening',
    '$nama_penerima', '$kecamatan_penerima', '$alamat_penerima', '$hp_penerima', '$link_maps',
    $id_jenis_paket, $berat_barang, $harga_barang, '$status_pembayaran', '$resi'
)";

// Eksekusi query simpan ke database
if ($conn->query($sql)) {
    header("Location: order_sukses.php?status=berhasil&resi=$resi");
    exit();
} else {
    // Tampilkan error kalau gagal
    echo "Gagal menyimpan data: " . $conn->error;
}

?>