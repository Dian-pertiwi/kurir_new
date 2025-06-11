<?php
include 'config/koneksi.php';
$id_order = $_GET['id'] ?? 0;

$query = $conn->prepare("SELECT * FROM tbl_pengiriman WHERE id_pengiriman = ?");
$query->bind_param("i", $id_order);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    die("<div class='alert alert-danger'>Order tidak ditemukan.</div>");
}

$order = $result->fetch_assoc();

// Ambil data pengirim
$query_pengirim = $conn->prepare("SELECT * FROM tbl_pengirim WHERE id_pengirim = ?");
$query_pengirim->bind_param("i", $order['id_pengirim']);
$query_pengirim->execute();
$result_pengirim = $query_pengirim->get_result();
$pengirim = $result_pengirim->fetch_assoc();

// Ambil data penerima
$query_penerima = $conn->prepare("SELECT * FROM tbl_penerima WHERE id_penerima = ?");
$query_penerima->bind_param("i", $order['id_penerima']);
$query_penerima->execute();
$result_penerima = $query_penerima->get_result();
$penerima = $result_penerima->fetch_assoc();

// Ambil data barang
$query_barang = $conn->prepare("SELECT * FROM tbl_barang WHERE id_barang = ?");
$query_barang->bind_param("i", $order['id_barang']);
$query_barang->execute();
$result_barang = $query_barang->get_result();
$barang = $result_barang->fetch_assoc();
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

                            <!-- Data Pengirim -->
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
                                            <td><?= htmlspecialchars($pengirim['nama_pengirim']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kabupaten</th>
                                            <td><?= htmlspecialchars($pengirim['kabupaten_pengirim']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kecamatan</th>
                                            <td><?= htmlspecialchars($pengirim['kecamatan_pengirim']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat Lengkap</th>
                                            <td><?= nl2br(htmlspecialchars($pengirim['alamat_pengirim'])) ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. HP</th>
                                            <td><?= htmlspecialchars($pengirim['hp_pengirim']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama Bank</th>
                                            <td><?= htmlspecialchars($pengirim['bank_pengirim']) . ' - ' . htmlspecialchars($pengirim['no_rekening']) ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Data Penerima -->
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
                                            <td><?= htmlspecialchars($penerima['nama_penerima']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kabupaten</th>
                                            <td><?= htmlspecialchars($penerima['kabupaten_penerima']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kecamatan</th>
                                            <td><?= htmlspecialchars($penerima['kecamatan_penerima']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat Lengkap</th>
                                            <td><?= nl2br(htmlspecialchars($penerima['alamat_penerima'])) ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. HP</th>
                                            <td><?= htmlspecialchars($penerima['hp_penerima']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Link Maps</th>
                                            <td><a href="<?= htmlspecialchars($penerima['link_maps']) ?>"
                                                    target="_blank">Lihat Lokasi</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Info Barang -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="bg-warning text-dark">DETAIL BARANG</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Jenis Barang</th>
                                            <td><?= htmlspecialchars($barang['jenis_barang']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Berat Barang</th>
                                            <td><?= htmlspecialchars($barang['berat_barang']) ?> kg</td>
                                        </tr>
                                        <tr>
                                            <th>Harga Barang</th>
                                            <td>Rp <?= number_format($barang['harga_barang'], 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status Pembayaran</th>
                                            <td>COD</td>
                                        </tr>
                                        <tr>
                                            <th>Waktu Order</th>
                                            <td><?= date('d M Y, H:i', strtotime($order['created_at'] ?? 'now')) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td><?= ucfirst($order['status_order'] ?? 'menunggu') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tarif Ongkir</th>
                                            <td>Rp <?= number_format($order['tarif_ongkir'] ?? 0, 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Resi</th>
                                            <td><?= htmlspecialchars($order['resi'] ?? '-') ?></td>
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