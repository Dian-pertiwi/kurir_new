<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header('Location: user_login.php');
    exit;
}

$id_user = $_SESSION['id_user'];
$error = null;
$success = null;

// Ambil data user
$result_user = mysqli_query($conn, "SELECT * FROM tbl_user WHERE id_user = $id_user");
$user = mysqli_fetch_assoc($result_user);

// Ambil data pengirim jika sudah ada
$result_pengirim = mysqli_query($conn, "SELECT * FROM tbl_pengirim WHERE id_user = $id_user LIMIT 1");
$pengirim = mysqli_fetch_assoc($result_pengirim);
$id_pengirim = $pengirim['id_pengirim'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = trim(mysqli_real_escape_string($conn, $_POST['nama']));
    $username = trim(mysqli_real_escape_string($conn, $_POST['username']));
    $password = trim($_POST['password']);

    $nama_pengirim    = trim(mysqli_real_escape_string($conn, $_POST['nama_pengirim']));
    $kec_pengirim     = trim(mysqli_real_escape_string($conn, $_POST['kec_pengirim']));
    $alamat_pengirim  = trim(mysqli_real_escape_string($conn, $_POST['alamat_pengirim']));
    $hp_pengirim      = trim(mysqli_real_escape_string($conn, $_POST['hp_pengirim']));
    $no_rekening      = trim(mysqli_real_escape_string($conn, $_POST['no_rekening']));

    if ($nama === '' || $username === '') {
        $error = "Nama dan username wajib diisi.";
    } else {
        // Update data user
        if ($password === '') {
            $query_user = "UPDATE tbl_user SET nama='$nama', username='$username' WHERE id_user=$id_user";
        } else {
            $hashed = md5($password);
            $query_user = "UPDATE tbl_user SET nama='$nama', username='$username', password='$hashed' WHERE id_user=$id_user";
        }

        $update_user = mysqli_query($conn, $query_user);

        // Update atau insert data pengirim
        if ($id_pengirim) {
            $query_pengirim = "
                UPDATE tbl_pengirim SET 
                    nama_pengirim='$nama_pengirim',
                    kec_pengirim='$kec_pengirim',
                    alamat_pengirim='$alamat_pengirim',
                    hp_pengirim='$hp_pengirim',
                    no_rekening='$no_rekening'
                WHERE id_pengirim = $id_pengirim
            ";
        } else {
            $query_pengirim = "
                INSERT INTO tbl_pengirim (id_user, nama_pengirim, kec_pengirim, alamat_pengirim, hp_pengirim, no_rekening)
                VALUES ($id_user, '$nama_pengirim', '$kec_pengirim', '$alamat_pengirim', '$hp_pengirim', '$no_rekening')
            ";
        }

        $update_pengirim = mysqli_query($conn, $query_pengirim);

        if ($update_user && $update_pengirim) {
            $_SESSION['nama'] = $nama;
            $_SESSION['username'] = $username;
            $success = "Profil berhasil diperbarui.";
        } else {
            $error = "Gagal memperbarui profil. Coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Ubah Profil | Becat Kurir NTB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Nunito', sans-serif;
      background: linear-gradient(135deg, #ffa94d, #ff6f0f);
      margin: 0;
      padding: 0;
      display: flex;
      height: auto;
      align-items: center;
      justify-content: center;
      padding-top: 30px;
    }

    .container {
      background: white;
      padding: 2rem;
      border-radius: 12px;
      width: 100%;
      max-width: 600px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
      margin-bottom: 40px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #ff6f0f;
    }

    input[type="text"], input[type="password"] {
      padding: 12px;
      width: 100%;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
    }

    button {
      background: #ff6f0f;
      color: white;
      font-size: 1rem;
      padding: 12px;
      width: 100%;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
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
  <div class="container">
    <h2>Ubah Profil Pengguna</h2>

    <?php if ($error): ?>
      <div class="alert error"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
      <div class="alert success"><?= $success ?></div>
    <?php endif; ?>

    <form method="post" action="">
      <input type="text" name="nama" value="<?= htmlspecialchars($user['nama']) ?>" placeholder="Nama lengkap" required>
      <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password baru (kosongkan jika tidak diubah)">

      <hr>
      <h4>Data Pengirim</h4>
      <input type="text" name="nama_pengirim" value="<?= htmlspecialchars($pengirim['nama_pengirim'] ?? '') ?>" placeholder="Nama Pengirim" required>
      <input type="text" name="kec_pengirim" value="<?= htmlspecialchars($pengirim['kec_pengirim'] ?? '') ?>" placeholder="Kecamatan Pengirim" required>
      <input type="text" name="alamat_pengirim" value="<?= htmlspecialchars($pengirim['alamat_pengirim'] ?? '') ?>" placeholder="Alamat Lengkap" required>
      <input type="text" name="hp_pengirim" value="<?= htmlspecialchars($pengirim['hp_pengirim'] ?? '') ?>" placeholder="No. HP Pengirim" required>
      <input type="text" name="no_rekening" value="<?= htmlspecialchars($pengirim['no_rekening'] ?? '') ?>" placeholder="No. Rekening" required>

      <button type="submit">Simpan Perubahan</button>
    </form>

    <div class="back-link">
      <a href="user_dashboard.php">← Kembali ke Dashboard</a>
    </div>
  </div>
</body>
</html>
