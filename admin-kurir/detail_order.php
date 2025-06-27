<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_order = $_GET['id'] ?? 0;

$kurir_query = mysqli_query($conn, "SELECT * FROM tbl_data_kurir WHERE status = 'aktif'");
$kurir_options = '';
while ($kurir = mysqli_fetch_assoc($kurir_query)) {
    $kurir_options .= '<option value="' . $kurir['id_kurir'] . '">' . $kurir['nama_kurir'] . ' (' . $kurir['alamat_kurir'] . ')</option>';
}

$query = $conn->prepare("
    SELECT 
        p.*, t.tarif,
        s.nama_status, s.keterangan,
        j.nama_jenis_paket,
        peng.nama_pengirim, peng.kec_pengirim AS kecamatan_pengirim, peng.alamat_pengirim, peng.hp_pengirim,
        peng.no_rekening, b.nama_bank, ka.nama_kabupaten AS kabupaten_asal,
        pener.nama_penerima, pener.kec_pengirim AS kecamatan_penerima, pener.alamat_penerima, pener.hp_penerima,
        pener.link_maps, kt.nama_kabupaten AS kabupaten_tujuan,
        k1.nama_kurir AS kurir_antar,
        k2.nama_kurir AS kurir_jemput
    FROM tbl_pengiriman_paket p
    LEFT JOIN tbl_pengirim peng ON p.id_pengirim = peng.id_pengirim
    LEFT JOIN tbl_penerima pener ON p.id_penerima = pener.id_penerima
    LEFT JOIN tbl_kabupaten ka ON peng.id_kab_asal = ka.id_kab
    LEFT JOIN tbl_kabupaten kt ON pener.id_kab_tujuan = kt.id_kab
    LEFT JOIN tbl_bank b ON peng.id_bank = b.id_bank
    LEFT JOIN tbl_status_order s ON p.id_status_order = s.id_status
    LEFT JOIN tbl_jenis_paket j ON p.id_jenis_paket = j.id_jenis_paket
    LEFT JOIN tbl_tarif t ON p.id_tarif = t.id_tarif
    LEFT JOIN tbl_data_kurir k1 ON p.id_kurir_antar = k1.id_kurir
    LEFT JOIN tbl_data_kurir k2 ON p.id_kurir_jemput = k2.id_kurir
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

                    <!-- ROW 1: PENGIRIM & PENERIMA -->
                    <div class="row mb-4">
                        <!-- Pengirim -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-primary text-white">Informasi Pengirim</div>
                                <div class="card-body p-2">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td width="40%"><strong>Nama</strong></td>
                                            <td>: <?= htmlspecialchars($order['nama_pengirim']) ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kabupaten</strong></td>
                                            <td>: <?= htmlspecialchars($order['kabupaten_asal']) ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kecamatan</strong></td>
                                            <td>: <?= htmlspecialchars($order['kecamatan_pengirim']) ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Alamat</strong></td>
                                            <td>: <?= nl2br(htmlspecialchars($order['alamat_pengirim'])) ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>HP</strong></td>
                                            <td>: <?= htmlspecialchars($order['hp_pengirim']) ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Bank</strong></td>
                                            <td>: <?= htmlspecialchars($order['nama_bank']) ?> -
                                                <?= htmlspecialchars($order['no_rekening']) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Penerima -->
                        <div class="col-md-6 mt-4 mt-md-0">
                            <div class="card h-100">
                                <div class="card-header bg-success text-white">Informasi Penerima</div>
                                <div class="card-body p-2">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td width="40%"><strong>Nama</strong></td>
                                            <td>: <?= htmlspecialchars($order['nama_penerima']) ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kabupaten</strong></td>
                                            <td>: <?= htmlspecialchars($order['kabupaten_tujuan']) ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kecamatan</strong></td>
                                            <td>: <?= htmlspecialchars($order['kecamatan_penerima']) ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Alamat</strong></td>
                                            <td>: <?= nl2br(htmlspecialchars($order['alamat_penerima'])) ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>HP</strong></td>
                                            <td>: <?= htmlspecialchars($order['hp_penerima']) ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Link Maps</strong></td>
                                            <td>: <a href="<?= htmlspecialchars($order['link_maps']) ?>"
                                                    target="_blank">Lihat Lokasi</a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ROW 2: BARANG & PENGIRIMAN -->
                    <div class="row mb-4">
                        <!-- Barang -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-warning text-dark">Detail Barang</div>
                                <div class="card-body p-2">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td width="40%"><strong>Jenis Paket</strong></td>
                                            <td>: <?= htmlspecialchars($order['nama_jenis_paket']) ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Berat</strong></td>
                                            <td>: <?= htmlspecialchars($order['berat_barang']) ?> kg</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Harga</strong></td>
                                            <td>: Rp <?= number_format($order['harga_barang'], 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status Pembayaran (Lunas/COD) </strong></td>
                                            <td>: <?= ucfirst($order['status_pembayaran']) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Pengiriman -->
                        <div class="col-md-6 mt-4 mt-md-0">
                            <div class="card h-100">
                                <div class="card-header bg-info text-white">Informasi Pengiriman</div>
                                <div class="card-body p-2">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td width="40%"><strong>Kurir Jemput</strong></td>
                                            <td>: <?= htmlspecialchars($order['kurir_jemput'] ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kurir Antar</strong></td>
                                            <td>: <?= htmlspecialchars($order['kurir_antar'] ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tarif Ongkir</strong></td>
                                            <td>: Rp <?= number_format($order['tarif'], 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Resi</strong></td>
                                            <td>: <?= htmlspecialchars($order['resi'] ?? '-') ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status Order</strong></td>
                                            <td>: <?= htmlspecialchars($order['nama_status']) ?>
                                                <small>(<?= htmlspecialchars($order['keterangan']) ?>)</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Waktu Konfirmasi</strong></td>
                                            <td>:
                                                <?= $order['waktu_konfirmasi'] ? date('d M Y H:i', strtotime($order['waktu_konfirmasi'])) : '-' ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Bukti Transfer</strong></td>
                                            <td>:
                                                <?php if (!empty($order['bukti_tf_admin'])): ?>
                                                <a href="uploads/<?= htmlspecialchars($order['bukti_tf_admin']) ?>"
                                                    target="_blank">Lihat Bukti</a>
                                                <?php else: ?>
                                                Belum Diupload
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="text-center">
                        <?php if (isset($_SESSION['level']) && $_SESSION['level'] !== 'kurir'): ?>
                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#modalKonfirmasi<?= $id ?>">
                            <i class="fas fa-check"></i> Konfirmasi
                        </a>
                        <?php endif; ?>

                        <div class="modal fade" id="modalKonfirmasi<?= $id ?>" tabindex="-1" role="dialog"
                            aria-labelledby="modalKonfirmasiLabel<?= $id ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="proses_konfirmasi.php" method="POST">
                                    <input type="hidden" name="id_order" value="<?= $id ?>">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalKonfirmasiLabel<?= $id ?>">
                                                Konfirmasi Order #<?= $kode ?>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Kurir Jemput</label>
                                                <select name="id_kurir_jemput" class="form-control" required>
                                                    <option value="">-- Pilih Kurir Jemput --</option>
                                                    <?= $kurir_options ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kurir Antar</label>
                                                <select name="id_kurir_antar" class="form-control" required>
                                                    <option value="">-- Pilih Kurir Antar --</option>
                                                    <?= $kurir_options ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="konfirmasi"
                                                class="btn btn-primary">Konfirmasi</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </form>
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