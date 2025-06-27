<?php
session_start();
include 'config/koneksi.php';

// Cek login dan hanya admin
if (!isset($_SESSION['id_user']) || $_SESSION['level'] !== 'admin') {
    echo "<script>alert('Hanya admin yang bisa mengakses halaman ini'); window.location.href = 'dashboard.php';</script>";
    exit;
}

// Pagination
$limit = 4;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Hitung total log
$total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_log_aktivitas");
$total_data = mysqli_fetch_assoc($total_result)['total'];
$total_pages = ceil($total_data / $limit);

// Ambil data log (dengan JOIN user)
$query = mysqli_query($conn, "
    SELECT l.*, u.nama, u.role
    FROM tbl_log_aktivitas l
    JOIN tbl_user u ON u.id_user = l.id_user
    ORDER BY l.waktu DESC
    LIMIT $limit OFFSET $offset
");

$logs = [];
while ($row = mysqli_fetch_assoc($query)) {
    $logs[] = $row;
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
        <h1 class="h3 mb-4 text-gray-800">Riwayat Aktivitas Pengguna</h1>

        <div class="card shadow mb-4">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                  <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Role</th>
                    <th>Aktivitas</th>
                    <th>Waktu</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (count($logs) > 0): ?>
                    <?php $no = $offset + 1; foreach ($logs as $log): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($log['nama'] ?? '-') ?></td>
                        <td><span class="badge badge-info"><?= htmlspecialchars($log['role'] ?? '-') ?></span></td>
                        <td><?= htmlspecialchars($log['aktivitas'] ?? '-') ?></td>
                        <td><?= isset($log['waktu']) ? date('d-m-Y H:i:s', strtotime($log['waktu'])) : '-' ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr><td colspan="5" class="text-center text-muted">Belum ada aktivitas yang tercatat.</td></tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <nav>
              <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                  <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>">&laquo; Prev</a></li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                  <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                  </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                  <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>">Next &raquo;</a></li>
                <?php endif; ?>
              </ul>
            </nav>
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
</body>
</html>
