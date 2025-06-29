<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
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

                    <!-- Filter -->
                    <form method="GET" action="" class="no-print mb-4">
  <div class="row g-2 align-items-end">

    <!-- Tanggal Mulai -->
    <div class="col-md-3">
      <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
      <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" value="<?= $_GET['tgl_mulai'] ?? '' ?>">
    </div>

    <!-- Tanggal Akhir -->
    <div class="col-md-3">
      <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
      <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" value="<?= $_GET['tgl_akhir'] ?? '' ?>">
    </div>

    <!-- Status Pembayaran -->
    <div class="col-md-3">
      <label for="status" class="form-label">Status Pengiriman</label>
      <select name="status" id="status" class="form-control">
        <option value="">-- Semua Status --</option>
        <option value="sudah bayar" <?= (isset($_GET['status']) && $_GET['status'] === 'sudah bayar') ? 'selected' : '' ?>>Sudah Bayar</option>
        <option value="belum bayar" <?= (isset($_GET['status']) && $_GET['status'] === 'belum bayar') ? 'selected' : '' ?>>Belum Bayar</option>
      </select>
    </div>

    <!-- Tombol -->
    <div class="col-md-3 d-flex gap-2">
      <button type="button" onclick="window.print()" class="btn btn-secondary w-100"><i class="fas fa-print"></i> Cetak Laporan</button>
    </div>
    
  </div>
</form>


                    <!-- Area Cetak -->
                    <div class="card shadow print-area">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Laporan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
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
                                        <!-- Dummy Data -->
                                        <tr>
                                            <td>Dian</td>
                                            <td>Andi Setiawan</td>
                                            <td>Rp 150.000</td>
                                            <td>hartono</td>
                                            <td>slamet</td>
                                            <td><span class="badge badge-success">Sudah Bayar</span></td>
                                            <td>
                                                <a href="pembayaran.php?id=PKT001" class="btn btn-info btn-sm no-print">
                                                    <i class="fas fa-eye"></i> Lihat Detail
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Tambahan data lainnya -->
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end align-items-center mt-3">
                                    <strong class="mr-2">Total Tarif /bln:</strong>
                                    <div style="border: 1px solid #ccc; padding: 6px 12px; min-width: 180px; text-align: right;">
                                        Rp 150.000
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

    <!-- Script -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
