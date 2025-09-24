<?php
session_start();
include "koneksi.php";


$asal       = $_POST['asal']       ?? '';
$tujuan     = $_POST['tujuan']     ?? '';
$tanggal    = $_POST['tanggal']    ?? '';
$penumpang  = $_POST['penumpang']  ?? '';
$harga      = $_POST['harga_numeric'] ?? '';


if ($asal === '' || $tujuan === '' || $tanggal === '' || $penumpang === '' || $harga === '') {
    echo "<script>
        alert('Semua field wajib diisi!');
        window.location.href='index.php';
    </script>";
    exit;
}


if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $tanggal)) {
    echo "<script>
        alert('Format tanggal tidak valid!');
        window.location.href='index.php';
    </script>";
    exit;
}


$kode_booking = strtoupper(substr($asal,0,2) . substr($tujuan,0,2)) . rand(1000,9999);


$stmt = $conn->prepare("INSERT INTO pesanan (kode_booking, asal, tujuan, tanggal, penumpang, harga) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssii", $kode_booking, $asal, $tujuan, $tanggal, $penumpang, $harga);
$success = $stmt->execute();
?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <div class = "DetailP">
<?php if ($success): ?>
  <script>
    Swal.fire({
      icon: "success",
      title: "Pesanan Berhasil!",
      
      html: `
        <b>Kode Booking:</b> <?= $kode_booking; ?><br>
        <b>Asal:</b> <?= htmlspecialchars($asal); ?><br>
        <b>Tujuan:</b> <?= htmlspecialchars($tujuan); ?><br>
        <b>Tanggal:</b> <?= htmlspecialchars($tanggal); ?><br>
        <b>Penumpang:</b> <?= htmlspecialchars($penumpang); ?><br>
        <b>Total Harga:</b> Rp <?= number_format($harga,0,',','.'); ?>
      `,
      confirmButtonText: "Lihat Pesanan"
    }).then(() => {
      window.location.href = "pesanan.php";
    });
  </script>
<?php else: ?>
  </div>
  <script>
    Swal.fire({
      icon: "error",
      title: "Gagal!",
      text: "Pesanan tidak bisa diproses"
    }).then(() => {
      window.location.href = "index.php";
    });
  </script>
<?php endif; ?>
</body>
</html>
