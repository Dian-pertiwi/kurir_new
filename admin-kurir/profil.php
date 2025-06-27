<?php
session_start();
include 'config/koneksi.php';

// Cek login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$query = mysqli_query($conn, "SELECT * FROM tbl_user WHERE id_user = '$id_user'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Profil Saya</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>
    <!-- End Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include 'navbar.php'; ?>
        <!-- End Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Profil Saya</h1>

          <!-- Profile Card -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <?php if ($data): ?>
              <div class="row">
                <div class="col-md-4 text-center">
                  <img src="img/undraw_profile.svg" class="img-fluid rounded-circle mb-3" width="150" alt="Profile">
                </div>
                <div class="col-md-8">
                  <table class="table table-bordered">
                    <tr>
                      <th>Nama Lengkap</th>
                      <td><?= htmlspecialchars($data['nama']) ?></td>
                    </tr>
                    <tr>
                      <th>Username</th>
                      <td><?= htmlspecialchars($data['username']) ?></td>
                    </tr>
                    <tr>
                      <th>Role</th>
                      <td><?= htmlspecialchars($data['role']) ?></td>
                    </tr>
                  </table>
                  <a href="dashboard.php" class="btn btn-secondary btn-sm">Kembali</a>
                </div>
              </div>
              <?php else: ?>
              <div class="alert alert-danger">Data user tidak ditemukan.</div>
              <?php endif; ?>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include 'footer.php'; ?>
      <!-- End of Footer -->

    </div>
    <!-- End Content Wrapper -->

  </div>
  <!-- End Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- JS -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
