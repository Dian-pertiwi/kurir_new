<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$error = null;
$success = null;

// Ambil data user dari database
$query = mysqli_query($conn, "SELECT * FROM tbl_user WHERE id_user = $id_user");
$data = mysqli_fetch_assoc($query);

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama'] ?? '');
    $password_baru = $_POST['password'] ?? '';

    if (empty($nama)) {
        $error = "Nama tidak boleh kosong.";
    } else {
        // Jika password diisi, validasi dan update
        if (!empty($password_baru)) {
            if (strlen($password_baru) < 5) {
                $error = "Password minimal 5 karakter.";
            } else {
                $password_md5 = md5($password_baru);
                $update = mysqli_query($conn, "UPDATE tbl_user SET nama = '$nama', password = '$password_md5' WHERE id_user = $id_user");
            }
        } else {
            // Hanya update nama
            $update = mysqli_query($conn, "UPDATE tbl_user SET nama = '$nama' WHERE id_user = $id_user");
        }

        if (isset($update) && $update) {
            $_SESSION['nama'] = $nama;
            $success = "Pengaturan berhasil disimpan.";

            // Log aktivitas
            mysqli_query($conn, "INSERT INTO tbl_log_aktivitas (id_user, aktivitas) VALUES ($id_user, 'Mengubah pengaturan akun')");
        } elseif (!isset($error)) {
            $error = "Gagal menyimpan perubahan.";
        }
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
        <h1 class="h3 mb-4 text-gray-800">Pengaturan Akun</h1>

        <?php if ($error): ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php elseif ($success): ?>
          <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="post">
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($data['username']) ?>" readonly>
          </div>

          <div class="form-group">
            <label>Role</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($data['role']) ?>" readonly>
          </div>

          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required>
          </div>

          <div class="form-group">
            <label>Password Baru (kosongkan jika tidak ingin ganti)</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••">
          </div>

          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
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
</body>
</html>
