<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    echo "<script>
        alert('Anda belum login. Silakan login terlebih dahulu.');
        window.location.href = 'user_login.php';
    </script>";
    exit;
}

include 'admin-kurir/config/koneksi.php';

function escape($conn, $val) {
    return $conn->real_escape_string(trim($val));
}

// Pastikan user login
if (!isset($_SESSION['id_user'])) {
    die("Anda belum login.");
}
$id_user = $_SESSION['id_user'];

// Ambil id_pengirim berdasarkan user login
$get_pengirim = mysqli_query($conn, "SELECT id_pengirim FROM tbl_pengirim WHERE id_user = $id_user LIMIT 1");
if (!$get_pengirim || mysqli_num_rows($get_pengirim) === 0) {
    die("Data pengirim tidak ditemukan. Silakan lengkapi profil Anda terlebih dahulu.");
}
$id_pengirim = mysqli_fetch_assoc($get_pengirim)['id_pengirim'];

// --- DATA PENERIMA ---
$nama_penerima      = escape($conn, $_POST['nama_penerima']);
$id_kab_tujuan      = (int)$_POST['id_kab_tujuan'];
$kecamatan_penerima = escape($conn, $_POST['kecamatan_penerima']);
$alamat_penerima    = escape($conn, $_POST['alamat_penerima']);
$hp_penerima        = escape($conn, $_POST['hp_penerima']);
$link_maps          = escape($conn, $_POST['link_maps']);

// --- DETAIL BARANG ---
$id_jenis_paket     = (int)$_POST['jenis_paket'];
$berat_barang       = (float)$_POST['berat_barang'];
$harga_barang       = (float)($_POST['harga_barang'] ?? 0);
$status_pembayaran  = escape($conn, $_POST['status_pembayaran']);
$id_status_order    = 1; // Status awal: Menunggu konfirmasi
$resi               = 'RESI' . strtoupper(uniqid());

// --- CARI ID TARIF ---
$sql_tarif = "SELECT id_tarif FROM tbl_tarif WHERE id_kab_tujuan = $id_kab_tujuan LIMIT 1";
$res_tarif = $conn->query($sql_tarif);
if ($res_tarif && $res_tarif->num_rows > 0) {
    $data_tarif = $res_tarif->fetch_assoc();
    $id_tarif = (int)$data_tarif['id_tarif'];
} else {
    die("Gagal: Tarif tidak ditemukan.");
}

// --- INSERT tbl_penerima ---
$sql_penerima = "INSERT INTO tbl_penerima (
    id_kab_tujuan, nama_penerima, kec_pengirim, alamat_penerima, hp_penerima, link_maps
) VALUES (
    $id_kab_tujuan, '$nama_penerima', '$kecamatan_penerima', '$alamat_penerima', '$hp_penerima', '$link_maps'
)";
if (!$conn->query($sql_penerima)) {
    die("Gagal menyimpan data penerima: " . $conn->error);
}
$id_penerima = $conn->insert_id;

// --- INSERT tbl_pengiriman_paket ---
$sql_pengiriman = "INSERT INTO tbl_pengiriman_paket (
    id_tarif, id_pengirim, id_penerima, id_jenis_paket, id_status_order,
    id_kurir_jemput, id_kurir_antar,
    berat_barang, harga_barang, status_pembayaran, resi
) VALUES (
    $id_tarif, $id_pengirim, $id_penerima, $id_jenis_paket, $id_status_order,
    NULL, NULL,
    $berat_barang, $harga_barang, '$status_pembayaran', '$resi'
)";

if ($conn->query($sql_pengiriman)) {
    header("Location: order_sukses.php?status=berhasil&resi=$resi");
    exit();
} else {
    echo "Gagal menyimpan data pengiriman: " . $conn->error;
}
