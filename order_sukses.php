<?php
// Ambil nomor resi dari parameter URL
$resi = isset($_GET['resi']) ? $_GET['resi'] : 'N/A';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Order Berhasil - Becat Kurir NTB</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Ganti sesuai path CSS kamu -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="card shadow border-0">
            <div class="card-body text-center">
                <h2 class="text-success mb-4">✅ Order Berhasil Dikirim!</h2>
                <p class="lead">Terima kasih telah menggunakan layanan <strong>Becat Kurir NTB</strong>.</p>
                <p>Berikut adalah nomor resi pengiriman Anda:</p>

                <div class="my-4">
                    <h4 class="fw-bold text-primary">📦 <?= htmlspecialchars($resi) ?></h4>
                </div>

                <p>Silakan simpan nomor resi ini untuk melacak status pengiriman Anda.</p>
                <a href="index.php" class="btn btn-warning mt-3">Kembali ke Beranda</a>
            </div>
        </div>
    </div>

</body>

</html>