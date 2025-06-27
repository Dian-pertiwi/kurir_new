<?php include 'admin-kurir/config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<?php include 'head.php'; ?>

<section id="form_pengiriman" class="form_pengiriman section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Formulir Pengiriman Paket</h2>
        <p>Becat Kurir NTB menyediakan layanan pengiriman cepat, aman, dan terpercaya.</p>
    </div>

    <main class="container py-5">
        <form action="proses_order.php" method="POST" enctype="multipart/form-data" class="card shadow p-4 border-0">
            <div class="row">
                <!-- DATA PENGIRIM -->
                <div class="col-md-6">
                    <h5 class="mb-3">Data Pengirim</h5>
                    <div class="mb-3">
                        <label>Nama Pengirim</label>
                        <input type="text" name="nama_pengirim" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Kabupaten Pengirim</label>
                        <select name="id_kab_asal" id="kabupaten_pengirim" class="form-control" required>
                            <option value="">Pilih Kabupaten</option>
                            <?php
                            $result = $conn->query("SELECT id_kab, nama_kabupaten FROM tbl_kabupaten ORDER BY nama_kabupaten ASC");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['id_kab']}'>{$row['nama_kabupaten']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Kecamatan Pengirim</label>
                        <select name="kecamatan_pengirim" id="kecamatan_pengirim" class="form-control"
                            required></select>
                    </div>
                    <div class="mb-3">
                        <label>Alamat Lengkap Pengirim</label>
                        <textarea name="alamat_pengirim" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>No. HP Pengirim</label>
                        <input type="text" name="hp_pengirim" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Bank Pengirim</label>
                        <select name="id_bank" class="form-control" required>
                            <option value="">Pilih Bank</option>
                            <?php
                            $result = $conn->query("SELECT id_bank, nama_bank FROM tbl_bank");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['id_bank']}'>{$row['nama_bank']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>No. Rekening</label>
                        <input type="text" name="no_rekening" class="form-control" required>
                    </div>
                </div>

                <!-- DATA PENERIMA -->
                <div class="col-md-6">
                    <h5 class="mb-3">Data Penerima</h5>
                    <div class="mb-3">
                        <label>Nama Penerima</label>
                        <input type="text" name="nama_penerima" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Kabupaten Penerima</label>
                        <select id="kabupaten_penerima" name="id_kab_tujuan" class="form-control" required>
                            <option value="">Pilih Kabupaten</option>
                            <?php
                            $result = $conn->query("SELECT id_kab, nama_kabupaten FROM tbl_kabupaten ORDER BY nama_kabupaten ASC");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['id_kab']}'>{$row['nama_kabupaten']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Kecamatan Penerima</label>
                        <select name="kecamatan_penerima" id="kecamatan_penerima" class="form-control"
                            required></select>
                    </div>
                    <div class="mb-3">
                        <label>Alamat Lengkap Penerima</label>
                        <textarea name="alamat_penerima" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>No. HP Penerima</label>
                        <input type="text" name="hp_penerima" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Link Google Maps (Opsional)</label>
                        <input type="url" name="link_maps" class="form-control">
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <!-- DETAIL BARANG -->
            <h5 class="mb-3">Detail Barang</h5>
            <div class="mb-3">
                <label>Jenis Barang</label>
                <select name="jenis_paket" class="form-control" required>
                    <option value="">-- Pilih Jenis Paket --</option>
                    <?php
                    $result = $conn->query("SELECT * FROM tbl_jenis_paket");
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id_jenis_paket'] . "'>" . $row['nama_jenis_paket'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Berat Barang (kg)</label>
                <input type="number" name="berat_barang" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Harga Barang (jika COD)</label>
                <input type="number" name="harga_barang" class="form-control">
            </div>
            <div class="mb-3">
                <label>Status Pembayaran</label>
                <select name="status_pembayaran" class="form-control" required>
                    <option value="belum bayar">Belum Bayar</option>
                    <option value="sudah bayar">Sudah Bayar</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Pilih Tarif Berdasarkan Kabupaten</label>
                <select name="id_tarif" class="form-control" required>
                    <option value="">Pilih Tarif</option>
                    <?php
                    $query = $conn->query("SELECT t.id_tarif, kab_asal.nama_kabupaten AS asal, kab_tujuan.nama_kabupaten AS tujuan, t.tarif FROM tbl_tarif t JOIN tbl_kabupaten kab_asal ON t.id_kab_asal = kab_asal.id_kab JOIN tbl_kabupaten kab_tujuan ON t.id_kab_tujuan = kab_tujuan.id_kab ORDER BY kab_asal.nama_kabupaten, kab_tujuan.nama_kabupaten");
                    while ($row = $query->fetch_assoc()) {
                        echo "<option value='{$row['id_tarif']}'>Dari {$row['asal']} ke {$row['tujuan']} - Rp " . number_format($row['tarif'], 0, ',', '.') . "</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-warning w-100">Kirim Orderan</button>
        </form>
    </main>
</section>

<?php include 'script.php'; ?>

<!-- SCRIPT EMOSIFA -->
<script>
function loadKecamatan(selectKabupatenId, targetKecamatanId) {
    const kabupatenId = document.getElementById(selectKabupatenId).value;
    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabupatenId}.json`)
        .then(res => res.json())
        .then(data => {
            const kecamatanSelect = document.getElementById(targetKecamatanId);
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            data.forEach(item => {
                kecamatanSelect.innerHTML += `<option value="${item.name}">${item.name}</option>`;
            });
        });
}

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("kabupaten_pengirim").addEventListener("change", function() {
        loadKecamatan("kabupaten_pengirim", "kecamatan_pengirim");
    });

    document.getElementById("kabupaten_penerima").addEventListener("change", function() {
        loadKecamatan("kabupaten_penerima", "kecamatan_penerima");
    });
});
</script>