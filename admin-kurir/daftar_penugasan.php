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
                    <h1 class="h3 mb-4 text-gray-800">Daftar Penugasan Kurir</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Paket yang Ditugaskan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Order</th>
                                            <th>Kurir Jemput</th>
                                            <th>Kurir Antar</th>
                                            <th>Resi</th>
                                            <th>Status</th>
                                            <th>Update Terakhir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "
                                            SELECT 
                                                p.id_pengiriman, 
                                                k1.nama_kurir AS kurir_jemput, 
                                                k2.nama_kurir AS kurir_antar,
                                                p.resi,
                                                s.nama_status,
                                                p.waktu_konfirmasi
                                            FROM tbl_pengiriman_paket p
                                            LEFT JOIN tbl_data_kurir k1 ON p.id_kurir_jemput = k1.id_kurir
                                            LEFT JOIN tbl_data_kurir k2 ON p.id_kurir_antar = k2.id_kurir
                                            LEFT JOIN tbl_status_order s ON p.id_status_order = s.id_status
                                            ORDER BY p.id_pengiriman DESC
                                        ";

                                        $query = $conn->query($sql);
                                        while ($row = $query->fetch_assoc()):
                                            $id_pengiriman = $row['id_pengiriman'];
                                            $kurir_jemput = $row['kurir_jemput'] ?? '-';
                                            $kurir_antar = $row['kurir_antar'] ?? '-';
                                            $resi = $row['resi'] ?? '-';
                                            $status = $row['nama_status'] ?? '-';
                                            $waktu_konfirmasi = $row['waktu_konfirmasi'] 
                                                ? date('d M Y, H:i', strtotime($row['waktu_konfirmasi']))
                                                : '-';
                                        ?>
                                        <tr>
                                            <form action="update_status.php" method="POST">
                                                <td>
                                                    <?= 'PKT' . str_pad($id_pengiriman, 3, '0', STR_PAD_LEFT) ?>
                                                    <input type="hidden" name="id_pengiriman"
                                                        value="<?= $id_pengiriman ?>">
                                                </td>
                                                <td><?= htmlspecialchars($kurir_jemput) ?></td>
                                                <td><?= htmlspecialchars($kurir_antar) ?></td>
                                                <td><?= htmlspecialchars($resi) ?></td>
                                                <td><?= htmlspecialchars($status) ?></td>
                                                <td><?= $waktu_konfirmasi ?></td>
                                                <td class="d-flex justify-content-between">
                                                    <a href="detail_order.php?id=<?= $id_pengiriman ?>"
                                                        class="btn btn-info btn-sm mr-1">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <?php if ($_SESSION['level'] === 'kurir'): ?>
                                                    <a href="edit_kurir.php?id=<?= $id_pengiriman ?>"
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                    <?php else: ?>
                                                    <a href="edit_kurir.php?id=<?= $id_pengiriman ?>"
                                                        class="btn btn-sm btn-warning mr-1">Edit</a>
                                                    <a href="hapus_order.php?id=<?= $id_pengiriman ?>"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </a>
                                                    <?php endif; ?>
                                                </td>
                                            </form>
                                        </tr>
                                        <?php endwhile; ?>
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

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
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