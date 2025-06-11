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
                    <h1 class="h3 mb-4 text-gray-800">Manajemen Akun Kurir</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Kurir</h6>
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTambahKurir">
                                <i class="fas fa-plus"></i> Tambah Kurir
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="">
                                        <tr>
                                            <th>ID Kurir</th>
                                            <th>Nama Kurir</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Dummy Data -->
                                        <tr>
                                            <td>K001</td>
                                            <td>Joko Santoso</td>
                                            <td>joko_kurir</td>
                                            <td>123456</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#editModalK001">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>K002</td>
                                            <td>Siti Aminah</td>
                                            <td>siti_kurir</td>
                                            <td>abcdef</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#editModalK002">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Modal Tambah Kurir -->
                            <div class="modal fade" id="modalTambahKurir" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah Kurir Baru</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nama Kurir</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Contoh: Rudi Hartono">
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Contoh: rudi_kurir">
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Contoh: pass1234">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Modal Edit K001 -->
                            <div class="modal fade" id="editModalK001" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Akun - Joko Santoso</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" value="joko_kurir">
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="text" class="form-control" value="123456">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Modal Edit K002 -->
                            <div class="modal fade" id="editModalK002" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Akun - Siti Aminah</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" value="siti_kurir">
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="text" class="form-control" value="abcdef">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
    </script>
</body>

</html>