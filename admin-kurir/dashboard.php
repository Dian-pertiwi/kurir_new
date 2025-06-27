<?php include 'init.php'; ?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include 'sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <?php include 'navbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="export_laporan.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" target="_blank">
</i> Generate
                            Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Total Order Bulanan -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Pengiriman Hari ini
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= $total_pengiriman_hari_ini ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-truck-loading fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Order Selesai -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total pengiriman
                                            berhasil hari ini
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= $total_berhasil_hari_ini ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Paket pending
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
  <?= $presentase_pending ?>%
</div>
<div class="progress-bar bg-info" role="progressbar"
     style="width: <?= $presentase_pending ?>%" 
     aria-valuenow="<?= $presentase_pending ?>" aria-valuemin="0" aria-valuemax="100">
</div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shipping-fast fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Pengguna
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= $total_pengguna ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                

                    <!-- Content Row -->
                    <div class="row">
    <div class="col-lg-12 mb-2">
        <!-- Profil Perusahaan -->
        <div class="card shadow mb-2">
            <div class="card-header py-3 bg-dark text-white">
                <h5 class="m-0 font-weight-bold">Profil Perusahaan</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>Becat Kurir</strong> adalah perusahaan jasa pengiriman yang berbasis di Nusa Tenggara Barat dengan komitmen menghadirkan layanan logistik yang efisien, terpercaya, dan terjangkau bagi masyarakat dan pelaku usaha lokal. Kami berfokus pada pelayanan pelanggan yang cepat, tepat waktu, serta menjangkau hingga ke pelosok wilayah.
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-12 mb-2">
        <!-- Visi -->
        <div class="card shadow mb-2">
            <div class="card-header py-3 bg-primary text-white">
                <h5 class="m-0 font-weight-bold">Visi</h5>
            </div>
            <div class="card-body">
                <p class="mb-0">
                    Menjadi perusahaan jasa pengiriman terdepan di Nusa Tenggara Barat yang memberikan layanan logistik yang cepat, aman, dan terpercaya dengan mengedepankan integritas, inovasi, serta kepuasan pelanggan.
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-12 mb-2">
        <!-- Misi -->
        <div class="card shadow mb-2">
            <div class="card-header py-3 bg-success text-white">
                <h5 class="m-0 font-weight-bold">Misi</h5>
            </div>
            <div class="card-body">
                <ol>
                    <li>Memberikan layanan pengiriman yang cepat, aman, dan tepat waktu melalui sistem logistik yang efisien dan terintegrasi.</li>
                    <li>Membangun kepercayaan pelanggan dengan pelayanan yang ramah, profesional, dan bertanggung jawab.</li>
                    <li>Menjangkau seluruh wilayah Nusa Tenggara Barat, termasuk daerah pelosok, sebagai bentuk komitmen terhadap kemudahan akses logistik untuk semua kalangan.</li>
                    <li>Mendukung pertumbuhan UMKM dan sektor ekonomi lokal dengan menyediakan solusi pengiriman yang terjangkau dan terpercaya.</li>
                    <li>Mengembangkan teknologi dan inovasi berkelanjutan untuk meningkatkan kualitas layanan dan pengalaman pelanggan.</li>
                </ol>
            </div>
        </div>
    </div>
</div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Becat Kurir 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Keluar dari Sistem</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Tutup">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin keluar dari sistem?
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a class="btn btn-primary" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script src="vendor/chart.js/Data-dammy.js"></script>
</body>

</html>