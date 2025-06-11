<!DOCTYPE html>
<html lang="en">

<?php include 'head.php'; ?>

<link rel="stylesheet" href="assets/css/style.css">

<body class="index-page">


    <?php 
if (!isset($header_included)) {
    include 'header.php';
    $header_included = true;  // Set header as included
}
?>

    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center content">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <h2>
                            Selamat Datang di
                            <span class="text-primary">Becat Kurir NTB</span>
                        </h2>
                        <p class="lead">
                            Solusi pengiriman cepat dan terpercaya di Nusa Tenggara Barat.
                            Kami siap menjemput dan mengantarkan paket Anda dengan aman,
                            tepat waktu, dan harga terjangkau. Didukung oleh tim profesional
                            dan layanan customer support yang responsif.
                        </p>
                        <div class="cta-buttons" data-aos="fade-up" data-aos-delay="300">
                            <a href="order.php" class="btn btn-primary">Pesan Sekarang</a>
                            <a href="cek_resi.php" class="btn btn-outline">Lacak Kiriman</a>
                        </div>
                        <div class="hero-stats mt-4" data-aos="fade-up" data-aos-delay="400">
                            <div class="stat-item">
                                <span class="stat-number">5+</span>
                                <span class="stat-label">Tahun Pengalaman</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">10K+</span>
                                <span class="stat-label">Paket Terkirim</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">95%</span>
                                <span class="stat-label">Tingkat Kepuasan Pelanggan</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-image">
                            <img src="assets/img/hero-2.png" alt="Kurir Becat NTB" class="img-fluid" data-aos="zoom-out"
                                data-aos-delay="300" style="width: 300%; height: auto;" class="retina-logo" />
                            <div class="shape-1"></div>
                            <div class="shape-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Hero Section -->

        <!-- About Section -->
        <?php include 'about.php'; ?>
        <!-- /About Section -->

        <!-- Resume Section -->
        <?php include 'resume.php'; ?>
        <!-- /Resume Section -->

        <!-- Portfolio Section -->
        <?php include 'portfolio.php'; ?>
        <!-- /Portfolio Section -->

        <!-- Testimonials Section -->
        <?php include 'testimoni.php'; ?>
        <!-- /Testimonials Section -->

        <!-- Services Section -->
        <?php include 'service.php'; ?>
        <!-- /Services Section -->

        <?php include 'order.php'; ?>

    </main>


    <?php include 'footer.php'; ?>

    <!-- Back to Top -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    ?>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>