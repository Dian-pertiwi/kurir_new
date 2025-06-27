<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Pastikan CSS terhubung -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
</head>

<body style="margin: 0; font-family: Arial, sans-serif;">

    <!-- Header/Navbar -->
    <header
        style="border-bottom: 1px solid #ccc; padding: 10px 30px; display: flex; justify-content: space-between; align-items: center;">
        <div style="font-weight: bold;">Becat Kurir</div>
        <nav style="display: flex; gap: 25px;">
            <a href="index.php" style="text-decoration: none; color: #000;">Home</a>
            <a href="about.php" style="text-decoration: none; color: #000;">About us</a>
            <a href="galeri.php" style="text-decoration: none; color: #000;">Galeri</a>
        </nav>
        <div style="position: relative;">
            <span style="font-weight: bold;">Hi Hakata & CO</span>
            <div
                style="position: absolute; top: 25px; right: 0; border: 1px solid #000; padding: 5px 10px; background: #fff;">
                <a href="profil.php" style="display: block; text-decoration: none; color: #000;">Profil</a>
                <a href="logout.php" style="display: block; text-decoration: none; color: #000;">Logout</a>
            </div>
        </div>
    </header>

    <!-- Section Layout (seperti Hero) -->
    <section id="profil" class="hero section" style="padding: 60px 0; background-color: #f8f9fa;">
        <div class="container" style="max-width: 960px; margin: auto;" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-center content">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200" style="text-align: center;">
                    <h2 style="margin-bottom: 20px;">
                        Profil <span class="text-primary">Pengguna</span>
                    </h2>
                    <p class="lead" style="margin-bottom: 40px;">
                        Informasi akun dan identitas Anda di sistem pengiriman Becat Kurir NTB.
                    </p>

                    <!-- Profil Box -->
                    <div
                        style="border: 1px solid #000; padding: 25px; text-align: left; background: #fff; max-width: 600px; margin: auto;">
                        <p><strong>Nama</strong> : Hakata & CO</p>
                        <p><strong>Alamat</strong></p>
                        <p>&nbsp;&nbsp;Kabupaten/Kota : Mataram</p>
                        <p>&nbsp;&nbsp;Kecamatan : Sekarbela</p>
                        <p>&nbsp;&nbsp;Desa/RT/RW : Pagesangan jl. Airlangga no.15</p>
                        <p><strong>No. HP</strong> : 081937500766</p>
                        <p><strong>Bank</strong> : Mandiri - 821721093719</p>
                    </div>

                    <!-- Tombol -->
                    <div class="cta-buttons" data-aos="fade-up" data-aos-delay="300" style="margin-top: 30px;">
                        <a href="ubah_profil.php" class="btn btn-primary" style="padding: 10px 25px;">Ubah Profil</a>
                    </div>

                    <!-- Footer -->
                    <p style="margin-top: 60px; color: #999;">Hak Cipta © Becat Kurir 2025</p>
                </div>
            </div>
        </div>
    </section>

    <!-- AOS / JS (Jika digunakan seperti di index) -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script>
    AOS.init();
    </script>
</body>

</html>