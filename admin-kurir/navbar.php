  <?php
include 'config/koneksi.php';

// Cek apakah sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

// Query data kurir
$query = mysqli_query($conn, "SELECT * FROM tbl_user WHERE role = 'kurir'");
?>

<style>
/* DARK MODE */
body.dark-mode {
  background-color: #1e1e2f !important;
  color: #f1f1f1 !important;
}

.dark-mode .bg-white,
.dark-mode .card,
.dark-mode .container-fluid,
.dark-mode .content,
.dark-mode #content-wrapper,
.dark-mode .navbar,
.dark-mode .sidebar {
  background-color: #2a2a3b !important;
  color: #f1f1f1 !important;
}

.dark-mode .text-gray-800,
.dark-mode .text-gray-600 {
  color: #ddd !important;
}

.dark-mode .table,
.dark-mode .table-bordered,
.dark-mode .table td,
.dark-mode .table th {
  background-color: #2a2a3b !important;
  color: #fff !important;
  border-color: #444 !important;
}

.dark-mode .form-control,
.dark-mode .btn,
.dark-mode .custom-select {
  background-color: #3a3a4f !important;
  color: #fff !important;
  border: 1px solid #555;
}

.dark-mode .dropdown-menu {
  background-color: #343a40 !important;
  color: #fff;
}

.dark-mode .dropdown-item {
  color: #fff !important;
}

.dark-mode .dropdown-item:hover {
  background-color: #495057 !important;
  color: #fff !important;
}
</style>




  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
      </button>

      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">
          <!-- Nav Item - Search Dropdown (Visible Only XS) -->
          <li class="nav-item d-flex align-items-center mr-3">
  <div class="custom-control custom-switch">
    <input type="checkbox" class="custom-control-input" id="darkModeToggle">
    <label class="custom-control-label" for="darkModeToggle" style="cursor: pointer;">🌙</label>
  </div>
</li>

          <!-- Nav Item - Alerts -->
          

    

          <div class="topbar-divider d-none d-sm-block"></div>

          <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                      <?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Pengguna' ?>
                  </span>



                  <img class="img-profile rounded-circle" src="img/undraw_profile.svg" />
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="profil.php">
  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
  Profil Saya (<?= htmlspecialchars($_SESSION['nama']) ?>)
</a>
                  <!-- <a class="dropdown-item" href="pengaturan.php">
                      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                      Pengaturan
                  </a> -->
                  <a class="dropdown-item" href="riwayat.php">
                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                      Riwayat Aktivitas
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
</i>
  Keluar
</a>
              </div>
          </li>
      </ul>
  </nav>
  <!-- End of Topbar -->

  <script>
document.addEventListener('DOMContentLoaded', function () {
  const toggle = document.getElementById('darkModeToggle');
  const body = document.body;

  if (localStorage.getItem('darkMode') === 'enabled') {
    toggle.checked = true;
    body.classList.add('dark-mode');
  }

  toggle.addEventListener('change', function () {
    if (this.checked) {
      body.classList.add('dark-mode');
      localStorage.setItem('darkMode', 'enabled');
    } else {
      body.classList.remove('dark-mode');
      localStorage.setItem('darkMode', 'disabled');
    }
  });
});
</script>

