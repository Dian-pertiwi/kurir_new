<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resi = trim(mysqli_real_escape_string($conn, $_POST['noResi']));

    $query = mysqli_query($conn, "
    SELECT 
        p.resi,
        p.waktu_konfirmasi,
        s.nama_status AS status_pengiriman,
        s.keterangan AS status_keterangan,
        r.nama_penerima,
        r.alamat_penerima
    FROM tbl_pengiriman_paket p
    LEFT JOIN tbl_status_order s ON p.id_status_order = s.id_status
    LEFT JOIN tbl_penerima r ON p.id_penerima = r.id_penerima
    WHERE p.resi = '$resi'
");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        $waktu_kirim = date('d M Y, H:i', strtotime($data['waktu_konfirmasi']));
        $alamatLengkap = $data['alamat_penerima'];

        echo json_encode([
            'success' => true,
            'data' => [
                'resi' => $data['resi'],
                'status' => $data['status_pengiriman'],
                'waktu_kirim' => $waktu_kirim,
                'lokasi' => $data['status_keterangan'] ?: '-',
                'nama_penerima' => $data['nama_penerima'] ?: '-',
                'alamat_penerima' => $data['alamat_penerima'] ?: '-'
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Nomor resi tidak ditemukan.']);
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cek Resi | Becat Kurir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa; padding-top: 60px;">

  <div class="container">
    <div class="text-center mb-4">
      <h2>Cek Resi Pengiriman</h2>
      <p class="text-muted">Masukkan nomor resi untuk melihat status paket Anda.</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-6">
      <form id="formCekResi" class="mb-4">
  <div class="mb-3">
    <label for="noResi" class="form-label">Nomor Resi</label>
    <input type="text" id="noResi" name="noResi" class="form-control" placeholder="Masukkan nomor resi Anda" required />
  </div>
  <button type="submit" class="btn btn-warning">Cek Resi</button>
</form>

<div id="hasilResi" class="mt-4"></div>
      </div>
    </div>
  </div>

  <script>
document.getElementById("formCekResi").addEventListener("submit", function (e) {
  e.preventDefault();

  const resi = document.getElementById("noResi").value;
  const formData = new FormData();
  formData.append("noResi", resi);

  fetch("cek_resi.php", {
    method: "POST",
    body: formData
  })
    .then((res) => res.json())
    .then((response) => {
      if (response.success) {
        const data = response.data;

        document.getElementById("hasilResi").innerHTML = `
          <div class="card p-3 shadow-sm rounded-3">
            <h5>Nomor Resi: <span class="text-primary">${data.resi}</span></h5>
            <ul class="list-unstyled mt-3 mb-0">
              <li><strong>Waktu Kirim:</strong> ${data.waktu_kirim}</li>
              <li><strong>Status:</strong> ${data.status}</li>
              <li><strong>Keterangan:</strong> ${data.lokasi}</li>
              <li><strong>Nama Penerima:</strong> ${data.nama_penerima}</li>
              <li><strong>Alamat Penerima:</strong> ${data.alamat_penerima}</li>
            </ul>
          </div>
        `;
      } else {
        document.getElementById("hasilResi").innerHTML = `
          <div class="alert alert-warning">${response.message}</div>
        `;
      }
    })
    .catch((error) => {
      document.getElementById("hasilResi").innerHTML = `
        <div class="alert alert-danger">Terjadi kesalahan saat memproses permintaan.</div>
      `;
      console.error("Cek Resi Error:", error);
    });
});
</script>


</body>
</html>
