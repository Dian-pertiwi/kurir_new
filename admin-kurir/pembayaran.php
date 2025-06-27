<?php
session_start();
include 'config/koneksi.php';

// Cek login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

// Proses upload file
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_pengiriman']) && isset($_FILES['file_upload'])) {
    $id = $_POST['id_pengiriman'];
    $file = $_FILES['file_upload'];
    $nama_file = time() . '_' . basename($file['name']); // nama unik
    $tmp = $file['tmp_name'];
    $tujuan = "uploads/" . $nama_file;

    if (move_uploaded_file($tmp, $tujuan)) {
        // Simpan ke database (misalnya kolom bukti_transfer)
        $conn->query("UPDATE tbl_pengiriman_paket SET bukti_tf_admin = '$nama_file' WHERE id_pengiriman = $id");
        $_SESSION['pesan'] = "Upload berhasil!";
    } else {
        $_SESSION['pesan'] = "Upload gagal!";
    }

    header("Location: pembayaran.php");
    exit;
}
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
                    <h1 class="h3 mb-4 text-gray-800">Data Pembayaran</h1>

                    <?php if (isset($_SESSION['pesan'])): ?>
                    <div class="alert alert-info"><?= $_SESSION['pesan']; unset($_SESSION['pesan']); ?></div>
                    <?php endif; ?>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pembayaran</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Pengirim</th>
                                            <th>Penerima</th>
                                            <th>Resi</th>
                                            <th>Kurir Jemput</th>
                                            <th>Kurir Antar</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "
                                            SELECT 
                                                pp.id_pengiriman,
                                                peng.nama_pengirim,
                                                pener.nama_penerima,
                                                kj.nama_kurir AS kurir_jemput,
                                                ka.nama_kurir AS kurir_antar
                                            FROM tbl_pengiriman_paket pp
                                            LEFT JOIN tbl_pengirim peng ON pp.id_pengirim = peng.id_pengirim
                                            LEFT JOIN tbl_penerima pener ON pp.id_penerima = pener.id_penerima
                                            LEFT JOIN tbl_data_kurir kj ON pp.id_kurir_jemput = kj.id_kurir
                                            LEFT JOIN tbl_data_kurir ka ON pp.id_kurir_antar = ka.id_kurir
                                            ORDER BY pp.id_pengiriman DESC
                                        ";
                                        $query = $conn->query($sql);

                                        while ($row = $query->fetch_assoc()):
                                            $id = $row['id_pengiriman'];
                                        ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['nama_pengirim']) ?></td>
                                            <td><?= htmlspecialchars($row['nama_penerima']) ?></td>
                                            <td>ORD<?= str_pad($id, 3, '0', STR_PAD_LEFT) ?></td>
                                            <td><?= htmlspecialchars($row['kurir_jemput']) ?></td>
                                            <td><?= htmlspecialchars($row['kurir_antar'] ?? '-') ?></td>
                                            <td>Belum Bayar</td>
                                            <td style="width: auto;">
                                                <div style="display: flex; gap: 8px; align-items: center;">
                                                    <form action="" method="POST" enctype="multipart/form-data"
                                                        style="margin: 0;">
                                                        <!-- hidden ID -->
                                                        <input type="hidden" name="id_pengiriman" value="<?= $id ?>">
                                                        <!-- Label upload -->
                                                        <label for="file-upload-<?= $id ?>"
                                                            class="btn btn-primary btn-sm" style="margin: 0;">
                                                            Upload File
                                                        </label>
                                                        <input type="file" id="file-upload-<?= $id ?>"
                                                            name="file_upload" style="display: none;"
                                                            onchange="this.form.submit()">
                                                    </form>

                                                    <a href="pembayaran.php?id=<?= $id ?>" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin hapus?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
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

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
    </script>
</body>

</html>