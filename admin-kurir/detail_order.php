<?php
session_start();
include 'config/koneksi.php';

// Cek apakah sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

// Query data kurir
$query = mysqli_query($conn, "SELECT * FROM tbl_user WHERE role = 'kurir'");

$id_order = $_GET['id'] ?? 0;

// Ambil data utama pengiriman + relasi
$query = $conn->prepare("
    SELECT 
        p.*,
        b.nama_bank,
        s.nama_status,
        s.keterangan,
        ka.nama_kabupaten AS kabupaten_asal,
        kt.nama_kabupaten AS kabupaten_tujuan,
        k1.nama_kurir AS kurir_antar,
        k2.nama_kurir AS kurir_jemput,
        j.nama_jenis_paket,
        t.tarif
    FROM tbl_pengiriman_paket p
    LEFT JOIN tbl_bank b ON p.id_bank = b.id_bank
    LEFT JOIN tbl_status_order s ON p.id_status_order = s.id_status
    LEFT JOIN tbl_kabupaten ka ON p.id_kab_asal = ka.id_kab
    LEFT JOIN tbl_kabupaten kt ON p.id_kab_tujuan = kt.id_kab
    LEFT JOIN tbl_data_kurir k1 ON p.id_kurir_antar = k1.id_kurir
    LEFT JOIN tbl_data_kurir k2 ON p.id_kurir_jemput = k2.id_kurir
    LEFT JOIN tbl_jenis_paket j ON p.id_jenis_paket = j.id_jenis_paket
    LEFT JOIN tbl_tarif t ON p.id_tarif = t.id_tarif
    WHERE p.id_pengiriman = ?
");
$query->bind_param("i", $id_order);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    die("<div class='alert alert-danger'>Order tidak ditemukan.</div>");
}

$order = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="id">

<?php include 'head.php'; ?>

<body id="page-top">
    <div id="wrapper">
        <?php include 'sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'navbar.php'; ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Detail Orderan</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-primary text-white">
                            <h6 class="m-0 font-weight-bold">Informasi Orderan
                                #<?= htmlspecialchars($order['kode_pengiriman'] ?? 'PKT' . str_pad($order['id_pengiriman'], 3, '0', STR_PAD_LEFT)) ?>
                            </h6>
                        </div>
                        <div class="card-body">

                            <!-- Bagian Pengirim -->
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="bg-primary text-white">PENGIRIM</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Nama</th>
                                            <td><?= htmlspecialchars($order['nama_pengirim']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kabupaten</th>
                                            <td><?= htmlspecialchars($order['kabupaten_asal']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kecamatan</th>
                                            <td><?= htmlspecialchars($order['kecamatan_pengirim']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td><?= nl2br(htmlspecialchars($order['alamat_pengirim'])) ?></td>
                                        </tr>
                                        <tr>
                                            <th>HP</th>
                                            <td><?= htmlspecialchars($order['hp_pengirim']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Bank</th>
                                            <td><?= htmlspecialchars($order['nama_bank']) ?> -
                                                <?= htmlspecialchars($order['no_rekening']) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Bagian Penerima -->
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="bg-success text-white">PENERIMA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Nama</th>
                                            <td><?= htmlspecialchars($order['nama_penerima']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kabupaten</th>
                                            <td><?= htmlspecialchars($order['kabupaten_tujuan']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kecamatan</th>
                                            <td><?= htmlspecialchars($order['kecamatan_penerima']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td><?= nl2br(htmlspecialchars($order['alamat_penerima'])) ?></td>
                                        </tr>
                                        <tr>
                                            <th>HP</th>
                                            <td><?= htmlspecialchars($order['hp_penerima']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Link Maps</th>
                                            <td><a href="<?= htmlspecialchars($order['link_maps']) ?>"
                                                    target="_blank">Lihat Lokasi</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Detail Barang -->
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="bg-warning text-dark">DETAIL BARANG</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Jenis Paket</th>
                                            <td><?= htmlspecialchars($order['nama_jenis_paket']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Berat</th>
                                            <td><?= htmlspecialchars($order['berat_barang']) ?> kg</td>
                                        </tr>
                                        <tr>
                                            <th>Harga</th>
                                            <td>Rp <?= number_format($order['harga_barang'], 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status Pembayaran</th>
                                            <td><?= ucfirst($order['status_pembayaran']) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Info Pengiriman -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="bg-info text-white">INFORMASI PENGIRIMAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Kurir Jemput</th>
                                            <td><?= htmlspecialchars($order['kurir_jemput'] ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kurir Antar</th>
                                            <td><?= htmlspecialchars($order['kurir_antar'] ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tarif Ongkir</th>
                                            <td>Rp <?= number_format($order['tarif'], 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Resi</th>
                                            <td><?= htmlspecialchars($order['resi'] ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status Order</th>
                                            <td><?= htmlspecialchars($order['nama_status']) ?>
                                                <small>(<?= $order['keterangan'] ?>)</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Waktu Konfirmasi</th>
                                            <td><?= $order['waktu_konfirmasi'] ? date('d M Y H:i', strtotime($order['waktu_konfirmasi'])) : '-' ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Bukti Transfer</th>
                                            <td>
                                                <?php if (!empty($order['bukti_tf_admin'])): ?>
                                                <a href="uploads/<?= $order['bukti_tf_admin'] ?>" target="_blank">Lihat
                                                    Bukti</a>
                                                <?php else: ?>
                                                Belum Diupload
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </div>
</body>

</html>