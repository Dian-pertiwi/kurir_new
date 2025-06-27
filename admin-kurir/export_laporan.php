<?php
include 'config/koneksi.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=laporan_pengiriman_' . date('Ymd_His') . '.csv');

// Kolom judul
$output = fopen('php://output', 'w');
fputcsv($output, ['No', 'Resi', 'Nama Pengirim', 'Nama Penerima', 'Berat', 'Harga Barang', 'Status Pembayaran', 'Status Order', 'Tanggal Konfirmasi']);

// Ambil data (gabung pengirim & penerima untuk tampilan)
$query = mysqli_query($conn, "
    SELECT 
        p.resi,
        peng.nama_pengirim,
        terima.nama_penerima,
        p.berat_barang,
        p.harga_barang,
        p.status_pembayaran,
        status.nama_status,
        p.waktu_konfirmasi
    FROM tbl_pengiriman_paket p
    JOIN tbl_pengirim peng ON p.id_pengirim = peng.id_pengirim
    JOIN tbl_penerima terima ON p.id_penerima = terima.id_penerima
    JOIN tbl_status_order status ON p.id_status_order = status.id_status
    ORDER BY p.waktu_konfirmasi DESC
");

$no = 1;
while ($row = mysqli_fetch_assoc($query)) {
    fputcsv($output, [
        $no++,
        $row['resi'],
        $row['nama_pengirim'],
        $row['nama_penerima'],
        $row['berat_barang'],
        $row['harga_barang'],
        $row['status_pembayaran'],
        $row['nama_status'],
        $row['waktu_konfirmasi'],
    ]);
}

fclose($output);
exit;
