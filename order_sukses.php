<?php
// Ambil nomor resi dari parameter URL
$resi = isset($_GET['resi']) ? $_GET['resi'] : 'N/A';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Berhasil - Becat Kurir NTB</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
    body {
        background-color: #f8f9fa;
    }

    .card-success {
        border-left: 5px solid #198754;
        border-radius: 12px;
    }

    .resi-box {
        font-size: 1.5rem;
        padding: 10px 20px;
        background-color: #e7f1ff;
        border: 2px dashed #0d6efd;
        border-radius: 8px;
        display: inline-block;
        margin-top: 10px;
    }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow card-success">
                    <div class="card-body text-center">
                        <h2 class="text-success mb-3">✅ Order Berhasil Dikirim!</h2>
                        <p class="lead">Terima kasih telah menggunakan layanan <strong>Becat Kurir NTB</strong>.</p>
                        <p>Berikut adalah <strong>nomor resi</strong> pengiriman Anda:</p>

                        <div class="resi-box">
                            📦 <?= htmlspecialchars($resi) ?>
                        </div>

                        <p class="mt-4">Silakan simpan atau screenshot nomor resi ini untuk melacak pengiriman Anda.</p>
                        <a href="index.php" class="btn btn-warning mt-3">🔙 Kembali ke Beranda</a>

                        <a href="cetak_resi.php?resi=<?= urlencode($resi) ?>" target="_blank"
                            class="btn btn-outline-primary mt-2">🖨️ Cetak Resi</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>