<?php
session_start();
include 'koneksi.php';

$error = null;

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $_SESSION['id_user']   = $data['id_user'];
        $_SESSION['username']  = $data['username'];
        $_SESSION['nama']      = $data['nama'];
        $_SESSION['level']     = $data['role'];

        $id_user = (int) $data['id_user'];
        $aktivitas = "Login ke sistem sebagai user";
        mysqli_query($conn, "INSERT INTO tbl_log_aktivitas (id_user, aktivitas) VALUES ($id_user, '$aktivitas')");

        if (isset($_POST['remember'])) {
            setcookie('username', $username, time() + (86400 * 30), "/");
        }

        header("Location: user_dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Login Pengguna | Becat Kurir NTB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Font & Icon -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * {
      box-sizing: border-box;
    }

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

    .login-container input[type="checkbox"] {
      margin-right: 8px;
    }

    .login-container .remember {
      font-size: 0.9rem;
      margin-bottom: 1rem;
    }

    .login-container button {
      background: #ff6f0f;
      color: white;
      font-size: 1rem;
      padding: 12px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s ease;
      font-weight: bold;
    }

    .login-container button:hover {
      background: #e85c00;
    }

    .login-container .error {
      background: #ffe0e0;
      color: #c00;
      padding: 10px;
      margin-bottom: 1rem;
      text-align: center;
      border-radius: 6px;
    }

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
    <h2>Becat Kurir NTB</h2>

    <?php if ($error): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post" action="user_login.php">
      <input type="text" name="username" placeholder="Username" required
        value="<?= $_COOKIE['username'] ?? '' ?>">

        <div style="position: relative; width: 100%; max-width: 400px;">
  <input
    type="password"
    name="password"
    id="passwordInput"
    placeholder="Password"
    required
    style="width: 100%; padding-right: 40px; padding: 12px 16px; border-radius: 6px; border: 1px solid #ccc; font-size: 16px; height: 45px;"
  >

  <!-- Eye Icon -->
  <i id="togglePassword"
     class="fas fa-eye"
     style="position: absolute; top: 50%; right: 12px; transform: translateY(-50%); cursor: pointer; color: #666;"></i>
</div>


      <label class="remember">
        <input type="checkbox" name="remember" <?= isset($_COOKIE['username']) ? 'checked' : '' ?>> Ingat saya
      </label>

      <button type="submit" name="login">Login</button>
    </form>

    <div class="back-link">
      <a href="index.php">← Kembali ke beranda</a>
    </div>
  </div>

  <script>
  const toggle = document.getElementById("togglePassword");
  const password = document.getElementById("passwordInput");

  toggle.addEventListener("click", () => {
    const isHidden = password.type === "password";
    password.type = isHidden ? "text" : "password";
    toggle.classList.toggle("fa-eye");
    toggle.classList.toggle("fa-eye-slash");
  });
</script>



</body>
</html>
