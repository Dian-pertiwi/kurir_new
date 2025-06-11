<?php
// Include connection to the database
include 'config/koneksi.php';

// Cek apakah id_order ada di parameter URL
if (isset($_GET['id'])) {
    $id_order = $_GET['id'];

    // Ambil data order berdasarkan ID
    $sql = "SELECT * FROM tbl_order_masuk WHERE id_order_masuk = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_order);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();
    
    // Ambil status yang ada di tabel tbl_status_order untuk pilihan
    $status_query = "SELECT * FROM tbl_status_order";
    $status_result = $conn->query($status_query);

    // Ambil data kurir dari tabel tbl_data_kurir
    $kurir_query = "SELECT * FROM tbl_data_kurir";
    $kurir_result = $conn->query($kurir_query);
    
    // Menyimpan hasil kurir ke dalam array
    $kurir_data = [];
    while ($kurir = $kurir_result->fetch_assoc()) {
        $kurir_data[] = $kurir; // Menyimpan data kurir ke dalam array
    }
}

// Proses update status setelah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $new_status = $_POST['status'];
    $kurir_jemput = $_POST['kurir_jemput'];
    $kurir_antar = $_POST['kurir_antar'];
    $resi = $_POST['resi'];

    // Update status order
    $update_sql = "UPDATE tbl_order_masuk SET kurir_jemput = ?, kurir_antar = ?, resi = ?, status_order = ? WHERE id_order_masuk = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssi", $kurir_jemput, $kurir_antar, $resi, $new_status, $id_order);
    $update_stmt->execute();

    // Redirect ke halaman daftar penugasan setelah update
    header("Location: daftar_penugasan.php");
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
                    <h1 class="h3 mb-4 text-gray-800">Edit Status Order</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Status untuk Order
                                PKT<?= str_pad($id_order, 3, '0', STR_PAD_LEFT) ?></h6>
                        </div>
                        <div class="card-body">
                            <form action="edit_status.php?id=<?= $id_order ?>" method="POST">
                                <div class="form-group">
                                    <label for="kurir_jemput">Kurir Jemput</label>
                                    <select class="form-control" id="kurir_jemput" name="kurir_jemput" required>
                                        <option value="">Pilih Kurir Jemput</option>
                                        <?php foreach ($kurir_data as $kurir): ?>
                                        <option value="<?= $kurir['nama_kurir'] ?>"
                                            <?= ($kurir['nama_kurir'] == $order['kurir_jemput']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($kurir['nama_kurir']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kurir_antar">Kurir Antar</label>
                                    <select class="form-control" id="kurir_antar" name="kurir_antar" required>
                                        <option value="">Pilih Kurir Antar</option>
                                        <?php foreach ($kurir_data as $kurir): ?>
                                        <option value="<?= $kurir['nama_kurir'] ?>"
                                            <?= ($kurir['nama_kurir'] == $order['kurir_antar']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($kurir['nama_kurir']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="resi">Resi</label>
                                    <input type="text" class="form-control" id="resi" name="resi"
                                        value="<?= htmlspecialchars($order['resi']) ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="status">Pilih Status:</label>
                                    <select class="form-control" name="status" id="status">
                                        <?php while ($status = $status_result->fetch_assoc()): ?>
                                        <option value="<?= $status['nama_status'] ?>"
                                            <?= ($status['nama_status'] == $order['status_order']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($status['nama_status']) ?>
                                        </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                <a href="daftar_penugasan.php" class="btn btn-secondary">Kembali</a>
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
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>