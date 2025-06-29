<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: user_login.php");
    exit;
}

include 'koneksi.php';

$id_user = $_SESSION['id_user'];
$query = mysqli_query($conn, "SELECT * FROM tbl_pengirim WHERE id_user = $id_user");
$data_pengirim = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Pengguna | Becat Kurir NTB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: 'Nunito', sans-serif;
      background: linear-gradient(135deg, #ffa94d, #ff6f0f);
      color: #333;
    }
    header {
      background: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px solid #eee;
    }
    .brand {
      font-size: 1.5rem;
      color: #ff6f0f;
      font-weight: bold;
    }
    nav a {
      margin-left: 20px;
      text-decoration: none;
      color: #555;
      font-weight: bold;
    }
    nav a:hover { color: #ff6f0f; }
    .dropdown {
      position: relative;
    }
    .dropdown span {
      font-weight: bold;
      cursor: pointer;
    }
    .dropdown-content {
      position: absolute;
      top: 30px;
      right: 0;
      background: white;
      border: 1px solid #ccc;
      padding: 8px;
      display: none;
      z-index: 999;
    }
    .dropdown:hover .dropdown-content {
      display: block;
    }
    .dropdown-content a {
      display: block;
      text-decoration: none;
      color: #333;
      margin-bottom: 5px;
    }
    .section {
      padding: 60px 20px;
      max-width: 800px;
      margin: auto;
      background: white;
      border-radius: 10px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      margin-top: 40px;
    }
    .section h2 {
      text-align: center;
      color: #ff6f0f;
      margin-bottom: 20px;
    }
    .profile-box {
      padding: 25px;
      background: #f9f9f9;
      border-radius: 8px;
      line-height: 1.7;
    }
    .btn-primary {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 20px;
      background: #ff6f0f;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      text-decoration: none;
      text-align: center;
    }
    .btn-primary:hover {
      background: #e85c00;
    }
    footer {
      text-align: center;
      margin-top: 60px;
      color: #eee;
    }
    @media (max-width: 768px) {
      header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }
      nav {
        display: flex;
        flex-direction: column;
        gap: 5px;
      }
    }


    .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-toggle {
    cursor: pointer;
    font-weight: bold;
  }

  .dropdown-content {
    position: absolute;
    top: 30px;
    right: 0;
    background: white;
    border: 1px solid #ccc;
    padding: 8px;
    display: none;
    z-index: 999;
    border-radius: 6px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  }

  .dropdown-content a {
    display: block;
    text-decoration: none;
    color: #333;
    margin-bottom: 5px;
  }

  .dropdown.show .dropdown-content {
    display: block;
  }

  </style>
</head>

<body>

<header>
  <div class="brand"><i class="fas fa-shipping-fast"></i> Becat Kurir</div>
  <nav><a href="index.php">Home</a></nav>

  <div class="dropdown" id="userDropdown">
    <span class="dropdown-toggle">Hi, <?= htmlspecialchars($_SESSION['nama']) ?></span>
    <div class="dropdown-content">
      <a href="logout.php">Logout</a>
    </div>
  </div>
</header>

  <div class="section">
    <h2>Dashboard Pengguna</h2>
    <p style="text-align: center; font-size: 1.1rem;">
      Selamat datang di dashboard pengguna Becat Kurir NTB. Di bawah ini adalah ringkasan profil akun Anda.
    </p>

    <div class="profile-box">
      <p><strong>Nama Akun:</strong> <?= htmlspecialchars($_SESSION['nama']) ?></p>
      <p><strong>Username:</strong> <?= htmlspecialchars($_SESSION['username']) ?></p>
      <p><strong>Role:</strong> <?= htmlspecialchars($_SESSION['level']) ?></p>
      <?php if ($data_pengirim): ?>
        <hr>
        <p><strong>Nama Pengirim:</strong> <?= htmlspecialchars($data_pengirim['nama_pengirim']) ?></p>
        <p><strong>Kecamatan:</strong> <?= htmlspecialchars($data_pengirim['kec_pengirim']) ?></p>
        <p><strong>Alamat Pengirim:</strong> <?= htmlspecialchars($data_pengirim['alamat_pengirim']) ?></p>
        <p><strong>No. HP:</strong> <?= htmlspecialchars($data_pengirim['hp_pengirim']) ?></p>
        <p><strong>No. Rekening:</strong> <?= htmlspecialchars($data_pengirim['no_rekening']) ?></p>
      <?php else: ?>
        <p style="color: #999;">Data pengirim belum tersedia.</p>
      <?php endif; ?>
    </div>

    <div style="text-align: center;">
      <a href="ubah_profil.php" class="btn btn-primary">Ubah Profil</a>
    </div>
  </div>

  <footer>&copy; <?= date('Y') ?> Becat Kurir NTB</footer>


  <script>
  const dropdown = document.getElementById("userDropdown");

  document.addEventListener("click", function (e) {
    if (dropdown.contains(e.target)) {
      dropdown.classList.toggle("show");
    } else {
      dropdown.classList.remove("show");
    }
  });
</script>

</body>
</html>
