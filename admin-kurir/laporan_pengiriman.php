<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

// Ambil filter
$tgl_mulai = $_GET['tgl_mulai'] ?? '';
$tgl_akhir = $_GET['tgl_akhir'] ?? '';
$status = $_GET['status'] ?? '';

// Query utama
$sql = "
    SELECT 
        p.*, 
        peng.nama_pengirim, 
        pener.nama_penerima, 
        k1.nama_kurir AS kurir_jemput,
        k2.nama_kurir AS kurir_antar,
        t.tarif
    FROM tbl_pengiriman_paket p
    LEFT JOIN tbl_pengirim peng ON p.id_pengirim = peng.id_pengirim
    LEFT JOIN tbl_penerima pener ON p.id_penerima = pener.id_penerima
    LEFT JOIN tbl_data_kurir k1 ON p.id_kurir_jemput = k1.id_kurir
    LEFT JOIN tbl_data_kurir k2 ON p.id_kurir_antar = k2.id_kurir
    LEFT JOIN tbl_tarif t ON p.id_tarif = t.id_tarif
    WHERE 1=1
";

// Tambahkan filter jika ada
if ($tgl_mulai && $tgl_akhir) {
    $sql .= " AND DATE(p.waktu_konfirmasi) BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
}
if ($status !== '') {
    $sql .= " AND p.status_pembayaran = '$status'";
}

$sql .= " ORDER BY p.waktu_konfirmasi DESC";

$query = $conn->query($sql);
$data = [];
$total_tarif = 0;

while ($row = $query->fetch_assoc()) {
    $data[] = $row;
    $total_tarif += $row['tarif'];
}
?>

<!DOCTYPE html>
<html lang="id">
<?php include 'head.php'; ?>

<style>
@media print {
    body * {
        visibility: hidden;
    }

    .print-area,
    .print-area * {
        visibility: visible;
    }

    .print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }

    .no-print {
        display: none !important;
    }
}
</style>

<body id="page-top">
<div id="wrapper">
<?php include 'sidebar.php'; ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php include 'navbar.php'; ?>

        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800 no-print">Laporan</h1>

            <form method="GET" class="no-print mb-4">
                <div class="row g-2 align-items-end">
                    <div class="col-md-3">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="tgl_mulai" class="form-control" value="<?= htmlspecialchars($tgl_mulai) ?>">
                    </div>
                    <div class="col-md-3">
                        <label>Tanggal Akhir</label>
                        <input type="date" name="tgl_akhir" class="form-control" value="<?= htmlspecialchars($tgl_akhir) ?>">
                    </div>
                    <div class="col-md-3">
                        <label>Status Pembayaran</label>
                        <select name="status" class="form-control">
                            <option value="">-- Semua --</option>
                            <option value="sudah bayar" <?= $status == 'sudah bayar' ? 'selected' : '' ?>>Sudah Bayar</option>
                            <option value="belum bayar" <?= $status == 'belum bayar' ? 'selected' : '' ?>>Belum Bayar</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter"></i> Filter</button>
                        <button type="button" onclick="window.print()" class="btn btn-secondary w-100 ml-2">
                            <i class="fas fa-print"></i> Cetak Laporan
                        </button>
                    </div>
                </div>
            </form>

            <div class="card shadow print-area">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Laporan Pengiriman</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Pengirim</th>
                                    <th>Penerima</th>
                                    <th>Tarif</th>
                                    <th>Kurir Jemput</th>
                                    <th>Kurir Antar</th>
                                    <th>Status</th>
                                    <th class="no-print">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (count($data)): ?>
                                <?php foreach ($data as $d): ?>
                                <tr>
                                    <td><?= htmlspecialchars($d['nama_pengirim']) ?></td>
                                    <td><?= htmlspecialchars($d['nama_penerima']) ?></td>
                                    <td>Rp <?= number_format($d['tarif'], 0, ',', '.') ?></td>
                                    <td><?= htmlspecialchars($d['kurir_jemput'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($d['kurir_antar'] ?? '-') ?></td>
                                    <td>
                                        <span class="badge badge-<?= $d['status_pembayaran'] === 'sudah bayar' ? 'success' : 'warning' ?>">
                                            <?= ucfirst($d['status_pembayaran']) ?>
                                        </span>
                                    </td>
                                    <td class="no-print">
                                        <a href="detail_order.php?id=<?= $d['id_pengiriman'] ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="7" class="text-center">Tidak ada data ditemukan.</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end mt-3">
                            <strong class="mr-2">Total Tarif:</strong>
                            <div style="border: 1px solid #ccc; padding: 6px 12px; min-width: 180px; text-align: right;">
                                Rp <?= number_format($total_tarif, 0, ',', '.') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php'; ?>
</div>
</div>

<!-- JS -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
</body>
</html>
