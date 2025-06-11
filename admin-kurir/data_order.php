<?php
include 'config/koneksi.php';
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
                                            <th>ID Order</th>
                                            <th>Pengirim</th>
                                            <th>Penerima</th>
                                            <th>Kurir Jemput</th>
                                            <th>Kurir Antar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Query untuk mengambil data dari beberapa tabel yang sudah dinormalisasi
                                        $sql = "
                                            SELECT 
                                                p.id_pengiriman,
                                                p.id_pengirim,
                                                p.id_penerima,
                                                p.kurir_jemput,
                                                p.kurir_antar,
                                                pg.nama_pengirim,
                                                pn.nama_penerima
                                            FROM tbl_pengiriman p
                                            LEFT JOIN tbl_pengirim pg ON p.id_pengirim = pg.id_pengirim
                                            LEFT JOIN tbl_penerima pn ON p.id_penerima = pn.id_penerima
                                            ORDER BY p.id_pengiriman DESC
                                        ";
                                        $query = $conn->query($sql);

                                        while ($row = $query->fetch_assoc()):
                                        $id = $row['id_pengiriman'];
                                        $kode = 'ORD' . str_pad($id, 3, '0', STR_PAD_LEFT);
                                        ?>
                                        <tr>
                                            <td><?= htmlspecialchars($kode) ?></td>
                                            <td><?= htmlspecialchars($row['nama_pengirim']) ?></td>
                                            <td><?= htmlspecialchars($row['nama_penerima']) ?></td>
                                            <td><?= htmlspecialchars($row['kurir_jemput']) ?></td>
                                            <td><?= htmlspecialchars($row['kurir_antar']) ?></td>
                                            <td>
                                                <!-- Tombol Konfirmasi tetap ada -->
                                                <button class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#modalKonfirmasi<?= $id ?>">
                                                    <i class="fas fa-check"></i> Konfirmasi
                                                </button>
                                                <!-- Tombol untuk melihat detail orderan -->
                                                <a href="detail_order.php?id=<?= $id ?>" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> Lihat Detail
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Konfirmasi -->
                                        <div class="modal fade" id="modalKonfirmasi<?= $id ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="modalKonfirmasiLabel<?= $id ?>"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="proses_konfirmasi.php" method="POST">
                                                    <input type="hidden" name="id_order" value="<?= $id ?>">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalKonfirmasiLabel<?= $id ?>">
                                                                Konfirmasi Order #<?= $kode ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <?php 
                                                        $kurir_query = mysqli_query($conn, "SELECT * FROM tbl_data_kurir");
                                                        $kurir_options = '';
                                                        while ($kurir = mysqli_fetch_assoc($kurir_query)) {
                                                            $kurir_options .= '<option value="' . $kurir['id_kurir'] . '">' . $kurir['nama_kurir'] . ' (' . $kurir['alamat'] . ')</option>';
                                                        }
                                                        ?>

                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="id_kurir_jemput">Kurir Jemput</label>
                                                                <select name="id_kurir_jemput" class="form-control"
                                                                    required>
                                                                    <option value="">-- Pilih Kurir Jemput --</option>
                                                                    <?= $kurir_options ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="id_kurir_antar">Kurir Antar</label>
                                                                <select name="id_kurir_antar" class="form-control"
                                                                    required>
                                                                    <option value="">-- Pilih Kurir Antar --</option>
                                                                    <?= $kurir_options ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tarif_ongkir">Tarif Ongkir</label>
                                                                <input type="number" name="tarif_ongkir"
                                                                    class="form-control" required
                                                                    placeholder="Masukkan tarif ongkir">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="konfirmasi"
                                                                class="btn btn-primary">Konfirmasi</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <?php include 'footer.php'; ?>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- JavaScript -->
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