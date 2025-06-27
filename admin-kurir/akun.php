<?php
session_start();
include 'config/koneksi.php';

// Cek login
if (!isset($_SESSION['id_user']) || !isset($_SESSION['level'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['level'];
$nama = $_SESSION['nama'];

// Ambil data berdasarkan role
if ($role === 'admin') {
    $result = mysqli_query($conn, "SELECT * FROM tbl_user ORDER BY id_user ASC");
} elseif ($role === 'kurir') {
    $result = mysqli_query($conn, "SELECT * FROM tbl_user WHERE role = 'kurir' ORDER BY id_user ASC");
} else {
    echo "<script>alert('Akses ditolak! Halaman ini hanya untuk admin & kurir.'); window.location.href = 'dashboard.php';</script>";
    exit;
}

// Simpan semua user ke array agar bisa digunakan 2x
$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
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
        <h1 class="h3 mb-4 text-gray-800">Daftar Akun Pengguna</h1>
        <p class="text-muted mb-3">Anda login sebagai: <strong><?= htmlspecialchars($nama) ?> (<?= htmlspecialchars($role) ?>)</strong></p>

        <div class="card shadow mb-4">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>Role</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                  <tr>
                    <td><?= $user['id_user'] ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['nama']) ?></td>
                    <td><span class="badge badge-info"><?= $user['role'] ?></span></td>
                  </tr>
                <?php endforeach; ?>
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

<!-- Script -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
</body>
</html>
