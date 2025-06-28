<?php
session_start();
include 'koneksi.php';

$error = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil input dengan aman
    $username = trim(mysqli_real_escape_string($conn, $_POST['username']));
    $password = trim($_POST['password']);
    $nama     = trim(mysqli_real_escape_string($conn, $_POST['nama']));
  
    // Validasi kosong
    if ($username === '' || $password === '' || $nama === '') {
      $error = "Semua field wajib diisi.";
    } elseif (strlen($password) < 6) {
      $error = "Password minimal 6 karakter.";
    } else {
      // Cek duplikat username
      $check = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username = '$username'");
      if (mysqli_num_rows($check) > 0) {
        $error = "Username sudah terdaftar.";
      } else {
        // Simpan ke database
        $hashed = md5($password);
        $insert = mysqli_query($conn, "
          INSERT INTO tbl_user (username, password, role, nama)
          VALUES ('$username', '$hashed', 'user', '$nama')
        ");
  
        if ($insert) {
            // Ambil ID user baru
            $id_user = mysqli_insert_id($conn);
          
            // Simpan session
            $_SESSION['id_user']   = $id_user;
            $_SESSION['username']  = $username;
            $_SESSION['nama']      = $nama;
            $_SESSION['level']     = 'user';
          
            // Log aktivitas
            $aktivitas = "Pendaftaran dan login pertama kali";
            mysqli_query($conn, "INSERT INTO tbl_log_aktivitas (id_user, aktivitas) VALUES ($id_user, '$aktivitas')");
          
            // Redirect ke dashboard user
            header("Location: user_dashboard.php");
            exit;
          }
          
      }
    }
  }
  
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Pengguna | Becat Kurir NTB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Font & Icon -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    * { box-sizing: border-box; }

    body {
      font-family: 'Nunito', sans-serif;
      background: linear-gradient(135deg, #ffa94d, #ff6f0f);
      margin: 0;
      padding: 0;
      display: flex;
      height: 100vh;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      background: white;
      padding: 2rem;
      border-radius: 12px;
      max-width: 420px;
      width: 100%;
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .login-container .logo {
      text-align: center;
      font-size: 2.5rem;
      color: #ff6f0f;
    }

    .login-container h2 {
      text-align: center;
      margin: 0.5rem 0 1rem;
      color: #333;
    }

    .login-container form {
      display: flex;
      flex-direction: column;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      padding: 12px;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
    }

    .login-container button {
      background: #ff6f0f;
      color: white;
      font-size: 1rem;
      padding: 12px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
    }

    .login-container button:hover {
      background: #e85c00;
    }

    .alert {
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 1rem;
      text-align: center;
    }

    .error { background: #ffe0e0; color: #c00; }
    .success { background: #e0ffe0; color: #007b00; }

    .back-link {
      text-align: center;
      margin-top: 1rem;
    }

    .back-link a {
      color: #555;
      text-decoration: none;
    }

    .back-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="logo">
      <i class="fas fa-shipping-fast"></i>
    </div>
    <h2>Daftar Akun Baru</h2>

    <?php if ($error): ?>
      <div class="alert error"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
      <div class="alert success"><?= $success ?></div>
    <?php endif; ?>

    <form method="post" action="daftar.php">
      <input type="text" name="nama" placeholder="Nama Lengkap" required>
      <input type="text" name="username" placeholder="Username" required>

      <input type="password" name="password" placeholder="Password" required>

      <button type="submit">Daftar</button>
    </form>

    <div class="back-link">
      <a href="user_login.php">← Sudah punya akun? Login</a>
    </div>
  </div>
</body>
</html>
