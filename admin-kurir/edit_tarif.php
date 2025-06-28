<?php
include 'config/koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: data_tarif.php");
    exit;
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'config/koneksi.php';

// Cek login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id = (int)$_GET['id'];

// Ambil data tarif berdasarkan ID
$query = "SELECT * FROM tbl_tarif WHERE id_tarif = $id";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    echo "Data tidak ditemukan.";
    exit;
}
$data = mysqli_fetch_assoc($result);

// Ambil semua kabupaten untuk dropdown
$kabupaten_result = mysqli_query($conn, "SELECT * FROM tbl_kabupaten ORDER BY nama_kabupaten");

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kab_asal = (int) $_POST['id_kab_asal'];
    $id_kab_tujuan = (int) $_POST['id_kab_tujuan'];
    $tarif = (float) $_POST['tarif'];

    $update_query = "UPDATE tbl_tarif SET 
                        id_kab_asal = $id_kab_asal,
                        id_kab_tujuan = $id_kab_tujuan,
                        tarif = $tarif
                    WHERE id_tarif = $id";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='data_tarif.php';</script>";
        exit;
    } else {
        echo "Gagal update: " . mysqli_error($conn);
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
                    <h1 class="h3 mb-4 text-gray-800">Edit Tarif Ongkir</h1>

                    <form action="edit_tarif.php?id=<?= $id ?>" method="POST">
                        <input type="hidden" name="id_tarif" value="<?= $data['id_tarif']; ?>">

                        <div class="form-group">
                            <label>Kabupaten Asal</label>
                            <select name="id_kab_asal" class="form-control" required>
                                <option value="">-- Pilih Kabupaten Asal --</option>
                                <?php 
                                mysqli_data_seek($kabupaten_result, 0);
                                while ($kab = mysqli_fetch_assoc($kabupaten_result)) { ?>
                                <option value="<?= $kab['id_kab']; ?>"
                                    <?= $kab['id_kab'] == $data['id_kab_asal'] ? 'selected' : '' ?>>
                                    <?= $kab['nama_kabupaten']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kabupaten Tujuan</label>
                            <select name="id_kab_tujuan" class="form-control" required>
                                <option value="">-- Pilih Kabupaten Tujuan --</option>
                                <?php 
                                mysqli_data_seek($kabupaten_result, 0);
                                while ($kab = mysqli_fetch_assoc($kabupaten_result)) { ?>
                                <option value="<?= $kab['id_kab']; ?>"
                                    <?= $kab['id_kab'] == $data['id_kab_tujuan'] ? 'selected' : '' ?>>
                                    <?= $kab['nama_kabupaten']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tarif Ongkir (Rp)</label>
                            <input type="number" name="tarif" class="form-control" required
                                value="<?= $data['tarif']; ?>" min="0">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="data_tarif.php" class="btn btn-secondary">Batal</a>
                    </form>
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