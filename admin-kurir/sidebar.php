<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-shipping-fast"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Becat Kurir</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Menu untuk semua user -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="data_order.php">
            <i class="fas fa-truck-loading"></i>
            <span>Data Pengiriman</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="daftar_penugasan.php">
            <i class="fas fa-tasks"></i>
            <span>Detail Order</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="data_tarif.php">
            <i class="fas fa-credit-card"></i>
            <span>Tarif Ongkir</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="data_kurir.php">
            <i class="fas fa-motorcycle"></i>
            <span>Data Kurir</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <?php if ($_SESSION['level'] === 'admin'): ?>
    <!-- Menu tambahan khusus admin -->
    <li class="nav-item">
        <a class="nav-link" href="data_wilayah.php">
            <i class="fas fa-map-marked-alt"></i>
            <span>Data Wilayah</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="akun_pengguna.php">
            <i class="fas fa-users-cog"></i>
            <span>Akun Pengguna</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="laporan_pengiriman.php">
            <i class="fas fa-file-alt"></i>
            <span>Laporan</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="pengaturan.html">
            <i class="fas fa-cogs"></i>
            <span>Pengaturan</span></a>
    </li>
    <?php endif; ?>
</ul>
<!-- End of Sidebar -->