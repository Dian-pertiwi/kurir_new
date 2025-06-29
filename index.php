<?php 
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'head.php'; ?>

<!-- Bootstrap CSS (jika ada) -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">

<!-- Custom CSS Kamu -->
<link rel="stylesheet" href="<?= $base_url ?>assets/css/style.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


<body class="index-page">


    <header id="header" class="header d-flex align-items-center sticky-top">
        <div
            class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.webp" alt=""> -->
                <h1 class="sitename">Becat Kurir NTB</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="#about">About us</a></li>
                    <li><a href="#portfolio">Gallery</a></li>
                    <li><a href="user_dashboard.php">Profil</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>


            <div class="cta-buttons" data-aos="fade-up" data-aos-delay="300">
                <a href="daftar.php" style="
    display: inline-block;
    padding: 10px 20px;
    background-color: #ff4f0f;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s ease;
">Daftar Sekarang</a>

                <a href="user_login.php" class="btn btn-outline">Login</a>
            </div>
        </div>
    </header>

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
                        <?php if (isset($_SESSION['id_user'])): ?>
                             <a href="order.php" class="btn btn-primary">Pesan Sekarang</a>
                        <?php else: ?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalHarusLogin">
                                Pesan Sekarang
                            </button>
                        <?php endif; ?>

                            <a href="cek_resi.php" class="btn btn-outline">Cek Resi</a>
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
                            <img src="assets/img/image-benner.webp" alt="Kurir Becat NTB" class="img-fluid"
                                data-aos="zoom-out" data-aos-delay="300" style="width: 400px; height: 400px;"
                                class="retina-logo" />
                            <div class="shape-1"></div>
                            <div class="shape-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Hero Section -->

        <!-- Modal Harus Login -->
<div class="modal fade" id="modalHarusLogin" tabindex="-1" role="dialog" aria-labelledby="modalHarusLoginLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content text-center p-4">
      <div class="modal-body">
        <i class="fas fa-lock fa-3x text-warning mb-3"></i>
        <h5 class="modal-title font-weight-bold mb-3" id="modalHarusLoginLabel">Akses Ditolak</h5>
        <p class="text-muted">Silakan login atau daftar akun untuk memesan layanan kurir.</p>
        <div class="d-flex justify-content-center mt-4">
          <a href="user_login.php" class="btn btn-primary mr-2">Login</a>
          <a href="daftar.php" class="btn btn-outline-secondary">Daftar</a>
        </div>
      </div>
    </div>
  </div>
