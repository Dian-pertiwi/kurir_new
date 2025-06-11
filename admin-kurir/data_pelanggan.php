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
                    <h1 class="h3 mb-4 text-gray-800">Daftar Pelanggan</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
                            <!-- <a href="tambah_pelanggan.php" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Tambah Pelanggan
                            </a> -->
                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#modalTambahPelanggan">
                                <i class="fas fa-plus"></i> Tambah Pelanggan
                            </button>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Pelanggan</th>
                                            <th>Nama</th>
                                            <th>Nama Bank</th>
                                            <th>Nomor Rekening</th>
                                            <th>No. HP</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data Dummy -->
                                        <tr>
                                            <td>PLG001</td>
                                            <td>Andi Setiawan</td>
                                            <td>Bank BCA</td>
                                            <td>1234567890</td>
                                            <td>081234567890</td>
                                            <td>Jl. Melati No. 10, Jakarta</td>
                                            <td>
                                                <a href="edit_pelanggan.php?id=PLG003"
                                                    class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="hapus_pelanggan.php?id=PLG003"
                                                    onclick="return confirm('Yakin ingin menghapus pelanggan ini?')"
                                                    class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </a>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>PLG002</td>
                                            <td>Siti Nurhaliza</td>
                                            <td>Bank Mandiri</td>
                                            <td>0987654321</td>
                                            <td>089876543210</td>
                                            <td>Jl. Anggrek No. 5, Bandung</td>
                                            <td>
                                                <a href="edit_pelanggan.php?id=PLG003"
                                                    class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="hapus_pelanggan.php?id=PLG003"
                                                    onclick="return confirm('Yakin ingin menghapus pelanggan ini?')"
                                                    class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </a>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>PLG003</td>
                                            <td>Budi Hartono</td>
                                            <td>Bank BRI</td>
                                            <td>1122334455</td>
                                            <td>082112345678</td>
                                            <td>Jl. Mawar No. 20, Surabaya</td>
                                            <td>
                                                <a href="edit_pelanggan.php?id=PLG003"
                                                    class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="hapus_pelanggan.php?id=PLG003"
                                                    onclick="return confirm('Yakin ingin menghapus pelanggan ini?')"
                                                    class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </a>
                                            </td>

                                        </tr>
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

<!-- Modal Tambah Pelanggan -->
<div class="modal fade" id="modalTambahPelanggan" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="proses_tambah_pelanggan.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Pelanggan Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>ID Pelanggan</label>
                        <input type="text" name="id_pelanggan" class="form-control" placeholder="Contoh: PLG004"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Bank</label>
                        <input type="text" name="bank" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor Rekening</label>
                        <input type="text" name="no_rekening" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" name="no_hp" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>


</html>