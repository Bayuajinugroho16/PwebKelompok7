<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}
include "koneksi.php";


$asal = $_POST['asal'];
$tujuan = $_POST['tujuan'];
$tanggal = $_POST['tanggal'];
$penumpang = $_POST['penumpang'];
$harga = $_POST['harga_numeric'];

$kode_booking = strtoupper(substr($asal,0,2).substr($tujuan,0,2)).rand(1000,9999);


$query = "INSERT INTO pesanan (kode_booking, asal, tujuan, tanggal, penumpang, harga) 
          VALUES ('$kode_booking', '$asal', '$tujuan', '$tanggal', '$penumpang', '$harga')";
mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pesanan Berhasil</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="navbar">
    <div><b>KAI Mini</b></div>
    <div class="nav-links">
      <a href="index.php">Beranda</a>
      <a href="pesanan.php">Pesanan</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <div class="container">
    <div class="form-box" style="max-width:500px; text-align:center;">
      <h2>Pesanan Berhasil!</h2>
      <p><b>Kode Booking:</b> <?php echo $kode_booking; ?></p>
      <p><b>Asal:</b> <?php echo $asal; ?></p>
      <p><b>Tujuan:</b> <?php echo $tujuan; ?></p>
      <p><b>Tanggal:</b> <?php echo $tanggal; ?></p>
      <p><b>Penumpang:</b> <?php echo $penumpang; ?></p>
      <p><b>Total Harga:</b> Rp <?php echo number_format($harga,0,',','.'); ?></p>

      <a href="pesanan.php" class="btn">Lihat Daftar Pesanan</a>
    </div>
  </div>
</body>
</html>