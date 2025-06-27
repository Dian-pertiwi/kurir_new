<?php
session_start();
include 'config/koneksi.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
    $password = isset($_POST['password']) ? md5($_POST['password']) : '';

    $query = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'");

    if (!$query) {
        die('Query error: ' . mysqli_error($conn));
    }

    $data = mysqli_fetch_assoc($query);

    if ($data) {
        // Simpan ke session
        $_SESSION['id_user']   = $data['id_user'];
        $_SESSION['username']  = $data['username'];
        $_SESSION['nama']      = $data['nama'];
        $_SESSION['level']     = $data['role'];

        // ✅ Simpan log aktivitas setelah login sukses
        $id_user = (int) $data['id_user'];
        $aktivitas = "Login ke sistem";
        mysqli_query($conn, "INSERT INTO tbl_log_aktivitas (id_user, aktivitas) VALUES ($id_user, '$aktivitas')");

        // Remember Me
        if (isset($_POST['remember'])) {
            setcookie('username', $username, time() + (86400 * 30), "/");
        } else {
            setcookie('username', '', time() - 3600, "/");
        }

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Becat Kurir - Login</title>

    <!-- Fonts & CSS -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">

                    <div class="card-body p-0">
                        <!-- Nested Row -->
                        <div class="row">
    <!-- Logo -->
    <div class="col-lg-6 d-flex flex-column align-items-center justify-content-center text-primary bg-white">
    <i class="fas fa-shipping-fast fa-7x mb-3"></i>
    <h4 class="font-weight-bold text-dark">Becat Kurir</h4>
</div>

    <!-- Form Login -->
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Login Portal</h1>
            </div>

            <!-- Form -->
            <form method="post" action="login.php" class="user">

                <?php if ($error): ?>
                    <div class="alert alert-danger text-center">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <input type="text" name="username"
                        value="<?= $_COOKIE['username'] ?? '' ?>"
                        class="form-control form-control-user"
                        placeholder="Enter username" required>
                </div>

                <div class="form-group position-relative">
    <input type="password" name="password" id="password"
        class="form-control form-control-user pr-5"
        placeholder="Password" required>

    <span toggle="#password" class="fas fa-eye toggle-password position-absolute"
        style="top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; color: #aaa;"></span>
</div>


                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck"
                            name="remember" <?= isset($_COOKIE['username']) ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customCheck">
                            Remember Me
                        </label>
                    </div>
                </div>

                <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                    Login
                </button>

            </form>

            <hr>
        </div>
    </div>
</div>

                    </div>

                </div>
            </div>

        </div>

    </div>

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.querySelector('.toggle-password');
    const input = document.querySelector('#password');

    toggle.addEventListener('click', function () {
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
});
</script>

</body>

</html>
