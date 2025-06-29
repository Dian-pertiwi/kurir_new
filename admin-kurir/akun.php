<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['id_user']) || !isset($_SESSION['level'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['level'];
$nama = $_SESSION['nama'];

// Search filter
$search = trim($_GET['search'] ?? '');

// Query ambil data user
$sql = "SELECT * FROM tbl_user";
if ($search) {
    $search_safe = mysqli_real_escape_string($conn, $search);
    $sql .= " WHERE nama LIKE '%$search_safe%' OR username LIKE '%$search_safe%' OR role LIKE '%$search_safe%'";
}
$sql .= " ORDER BY id_user ASC";

$result = mysqli_query($conn, $sql);

// Ambil hasil ke array
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
    <?php if (isset($_SESSION['pesan'])): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= $_SESSION['pesan']; unset($_SESSION['pesan']); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif; ?>

      <h1 class="h3 mb-4 text-gray-800">Manajemen Akun Pengguna</h1>
      <p class="text-muted mb-3">Login sebagai: <strong><?= htmlspecialchars($nama) ?> (<?= htmlspecialchars($role) ?>)</strong></p>

      <!-- Search -->
      <div class="form-inline mb-3">
  <input type="text" id="searchInput" class="form-control mr-7" placeholder="Cari nama, username, role...">
  <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#modalTambah">
    <i class="fas fa-plus"></i> Tambah
  </button>
</div>


      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead class="thead-dark">
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Role</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody id="dataUser">
              <?php foreach ($users as $user): ?>
              <tr>
                <td><?= $user['id_user'] ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['nama']) ?></td>
                <td><span class="badge badge-info"><?= $user['role'] ?></span></td>
                <td>
                  <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit<?= $user['id_user'] ?>"><i class="fas fa-edit"></i></button>
                  <a href="proses_akun.php?hapus=<?= $user['id_user'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus akun ini?')"><i class="fas fa-trash"></i></a>
                </td>
              </tr>

              <!-- Modal Edit -->
              <div class="modal fade" id="modalEdit<?= $user['id_user'] ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <form action="proses_akun.php" method="POST">
                    <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                    <div class="modal-content">
                      <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title">Edit Akun #<?= $user['id_user'] ?></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label>Nama</label>
                          <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($user['nama']) ?>" required>
                        </div>
                        <div class="form-group">
                          <label>Username</label>
                          <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
                        </div>
                        <div class="form-group">
                          <label>Role</label>
                          <select name="role" class="form-control" required>
                            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="kurir" <?= $user['role'] === 'kurir' ? 'selected' : '' ?>>Kurir</option>
                            <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <?php include 'footer.php'; ?>
  </div>
</div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form action="proses_akun.php" method="POST">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Tambah Akun Baru</h5>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control" required>
              <option value="user">User</option>
              <option value="kurir">Kurir</option>
              <option value="admin">Admin</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="tambah" class="btn btn-success">Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
document.getElementById("searchInput").addEventListener("keyup", function () {
  const filter = this.value.toLowerCase();
  const rows = document.querySelectorAll("#dataUser tr");

  rows.forEach(row => {
    const rowText = row.textContent.toLowerCase();
    row.style.display = rowText.includes(filter) ? "" : "none";
  });
});
</script>


<!-- JS -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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
