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
                <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data kurir berhasil ditambahkan!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php elseif (isset($_GET['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal menambahkan data kurir.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php endif; ?>
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Data Kurir</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Data Kurir</h6>
                            <!-- Tombol trigger modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#modalTambahKurir">
                                <i class="fas fa-plus"></i> Tambah Kurir
                            </button>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Kurir</th>
                                            <th>No. HP</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
$query = "SELECT * FROM tbl_data_kurir";
$result = mysqli_query($conn, $query);

//MENAMPILKAN DATA KURIR
while ($row = mysqli_fetch_assoc($result)) {
    ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['nama_kurir']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['no_hp']; ?>
                                            </td>
                                            <th>
                                                <?php echo $row['alamat']; ?>
                                            </th>
                                            <td><span class="badge badge-success">
                                                    <?php echo $row['status']; ?>
                                                </span></td>
                                            <td>
                                                <a href="edit_kurir.php?id=<?php echo $row['id_kurir']; ?>"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="hapus_kurir.php?id=<?php echo $row['id_kurir']; ?>"
                                                    onclick="return confirm('Yakin ingin menghapus kurir ini?')"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
}
?>
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

<!-- Modal Tambah Kurir -->
<div class="modal fade" id="modalTambahKurir" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="add_kurir.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Tambah Kurir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kurir</label>
                        <input type="text" name="nama_kurir" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" name="no_hp" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" name="tambahKurir" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>


</html>