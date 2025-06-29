<?php
session_start();
include 'config/koneksi.php';

// Cek login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

// Ambil data kurir aktif untuk modal
$kurir_query = mysqli_query($conn, "SELECT * FROM tbl_data_kurir WHERE status = 'aktif'");
$kurir_options = '';
while ($kurir = mysqli_fetch_assoc($kurir_query)) {
    $kurir_options .= '<option value="' . $kurir['id_kurir'] . '">' . $kurir['nama_kurir'] . ' (' . $kurir['alamat_kurir'] . ')</option>';
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
                    <h1 class="h3 mb-4 text-gray-800">Data Pengiriman</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Orderan Kurir Masuk</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Pengirim</th>
                                            <th>Penerima</th>
                                            <th>Kurir Jemput</th>
                                            <th>Kurir Antar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "
                                            SELECT 
                                                pp.id_pengiriman,
                                                peng.nama_pengirim,
                                                pener.nama_penerima,
                                                kj.nama_kurir AS kurir_jemput,
                                                ka.nama_kurir AS kurir_antar
                                            FROM tbl_pengiriman_paket pp
                                            LEFT JOIN tbl_pengirim peng ON pp.id_pengirim = peng.id_pengirim
                                            LEFT JOIN tbl_penerima pener ON pp.id_penerima = pener.id_penerima
                                            LEFT JOIN tbl_data_kurir kj ON pp.id_kurir_jemput = kj.id_kurir
                                            LEFT JOIN tbl_data_kurir ka ON pp.id_kurir_antar = ka.id_kurir
                                            ORDER BY pp.id_pengiriman DESC
                                        ";
                                        $query = $conn->query($sql);

                                        while ($row = $query->fetch_assoc()):
                                            $id = $row['id_pengiriman'];
                                            $kode = 'ORD' . str_pad($id, 3, '0', STR_PAD_LEFT);
                                        ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['nama_pengirim']) ?></td>
                                            <td><?= htmlspecialchars($row['nama_penerima']) ?></td>
                                            <td><?= htmlspecialchars($row['kurir_jemput'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($row['kurir_antar'] ?? '-') ?></td>
                                            
                                            <td>
                                                <div class="d-flex flex-wrap gap-1 justify-content-start">
                                                    <a href="detail_order.php?id=<?= $id ?>" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i> Cek
                                                    </a>
                                                    <a href="hapus_order.php?id=<?= $id ?>" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin hapus order ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </a>
                                                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#modalKonfirmasikurir<?= $id ?>">
                                                        <i class="fas fa-check"></i> Update Status Pengiriman
                                                    </a>
                                                    <?php if (isset($_SESSION['level']) && $_SESSION['level'] !== 'kurir'): ?>
                                                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#modalKonfirmasi<?= $id ?>">
                                                        <i class="fas fa-check"></i> Konfirmasi
                                                    </a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>

                                        </tr>

                                        <!-- Modal Konfirmasi -->

                                        <?php endwhile; ?>
                                    </tbody>

                                    <!-- Modal Konfirmasi -->
<div class="modal fade" id="modalKonfirmasi<?= $id ?>" tabindex="-1" role="dialog"
    aria-labelledby="modalKonfirmasiLabel<?= $id ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="proses_konfirmasi.php" method="POST">
            <input type="hidden" name="id_order" value="<?= $id ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKonfirmasiLabel<?= $id ?>">
                        Konfirmasi Order #<?= $kode ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kurir Jemput</label>
                        <select name="id_kurir_jemput" class="form-control" required>
                            <option value="">-- Pilih Kurir Jemput --</option>
                            <?= $kurir_options ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kurir Antar</label>
                        <select name="id_kurir_antar" class="form-control" required>
                            <option value="">-- Pilih Kurir Antar --</option>
                            <?= $kurir_options ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="konfirmasi" class="btn btn-primary">Konfirmasi</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalKonfirmasikurir<?= $id ?>" tabindex="-1" role="dialog"
    aria-labelledby="modalKonfirmasiLabel<?= $id ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="proses_konfirmasi.php" method="POST">
            <input type="hidden" name="id_order" value="<?= $id ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKonfirmasiLabel<?= $id ?>">
                    Update status Pengiriman
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status Pengiriman</label>
                        <select name="id_kurir_jemput" class="form-control" required>
                            <option value="">-- Status --</option>
                            <?= $kurir_options ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="konfirmasi" class="btn btn-primary">Konfirmasi</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

                                </table>
                            </div>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
    </script>
</body>

</html>