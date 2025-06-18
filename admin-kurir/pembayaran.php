<?php

session_start();
include 'config/koneksi.php';

// Cek apakah sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

// Query data kurir
$query = mysqli_query($conn, "SELECT * FROM tbl_user WHERE role = 'kurir'");

$id_order = '';
$uploaded_file = 'img/bukti_tf_admin/default.jpg'; // default preview
$status_upload = 'Belum upload';

if (isset($_GET['id_order'])) {
    $id_order = $_GET['id_order'];
    $query = "SELECT bukti_tf_admin FROM tbl_pengiriman_paket WHERE id_pengiriman = '$id_order'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        if (!empty($row['bukti_tf_admin'])) {
            $uploaded_file = $row['bukti_tf_admin'];
            $status_upload = 'Sudah upload';
        }
    }
}

if (isset($_POST['uploadBukti'])) {
    $id_order = $_POST['id_order'];
    $target_dir = "img/bukti_tf_admin/";

    if (!empty($_FILES['bukti_tf_admin']['name'])) {
        $file_name = basename($_FILES["bukti_tf_admin"]["name"]);
        $file_name = preg_replace("/[^a-zA-Z0-9.]/", "_", $file_name); // Hindari karakter aneh
        $target_file = $target_dir . time() . '_' . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($file_type, $allowed_types)) {
            if (move_uploaded_file($_FILES["bukti_tf_admin"]["tmp_name"], $target_file)) {
                $sql = "UPDATE tbl_pengiriman_paket SET bukti_tf_admin = '$target_file' WHERE id_pengiriman = '$id_order'";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Bukti transfer berhasil diupload!'); window.location.href='".$_SERVER['PHP_SELF']."?id_order=$id_order';</script>";
                    exit;
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

<?php
$preview_status = 'Belum upload';
$uploaded_file = 'img/bukti_tf_admin/default.jpg';

$nama_penerima = '';
$alamat_penerima = '';
$hp_penerima = '';

if (isset($_GET['id_order'])) {
    $id_order = $_GET['id_order'];
    $query = "SELECT bukti_tf_admin, nama_penerima, alamat_penerima, hp_penerima 
              FROM tbl_pengiriman_paket WHERE id_pengiriman = '$id_order'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $nama_penerima = $row['nama_penerima'];
        $alamat_penerima = $row['alamat_penerima'];
        $hp_penerima = $row['hp_penerima'];

        if (!empty($row['bukti_tf_admin'])) {
            $uploaded_file = $row['bukti_tf_admin'];
            $preview_status = 'Sudah upload';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<?php include 'head.php'; ?>

<?php 
$preview_status = 'Belum upload';
$uploaded_file = 'img/bukti_tf_admin/default.jpg';
?>

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
                                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post"
                                        enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="id_order">Pilih ID Order</label>
                                            <select name="id_order" id="id_order" class="form-control"
                                                onchange="this.form.submit()">
                                                <option value="">-- Pilih --</option>
                                                <?php
                                                $query = "SELECT id_pengiriman, nama_penerima, alamat_penerima, hp_penerima FROM tbl_pengiriman_paket";
                                                $result = mysqli_query($conn, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $selected = ($row['id_pengiriman'] == $id_order) ? 'selected' : '';
                                                    echo '<option value="' . $row['id_pengiriman'] . '" ' . $selected . '
                                                        data-nama="' . htmlspecialchars($row['nama_penerima']) . '" 
                                                        data-alamat="' . htmlspecialchars($row['alamat_penerima']) . '" 
                                                        data-hp="' . htmlspecialchars($row['hp_penerima']) . '">
                                                        ORDER #' . $row['id_pengiriman'] . '
                                                    </option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="nama_penerima">Nama Penerima</label>
                                            <input type="text" class="form-control" id="nama_penerima" readonly
                                                value="<?= htmlspecialchars($nama_penerima) ?>">
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
                                                name="bukti_tf_admin" accept="image/*">
                                        </div>
                                        <button type="submit" name="uploadBukti" class="btn btn-success">Upload</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Preview -->
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-secondary">Preview Bukti Transfer</h6>
                                </div>
                                <div class="card-body text-center">
                                    <?php
                               

                                if (!empty($_POST['id_order'])) {
                                    $id_order = $_POST['id_order'];
                                    $query = "SELECT bukti_tf_admin FROM tbl_pengiriman_paket WHERE id_pengiriman = '$id_order'";
                                    $result = mysqli_query($conn, $query);
                                    if ($row = mysqli_fetch_assoc($result)) {
                                        if (!empty($row['bukti_tf_admin'])) {
                                            $preview_file = $row['bukti_tf_admin'];
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
                <?php include 'footer.php'; ?>
            </div>
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