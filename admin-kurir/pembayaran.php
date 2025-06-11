<?php
include 'config/koneksi.php';
$uploaded_file = $target_dir = "img/bukti_tf_admin/";
$status_upload = 'Belum upload';

if (isset($_POST['id_order'])) {
    $id_order = $_POST['id_order'];

    // Ambil path file dari DB
    $query = "SELECT bukti_transfer_admin FROM tbl_pengiriman WHERE id_pengiriman = '$id_order'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        if (!empty($row['bukti_transfer_admin'])) {
            $uploaded_file = $row['bukti_transfer_admin'];
            $status_upload = 'Sudah upload';
        }
    }
}

if (isset($_POST['uploadBukti'])) {
    $id_order = $_POST['id_order'];
    $target_dir = "img/bukti_tf_admin/";

    // Cek apakah file diupload
    if (!empty($_FILES['bukti_transfer_admin']['name'])) {
        $file_name = basename($_FILES["bukti_transfer_admin"]["name"]);
        $target_file = $target_dir . time() . '_' . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi file
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($file_type, $allowed_types)) {
            if (move_uploaded_file($_FILES["bukti_transfer_admin"]["tmp_name"], $target_file)) {
                // Simpan ke DB
                $sql = "UPDATE tbl_pengiriman SET bukti_transfer_admin = '$target_file' WHERE id_pengiriman = '$id_order'";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Bukti transfer berhasil diupload!'); window.location.href='pembayaran.php';</script>";
                } else {
                    echo "<script>alert('Gagal menyimpan ke database.');</script>";
                }
            } else {
                echo "<script>alert('Gagal mengupload file ke server.');</script>";
            }
        } else {
            echo "<script>alert('Format file tidak didukung. Gunakan JPG, PNG, atau GIF.');</script>";
        }
    } else {
        echo "<script>alert('Pilih file terlebih dahulu.');</script>";
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
                    <h1 class="h3 mb-4 text-gray-800">Upload Bukti Transfer COD</h1>

                    <div class="row">
                        <!-- Form Upload -->
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Form Upload Bukti Transfer</h6>
                                </div>
                                <div class="card-body">
                                    <form action="#" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="id_order">Pilih ID Order</label>

                                            <select name="id_order" id="id_order" class="form-control"
                                                onchange="isiDataPenerima()">
                                                <option value="">-- Pilih --</option>
                                                <?php
$query = "SELECT id_pengiriman, id_penerima FROM tbl_pengiriman";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $id_penerima = $row['id_penerima'];

    // Ambil nama penerima dari tabel tbl_penerima
    $query_penerima = "SELECT nama_penerima, alamat_penerima, hp_penerima FROM tbl_penerima WHERE id_penerima = '$id_penerima'";
    $result_penerima = mysqli_query($conn, $query_penerima);
    if ($row_penerima = mysqli_fetch_assoc($result_penerima)) {
        echo '<option value="' . $row['id_pengiriman'] . '" 
            data-nama="' . htmlspecialchars($row_penerima['nama_penerima']) . '" 
            data-alamat="' . htmlspecialchars($row_penerima['alamat_penerima']) . '" 
            data-hp="' . htmlspecialchars($row_penerima['hp_penerima']) . '">
            ORDER #' . $row['id_pengiriman'] . '
        </option>';
    }
}
?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="nama_penerima">Nama Penerima</label>
                                            <input type="text" class="form-control" id="nama_penerima" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat Penerima</label>
                                            <input type="text" class="form-control" id="alamat" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="hp">Nomor HP Penerima</label>
                                            <input type="text" class="form-control" id="hp" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="bukti_transfer">Bukti Transfer</label>
                                            <input type="file" class="form-control-file" id="bukti_transfer"
                                                name="bukti_transfer_admin" accept="image/*">
                                        </div>
                                        <button type="submit" name="uploadBukti" class="btn btn-success">Upload</button>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Preview Bukti Dummy -->
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-secondary">Preview Bukti Transfer</h6>
                                </div>
                                <div class="card-body text-center">
                                    <?php
$preview_file = 'img/bukti_tf_admin/';
$preview_status = 'Belum upload';

if (!empty($_POST['id_order'])) {
    $id_order = $_POST['id_order'];
    $query = "SELECT bukti_transfer_admin FROM tbl_pengiriman WHERE id_pengiriman = '$id_order'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        if (!empty($row['bukti_transfer_admin'])) {
            $preview_file = $row['bukti_transfer_admin'];
            $preview_status = 'Sudah upload';
        }
    }
}
?>

                                    <img src="<?= $preview_file ?>" class="img-fluid rounded" style="max-height: 300px;"
                                        alt="Bukti Transfer">
                                    <p class="mt-2 mb-0"><strong>Status:</strong> <?= $preview_status ?></p>

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

    <script>
    function isiDataPenerima() {
        const selected = document.getElementById("id_order").selectedOptions[0];
        const nama = selected.getAttribute("data-nama");
        const alamat = selected.getAttribute("data-alamat");
        const hp = selected.getAttribute("data-hp");

        document.getElementById("nama_penerima").value = nama || '';
        document.getElementById("alamat").value = alamat || '';
        document.getElementById("hp").value = hp || '';
    }
    </script>
</body>

</html>