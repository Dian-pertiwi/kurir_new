<?php
include 'config/koneksi.php';

// Cek jika tidak ada ID di URL
if (!isset($_GET['id'])) {
    header("Location: data_kurir.php");
    exit;
}

$id_kurir = $_GET['id'];

// Ambil data kurir berdasarkan ID
$query = "SELECT * FROM tbl_data_kurir WHERE id_kurir = '$id_kurir'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Redirect jika data tidak ditemukan
if (!$data) {
    header("Location: data_kurir.php?notfound=1");
    exit;
}

// Proses jika form disubmit
if (isset($_POST['updateKurir'])) {
    $nama_kurir = $_POST['nama_kurir'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];

    $update = "UPDATE tbl_data_kurir SET 
                nama_kurir = '$nama_kurir',
                no_hp = '$no_hp',
                alamat = '$alamat',
                status = '$status'
               WHERE id_kurir = '$id_kurir'";

    if (mysqli_query($conn, $update)) {
        header("Location: data_kurir.php?update=1");
        exit;
    } else {
        $error = "Gagal memperbarui data.";
    }
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
                    <h1 class="h3 mb-4 text-gray-800">Edit Data Kurir</h1>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                            <?php endif; ?>
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label>ID Kurir</label>
                                    <input type="text" name="id_kurir" class="form-control"
                                        value="<?= $data['id_kurir']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama Kurir</label>
                                    <input type="text" name="nama_kurir" class="form-control"
                                        value="<?= $data['nama_kurir']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" name="no_hp" class="form-control" value="<?= $data['no_hp']; ?>"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control"
                                        required><?= $data['alamat']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="Aktif" <?= $data['status'] == 'Aktif' ? 'selected' : ''; ?>>Aktif
                                        </option>
                                        <option value="Nonaktif"
                                            <?= $data['status'] == 'Nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
                                    </select>
                                </div>
                                <button type="submit" name="updateKurir" class="btn btn-success">Simpan
                                    Perubahan</button>
                                <a href="data_kurir.php" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <?php include 'footer.php'; ?>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>