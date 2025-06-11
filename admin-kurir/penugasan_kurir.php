<!-- <?php
include 'config/koneksi.php';

if (isset($_POST['simpan'])) {
    $id_order = $_POST['id_order'];
    $id_kurir_jemput = $_POST['id_kurir_jemput'];
    $id_kurir_antar = $_POST['id_kurir_antar'];
    $catatan = mysqli_real_escape_string($conn, $_POST['catatan']);

    // Simpan ke tabel penugasan
    $query = mysqli_query($conn, "INSERT INTO tbl_penugasan_kurir (id_order, id_kurir_jemput, id_kurir_antar, catatan)
                                  VALUES ('$id_order', '$id_kurir_jemput', '$id_kurir_antar', '$catatan')");

    // Update status order (optional)
    if ($query) {
        mysqli_query($conn, "UPDATE tbl_orderan SET status='Sedang Diproses' WHERE id_order='$id_order'");
        echo "<script>alert('Penugasan berhasil disimpan!'); window.location='data_pengiriman.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan penugasan!'); window.history.back();</script>";
    }
}
?>

<?php
// Ambil data order dari parameter GET (misalnya dari halaman sebelumnya)
$id_order = isset($_GET['id']) ? $_GET['id'] : '';
?>




<!DOCTYPE html>
<html lang="id">

<?php include 'head.php'; ?>

<body id="page-top">
    Page Wrapper -->
<div id="wrapper">

    <?php include 'sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?php include 'navbar.php'; ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Penugasan Kurir</h1>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tugas Pengambilan & Pengantaran Paket</h6>
                    </div>
                    <div class="card-body">
                        <form action="proses_penugasan.php" method="POST">
                            <div class="form-group">
                                <label for="id_order">Pilih ID Order</label>
                                <select name="id_order" id="id_order" class="form-control" required>
                                    <option value="">-- Pilih Order --</option>
                                    <?php
      include 'config/koneksi.php';
        $query_order = mysqli_query($conn, "SELECT id_order FROM tbl_orderan WHERE status = 'Belum Diproses'");
        while ($row = mysqli_fetch_assoc($query_order)) {
            echo "<option value='".$row['id_order']."'>".$row['id_order']."</option>";
        }
        ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kurir_ambil">Pilih Kurir Penjemput</label>
                                <select name="id_kurir_jemput" class="form-control" required>
                                    <option value="">-- Pilih Kurir --</option>
                                    <?php
        $kurir_jemput = mysqli_query($conn, "SELECT * FROM tbl_data_kurir");
        while ($row = mysqli_fetch_assoc($kurir_jemput)) {
            echo "<option value='".$row['id_kurir']."'>".$row['nama_kurir']."</option>";
        }
        ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kurir_antar">Pilih Kurir Pengantar</label>
                                <select name="id_kurir_antar" class="form-control" required>
                                    <option value="">-- Pilih Kurir --</option>
                                    <?php
        $kurir_antar = mysqli_query($conn, "SELECT * FROM tbl_data_kurir");
        while ($row = mysqli_fetch_assoc($kurir_antar)) {
            echo "<option value='".$row['id_kurir']."'>".$row['nama_kurir']."</option>";
        }
        ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="catatan">Catatan (Opsional)</label>
                                <textarea class="form-control" name="catatan" id="catatan" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Penugasan
                            </button>
                            <a href="orderan_masuk.php" class="btn btn-secondary ml-2">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <?php include 'footer.php'; ?>

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scripts -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
</body>

</html>