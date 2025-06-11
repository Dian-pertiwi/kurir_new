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
                    <h1 class="h3 mb-4 text-gray-800 no-print">Laporan Pengiriman Paket</h1>

                    <!-- Filter Bulan dan Tahun -->
                    <form method="GET" action="" class="no-print">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <select name="bulan" class="form-control">
                                    <option value="">Pilih Bulan</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <!-- dan seterusnya -->
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="tahun" class="form-control">
                                    <option value="">Pilih Tahun</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter"></i> Tampilkan
                                </button>
                                <button onclick="window.print()" type="button" class="btn btn-success">
                                    <i class="fas fa-print"></i> Cetak
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Area Cetak -->
                    <div class="card shadow print-area">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Laporan Pengiriman Bulan Ini</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID Order</th>
                                            <th>Pengirim</th>
                                            <th>Penerima</th>
                                            <th>Tanggal Dikirim</th>
                                            <th>Status</th>
                                            <th>Bank BCA</th>
                                            <th>Bank BRI</th>
                                            <th>Bank Mandiri</th>
                                            <th>Lainnya</th>
                                            <th class="no-print">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <!-- Dummy Data -->
                                        <tr>
                                            <td>PKT001</td>
                                            <td>Andi Setiawan</td>
                                            <td>Budi Hartono</td>
                                            <td>01 Mei 2025</td>
                                            <td><span class="badge badge-success">Berhasil Dibayar</span></td>
                                            <td>Rp 50.000</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>
                                                <a href="pembayaran.php?id=PKT001" class="btn btn-info btn-sm no-print">
                                                    <i class="fas fa-eye"></i> Lihat Detail Pembayaran
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PKT002</td>
                                            <td>Siti Nurhaliza</td>
                                            <td>Rahmat Fadilah</td>
                                            <td>02 Mei 2025</td>
                                            <td><span class="badge badge-success">Berhasil Dibayar</span></td>
                                            <td>-</td>
                                            <td>Rp 40.000</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>
                                                <a href="pembayaran.php?id=PKT002" class="btn btn-info btn-sm no-print">
                                                    <i class="fas fa-eye"></i> Lihat Detail Pembayaran
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PKT003</td>
                                            <td>Deni Setyo</td>
                                            <td>Wahyu Saputra</td>
                                            <td>03 Mei 2025</td>
                                            <td><span class="badge badge-success">Berhasil Dibayar</span></td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>Rp 70.000</td>
                                            <td>-</td>
                                            <td>
                                                <a href="pembayaran.php?id=PKT003" class="btn btn-info btn-sm no-print">
                                                    <i class="fas fa-eye"></i> Lihat Detail Pembayaran
                                                </a>
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

    <!-- Script -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>