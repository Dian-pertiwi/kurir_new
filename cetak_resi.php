<?php
include 'admin-kurir/config/koneksi.php';

// Ambil nomor resi dari parameter URL
$resi = isset($_GET['resi']) ? $_GET['resi'] : '';

// Cek dan ambil data dari database
$query = "SELECT 
    p.nama_pengirim, p.alamat_pengirim, p.hp_pengirim,
    p.nama_penerima, p.alamat_penerima, p.hp_penerima,
    p.berat_barang, p.harga_barang, p.resi, 
    k1.nama_kabupaten AS kab_asal, 
    k2.nama_kabupaten AS kab_tujuan,
    t.tarif
FROM tbl_pengiriman_paket p
JOIN tbl_kabupaten k1 ON p.id_kab_asal = k1.id_kab
JOIN tbl_kabupaten k2 ON p.id_kab_tujuan = k2.id_kab
JOIN tbl_tarif t ON p.id_tarif = t.id_tarif
WHERE p.resi = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $resi);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Resi tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Resi - Becat Kurir NTB</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        padding: 30px;
    }

    .resi-container {
        border: 2px dashed #333;
        padding: 20px;
        width: 600px;
        margin: auto;
    }

    .section {
        margin-bottom: 15px;
    }

    .label {
        font-weight: bold;
        width: 150px;
        display: inline-block;
    }

    .title {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .print-button {
        margin-top: 20px;
        text-align: center;
    }

    @media print {
        .print-button {
            display: none;
        }
    }
    </style>
</head>

<body>

    <div class="resi-container">
        <div class="title">📦 RESI PENGIRIMAN<br>Becat Kurir NTB</div>

        <div class="section">
            <div><span class="label">Nomor Resi:</span> <?= htmlspecialchars($data['resi']) ?></div>
        </div>

        <div class="section">
            <strong>Data Pengirim</strong><br>
            <div><span class="label">Nama:</span> <?= htmlspecialchars($data['nama_pengirim']) ?></div>
            <div><span class="label">Alamat:</span> <?= htmlspecialchars($data['alamat_pengirim']) ?></div>
            <div><span class="label">No. HP:</span> <?= htmlspecialchars($data['hp_pengirim']) ?></div>
            <div><span class="label">Kabupaten:</span> <?= htmlspecialchars($data['kab_asal']) ?></div>
        </div>

        <div class="section">
            <strong>Data Penerima</strong><br>
            <div><span class="label">Nama:</span> <?= htmlspecialchars($data['nama_penerima']) ?></div>
            <div><span class="label">Alamat:</span> <?= htmlspecialchars($data['alamat_penerima']) ?></div>
            <div><span class="label">No. HP:</span> <?= htmlspecialchars($data['hp_penerima']) ?></div>
            <div><span class="label">Kabupaten:</span> <?= htmlspecialchars($data['kab_tujuan']) ?></div>
        </div>

        <div class="section">
            <strong>Detail Paket</strong><br>
            <div><span class="label">Berat:</span> <?= $data['berat_barang'] ?> Kg</div>
            <div><span class="label">Harga Barang:</span> Rp<?= number_format($data['harga_barang'], 0, ',', '.') ?>
            </div>
            <div><span class="label">Tarif Ongkir:</span> Rp<?= number_format($data['tarif'], 0, ',', '.') ?></div>
        </div>

        <div class="print-button">
            <button onclick="window.print()">🖨️ Cetak</button>
        </div>
    </div>

</body>

</html>