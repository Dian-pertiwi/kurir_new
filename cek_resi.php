<?php include 'head.php'; ?>
<?php include 'header.php'; ?>

<section id="cek-resi" class="cek-resi section light-background">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Cek Resi Paket</h2>
        <div class="title-shape">
            <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
                    stroke-width="2"></path>
            </svg>
        </div>
        <p>
            Masukkan nomor resi pengiriman Anda untuk melihat status dan detail perjalanan paket secara real-time.
        </p>
    </div>
    <!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-center">
            <div class="col-lg-6 position-relative" data-aos="fade-right" data-aos-delay="200">
                <div class="about-image">
                    <img src="assets/img/portfolio/kurir-1.jpg" alt="Cek Resi" class="img-fluid rounded-4" />
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                <div class="about-content">
                    <span class="subtitle">Lacak Pengiriman</span>
                    <h2>Cek Status Paket Anda</h2>
                    <p class="lead mb-4">
                        Gunakan fitur pelacakan resi kami untuk mengetahui lokasi terkini dan riwayat perjalanan paket
                        Anda.
                    </p>

                    <form id="formCekResi" class="mb-4">
                        <div class="mb-3">
                            <label for="noResi" class="form-label">Nomor Resi</label>
                            <input type="text" id="noResi" name="noResi" class="form-control"
                                placeholder="Masukkan nomor resi Anda" required />
                        </div>
                        <button type="submit" class="btn btn-primary">Cek Resi</button>
                    </form>
                    <div id="hasilResi" class="mt-4">
                        <!-- Hasil tracking akan tampil di sini -->
                    </div>

                    <div class="signature mt-4">
                        <div class="signature-info">
                            <h4>Tim Becat Kurir NTB</h4>
                            <p>Kami siap bantu lacak paket Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Script contoh: tampilkan dummy hasil tracking
document.getElementById("formCekResi").addEventListener("submit", function(e) {
    e.preventDefault();
    const noResi = document.getElementById("noResi").value;
    const hasil = `
      <div class="card p-3 shadow-sm rounded-3">
        <h5>Nomor Resi: ${noResi}</h5>
        <ul class="list-unstyled mt-3">
          <li><strong>Waktu Kirim:</strong> 16 Mei 2025, 09:15</li>
          <li><strong>Status:</strong> Paket sedang dikirim ke tujuan</li>
          <li><strong>Lokasi Terakhir:</strong> Kantor Cabang Mataram</li>
          <li><strong>Penerima:</strong> Belum diterima</li>
        </ul>
      </div>`;
    document.getElementById("hasilResi").innerHTML = hasil;
});
</script>

<?php include 'footer.php'; ?>

<?php include 'script.php'; ?>