</div>


        <!-- About Section -->
        <section id="about" class="about section light-background">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Tentang Perusahaan</h2>
                <div class="title-shape">
                    <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
                            stroke-width="2"></path>
                    </svg>
                </div>
                <p>
                    Becat Kurir NTB adalah layanan pengiriman paket cepat dan aman untuk
                    seluruh wilayah NTB. Kami hadir untuk memberikan solusi terbaik
                    dalam mendistribusikan barang Anda dengan pelayanan profesional.
                </p>
            </div>
            <!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center">
                    <div class="col-lg-6 position-relative" data-aos="fade-right" data-aos-delay="200">
                        <div class="about-image">
                            <img src="assets/img/portfolio/kurir-4.jpg" alt="Delivery Team"
                                class="img-fluid rounded-4" />
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                        <div class="about-content">
                            <span class="subtitle">Tentang Perusahaan</span>

                            <h2>Becat Kurir NTB - Kirim Paket Lebih Mudah dan Cepat</h2>

                            <p class="lead mb-4">
                                Kami menyediakan layanan pengiriman barang secara cepat, aman,
                                dan terpercaya dengan jangkauan wilayah NTB dan sekitarnya.
                                Didukung oleh tim yang profesional dan teknologi terkini.
                            </p>

                            <p class="mb-4">
                                Layanan kami mencakup penjemputan paket, pelacakan realtime,
                                serta notifikasi otomatis untuk memudahkan pelanggan memantau
                                status pengiriman.
                            </p>

                            <div class="personal-info">
                                <div class="row g-4">
                                    <div class="col-6">
                                        <div class="info-item">
                                            <span class="label">Nama Perusahaan</span>
                                            <span class="value">Becat Kurir NTB</span>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="info-item">
                                            <span class="label">Telepon</span>
                                            <span class="value">+62 812-3456-7890</span>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="info-item">
                                            <span class="label">Email</span>
                                            <span class="value">cs@becatkurirntb.id</span>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="info-item">
                                            <span class="label">Alamat Kantor</span>
                                            <span class="value">Jl. Trans NTB No. 15, Mataram</span>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="info-item">
                                            <span class="label">Layanan</span>
                                            <span class="value">Pengiriman Paket, Tracking, Pickup</span>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="info-item">
                                            <span class="label">Wilayah Layanan</span>
                                            <span class="value">Nusa Tenggara Barat</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="signature mt-4">
                                <div class="signature-info">
                                    <h4>Tim Becat Kurir NTB</h4>
                                    <p>Melayani Sepenuh Hati</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /About Section -->

        <!-- Resume Section -->
        <section id="resume" class="resume section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Profil & Pengalaman</h2>
                <div class="title-shape">
                    <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
                            stroke-width="2"></path>
                    </svg>
                </div>
                <p>
                    Jejak pengalaman dan komitmen Becat Kurir NTB dalam memberikan
                    layanan pengiriman paket terbaik, cepat, dan terpercaya di wilayah
                    Nusa Tenggara Barat.
                </p>
            </div>
            <!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-12">
                        <div class="resume-wrapper">
                            <!-- Pengalaman Operasional -->
                            <div class="resume-block" data-aos="fade-up">
                                <h2>Layanan & Pengalaman Operasional</h2>
                                <p class="lead">
                                    Becat Kurir NTB telah melayani ribuan pelanggan dengan
                                    pengiriman paket cepat dan aman ke seluruh pelosok NTB.
                                </p>

                                <div class="timeline">
                                    <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">
                                        <div class="timeline-left">
                                            <h4 class="company">Pengiriman Antar-Kota</h4>
                                            <span class="period">2020 - Sekarang</span>
                                        </div>
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-right">
                                            <h3 class="position">Wilayah NTB</h3>
                                            <p class="description">
                                                Menjangkau seluruh kabupaten dan kota di NTB seperti
                                                Mataram, Lombok Tengah, Lombok Timur, Bima, Dompu, dan
                                                Sumbawa dengan armada sendiri.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="timeline-item" data-aos="fade-up" data-aos-delay="300">
                                        <div class="timeline-left">
                                            <h4 class="company">Layanan Jemput Paket</h4>
                                            <span class="period">2021 - Sekarang</span>
                                        </div>
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-right">
                                            <h3 class="position">Respon Cepat</h3>
                                            <p class="description">
                                                Pelanggan cukup isi form di website, tim kami akan
                                                menjemput paket langsung ke rumah/kantor dalam waktu
                                                singkat.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="timeline-item" data-aos="fade-up" data-aos-delay="400">
                                        <div class="timeline-left">
                                            <h4 class="company">Layanan Prioritas</h4>
                                            <span class="period">2023 - Sekarang</span>
                                        </div>
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-right">
                                            <h3 class="position">Khusus UMKM & Bisnis</h3>
                                            <p class="description">
                                                Menyediakan layanan pengiriman express dengan dukungan
                                                pelacakan real-time, khusus untuk pelaku usaha kecil
                                                dan menengah di NTB.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pencapaian & Perkembangan -->
                            <div class="resume-block" data-aos="fade-up" data-aos-delay="100">
                                <h2>Pencapaian & Perkembangan</h2>
                                <p class="lead">
                                    Terus berkembang untuk menjadi kurir lokal terpercaya dengan
                                    dukungan teknologi dan dedikasi pelayanan.
                                </p>

                                <div class="timeline">
                                    <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">
                                        <div class="timeline-left">
                                            <h4 class="company">Digitalisasi Layanan</h4>
                                            <span class="period">2022</span>
                                        </div>
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-right">
                                            <h3 class="position">Peluncuran Website</h3>
                                            <p class="description">
                                                Resmi meluncurkan sistem pemesanan pengiriman paket
                                                berbasis web yang memudahkan pelanggan mengisi form
                                                dan melacak status paket.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="timeline-item" data-aos="fade-up" data-aos-delay="300">
                                        <div class="timeline-left">
                                            <h4 class="company">Kemitraan Lokal</h4>
                                            <span class="period">2023</span>
                                        </div>
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-right">
                                            <h3 class="position">Dukungan UMKM</h3>
                                            <p class="description">
                                                Menjalin kerja sama dengan puluhan UMKM lokal untuk
                                                mendukung distribusi produk mereka ke seluruh wilayah
                                                NTB.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="timeline-item" data-aos="fade-up" data-aos-delay="400">
                                        <div class="timeline-left">
                                            <h4 class="company">Ekspansi Armada</h4>
                                            <span class="period">2024</span>
                                        </div>
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-right">
                                            <h3 class="position">Penambahan Unit Motor & Mobil</h3>
                                            <p class="description">
                                                Untuk mendukung meningkatnya permintaan, kami menambah
                                                armada operasional agar pengiriman lebih cepat dan
                                                jangkauan lebih luas.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End resume-block -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Resume Section -->

        <!-- Portfolio Section -->
        <?php include 'head.php';?>

        <section id="portfolio" class="portfolio section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Portfolio</h2>
                <div class="title-shape">
                    <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
                            stroke-width="2"></path>
                    </svg>
                </div>
                <p>
                    Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse
                    quam nihil molestiae consequatur vel illum qui dolorem
                </p>
            </div>
            <!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
                    <div class="portfolio-filters-container" data-aos="fade-up" data-aos-delay="200">
                        <ul class="portfolio-filters isotope-filters">
                            <li data-filter="*" class="filter-active">All Work</li>
                            <li data-filter=".filter-web">Web Design</li>
                            <li data-filter=".filter-graphics">Graphics</li>
                            <li data-filter=".filter-motion">Motion</li>
                            <li data-filter=".filter-brand">Branding</li>
                        </ul>
                    </div>

                    <div class="row g-4 isotope-container" data-aos="fade-up" data-aos-delay="300">
                        <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-web">
                            <div class="portfolio-card">
                                <div class="portfolio-image">
                                    <img src="assets/img/portfolio/kurir-1.jpg" class="img-fluid" alt=""
                                        loading="lazy" />
                                    <div class="portfolio-overlay">
                                        <div class="portfolio-actions">
                                            <a href="assets/img/portfolio/kurir-2.jpg" class="glightbox preview-link"
                                                data-gallery="portfolio-gallery-web"><i class="bi bi-eye"></i></a>
                                            <a href="portfolio-details.html" class="details-link"><i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-content">
                                    <span class="category">Web Design</span>
                                    <h3>Modern Dashboard Interface</h3>
                                    <p>
                                        Maecenas faucibus mollis interdum sed posuere consectetur
                                        est at lobortis.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- End Portfolio Item -->

                        <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-graphics">
                            <div class="portfolio-card">
                                <div class="portfolio-image">
                                    <img src="assets/img/portfolio/kurir-3.jpg" class="img-fluid" alt=""
                                        loading="lazy" />
                                    <div class="portfolio-overlay">
                                        <div class="portfolio-actions">
                                            <a href="assets/img/portfolio/kurir-4.jpg" class="glightbox preview-link"
                                                data-gallery="portfolio-gallery-graphics"><i class="bi bi-eye"></i></a>
                                            <a href="portfolio-details.html" class="details-link"><i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-content">
                                    <span class="category">Graphics</span>
                                    <h3>Creative Brand Identity</h3>
                                    <p>
                                        Vestibulum id ligula porta felis euismod semper at
                                        vulputate.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- End Portfolio Item -->

                        <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-motion">
                            <div class="portfolio-card">
                                <div class="portfolio-image">
                                    <img src="assets/img/portfolio/kurir-5.jpg" class="img-fluid" alt=""
                                        loading="lazy" />
                                    <div class="portfolio-overlay">
                                        <div class="portfolio-actions">
                                            <a href="assets/img/portfolio/portfolio-7.webp"
                                                class="glightbox preview-link"
                                                data-gallery="portfolio-gallery-motion"><i class="bi bi-eye"></i></a>
                                            <a href="portfolio-details.html" class="details-link"><i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-content">
                                    <span class="category">Motion</span>
                                    <h3>Product Animation Reel</h3>
                                    <p>
                                        Donec ullamcorper nulla non metus auctor fringilla
                                        dapibus.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- End Portfolio Item -->

                        <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-brand">
                            <div class="portfolio-card">
                                <div class="portfolio-image">
                                    <img src="assets/img/portfolio/portfolio-4.webp" class="img-fluid" alt=""
                                        loading="lazy" />
                                    <div class="portfolio-overlay">
                                        <div class="portfolio-actions">
                                            <a href="assets/img/portfolio/portfolio-4.webp"
                                                class="glightbox preview-link" data-gallery="portfolio-gallery-brand"><i
                                                    class="bi bi-eye"></i></a>
                                            <a href="portfolio-details.html" class="details-link"><i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-content">
                                    <span class="category">Branding</span>
                                    <h3>Luxury Brand Package</h3>
                                    <p>Aenean lacinia bibendum nulla sed consectetur elit.</p>
                                </div>
                            </div>
                        </div>
                        <!-- End Portfolio Item -->

                        <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-web">
                            <div class="portfolio-card">
                                <div class="portfolio-image">
                                    <img src="assets/img/portfolio/portfolio-2.webp" class="img-fluid" alt=""
                                        loading="lazy" />
                                    <div class="portfolio-overlay">
                                        <div class="portfolio-actions">
                                            <a href="assets/img/portfolio/portfolio-2.webp"
                                                class="glightbox preview-link" data-gallery="portfolio-gallery-web"><i
                                                    class="bi bi-eye"></i></a>
                                            <a href="portfolio-details.html" class="details-link"><i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-content">
                                    <span class="category">Web Design</span>
                                    <h3>E-commerce Platform</h3>
                                    <p>
                                        Nullam id dolor id nibh ultricies vehicula ut id elit.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- End Portfolio Item -->

                        <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-graphics">
                            <div class="portfolio-card">
                                <div class="portfolio-image">
                                    <img src="assets/img/portfolio/portfolio-11.webp" class="img-fluid" alt=""
                                        loading="lazy" />
                                    <div class="portfolio-overlay">
                                        <div class="portfolio-actions">
                                            <a href="assets/img/portfolio/portfolio-11.webp"
                                                class="glightbox preview-link"
                                                data-gallery="portfolio-gallery-graphics"><i class="bi bi-eye"></i></a>
                                            <a href="portfolio-details.html" class="details-link"><i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-content">
                                    <span class="category">Graphics</span>
                                    <h3>Digital Art Collection</h3>
                                    <p>Cras mattis consectetur purus sit amet fermentum.</p>
                                </div>
                            </div>
                        </div>
                        <!-- End Portfolio Item -->
                    </div>
                    <!-- End Portfolio Container -->
                </div>
            </div>
        </section>

        <?php include 'script.php'; ?>
        <!-- /Portfolio Section -->

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section light-background">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Testimoni Pelanggan</h2>
                <div class="title-shape">
                    <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
                            stroke-width="2"></path>
                    </svg>
                </div>
                <p>
                    Simak pengalaman pelanggan kami setelah menggunakan layanan
                    pengiriman cepat dan aman dari Becat Kurir NTB.
                </p>
            </div>
            <!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonials-slider swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                    {
                        "slidesPerView": 1,
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000
                        },
                        "navigation": {
                            "nextEl": ".swiper-button-next",
                            "prevEl": ".swiper-button-prev"
                        }
                    }
                    </script>

                    <div class="swiper-wrapper">
                        <!-- Testimonial Item -->
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h2>Paket sampai tepat waktu!</h2>
                                        <p>
                                            Saya sangat puas dengan pelayanan Becat Kurir NTB. Paket
                                            saya dikirim dari Mataram ke Dompu dalam waktu kurang
                                            dari 24 jam. Sangat direkomendasikan!
                                        </p>
                                        <div class="profile d-flex align-items-center">
                                            <img src="assets/img/person/person-m-7.webp" class="profile-img" alt="" />
                                            <div class="profile-info">
                                                <h3>Hendra Saputra</h3>
                                                <span>Pelanggan</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 d-none d-lg-block">
                                        <div class="featured-img-wrapper">
                                            <img src="assets/img/person/person-m-7.webp" class="featured-img" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial Item -->
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h2>Kurir ramah dan responsif</h2>
                                        <p>
                                            Saya order melalui website dan langsung dikonfirmasi.
                                            Kurir datang tepat waktu, ramah, dan proses pengiriman
                                            sangat profesional. Mantap Becat!
                                        </p>
                                        <div class="profile d-flex align-items-center">
                                            <img src="assets/img/person/person-f-8.webp" class="profile-img" alt="" />
                                            <div class="profile-info">
                                                <h3>Siti Nurhaliza</h3>
                                                <span>Pelanggan UMKM</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 d-none d-lg-block">
                                        <div class="featured-img-wrapper">
                                            <img src="assets/img/person/person-f-8.webp" class="featured-img" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial Item -->
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h2>Paket aman sampai tujuan</h2>
                                        <p>
                                            Saya kirim barang elektronik dan ternyata sampai dalam
                                            kondisi sempurna. Packing rapi dan tidak ada kerusakan.
                                            Terima kasih Becat Kurir NTB!
                                        </p>
                                        <div class="profile d-flex align-items-center">
                                            <img src="assets/img/person/person-m-9.webp" class="profile-img" alt="" />
                                            <div class="profile-info">
                                                <h3>Rudi Hartono</h3>
                                                <span>Pelanggan</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 d-none d-lg-block">
                                        <div class="featured-img-wrapper">
                                            <img src="assets/img/person/person-m-9.webp" class="featured-img" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-navigation w-100 d-flex align-items-center justify-content-center">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Testimonials Section -->

        <!-- Services Section -->
        <section id="services" class="services section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Layanan Kami</h2>
                <div class="title-shape">
                    <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
                            stroke-width="2"></path>
                    </svg>
                </div>
                <p>
                    Becat Kurir NTB menyediakan berbagai layanan pengiriman yang cepat,
                    aman, dan terpercaya untuk kebutuhan Anda, baik individu maupun
                    bisnis.
                </p>
            </div>
            <!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h2 class="fw-bold mb-4 servies-title">
                            Pengiriman Paket Mudah & Cepat ke Seluruh NTB
                        </h2>
                        <p class="mb-4">
                            Kami hadir dengan solusi logistik lokal yang menjangkau kota dan
                            desa di seluruh wilayah Nusa Tenggara Barat.
                        </p>
                        <a href="order.php" class="btn btn-outline-primary">Pesan Sekarang</a>
                    </div>
                    <div class="col-lg-8">
                        <div class="row g-4">
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="service-item">
                                    <i class="bi bi-box-seam icon"></i>
                                    <h3>
                                        <a href="#">Pengiriman Reguler</a>
                                    </h3>
                                    <p>
                                        Layanan pengiriman standar dengan estimasi waktu
                                        pengiriman 1–3 hari kerja ke seluruh wilayah NTB.
                                    </p>
                                </div>
                            </div>
                            <!-- End Service Item -->

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="service-item">
                                    <i class="bi bi-lightning-fill icon"></i>
                                    <h3>
                                        <a href="#">Pengiriman Kilat</a>
                                    </h3>
                                    <p>
                                        Butuh cepat? Gunakan layanan kilat kami untuk pengiriman
                                        dalam hari yang sama di area tertentu.
                                    </p>
                                </div>
                            </div>
                            <!-- End Service Item -->

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                                <div class="service-item">
                                    <i class="bi bi-house-door icon"></i>
                                    <h3>
                                        <a href="#">Layanan Jemput Paket</a>
                                    </h3>
                                    <p>
                                        Kurir kami siap menjemput paket langsung ke lokasi Anda,
                                        tanpa biaya tambahan di area layanan kami.
                                    </p>
                                </div>
                            </div>
                            <!-- End Service Item -->

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                                <div class="service-item">
                                    <i class="bi bi-shield-check icon"></i>
                                    <h3>
                                        <a href="#">Tracking & Keamanan</a>
                                    </h3>
                                    <p>
                                        Pantau status pengiriman Anda secara real-time dengan
                                        sistem pelacakan kami yang transparan dan aman.
                                    </p>
                                </div>
                            </div>
                            <!-- End Service Item -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Services Section -->

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

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