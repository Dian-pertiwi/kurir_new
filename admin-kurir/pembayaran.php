<?php
session_start();
include 'config/koneksi.php';

// Cek login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

// Jika ada parameter id dan method GET, lakukan penghapusan
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Hapus data dari tbl_pengiriman_paket
    $hapus = mysqli_query($conn, "DELETE FROM tbl_pengiriman_paket WHERE id_pengiriman = $id");

    if ($hapus) {
        $_SESSION['pesan'] = "Data berhasil dihapus.";
    } else {
        $_SESSION['pesan'] = "Gagal menghapus data.";
    }

    header("Location: pembayaran.php");
    exit;
}

// Proses upload file
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_modal'])) {
    $id = (int)$_POST['id_pengiriman'];
    $file = $_FILES['file_upload'];
    $nama_file = time() . '_' . basename($file['name']);
    $tmp = $file['tmp_name'];
    $tujuan = "uploads/" . $nama_file;

    if (move_uploaded_file($tmp, $tujuan)) {
        $sql = "UPDATE tbl_pengiriman_paket 
                SET bukti_tf_admin = '$nama_file', status_pembayaran = 'sudah bayar' 
                WHERE id_pengiriman = $id";
        $conn->query($sql);
        $_SESSION['pesan'] = "Upload dan update status pembayaran berhasil!";
    } else {
        $_SESSION['pesan'] = "Upload gagal. Coba lagi.";
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
                                                ka.nama_kurir AS kurir_antar,
                                                pp.status_pembayaran
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
                                            <td><?= htmlspecialchars($row['status_pembayaran'] ?? '-') ?></td>
                                            <td style="width: auto;">
                                                <div style="display: flex; gap: 8px; align-items: center;">
                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#uploadModal<?= $id ?>">
                                                    Upload Bukti
                                                </button>

                                                    <a href="pembayaran.php?id=<?= $id ?>" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin hapus?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                        <?php
mysqli_data_seek($query, 0); // reset pointer
while ($row = $query->fetch_assoc()):
    $id = $row['id_pengiriman'];
?>
<div class="modal fade" id="uploadModal<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel<?= $id ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form method="POST" action="" enctype="multipart/form-data">
      <input type="hidden" name="id_pengiriman" value="<?= $id ?>">
      <input type="hidden" name="upload_modal" value="1">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="uploadModalLabel<?= $id ?>">Upload Bukti Pembayaran</h5>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body text-center">
          <div class="form-group">
            <label for="fileUpload<?= $id ?>" class="font-weight-bold mb-2">Pilih gambar bukti transfer:</label>
            <input type="file" name="file_upload" id="fileUpload<?= $id ?>" class="form-control-file" accept="image/*" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Upload</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
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