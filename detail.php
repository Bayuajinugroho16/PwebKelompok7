<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}
include "koneksi.php";

// Pastikan parameter ada
if (isset($_GET['kode_booking'])) {
  $kode_booking = $_GET['kode_booking'];

  // Gunakan prepared statement
  $stmt = mysqli_prepare($conn, "SELECT * FROM pesanan WHERE kode_booking = ? LIMIT 1");
  mysqli_stmt_bind_param($stmt, "s", $kode_booking);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) == 1) {
    $pesanan = mysqli_fetch_assoc($result);
  } else {
    die("Pesanan tidak ditemukan!");
  }

  mysqli_stmt_close($stmt);
} else {
  die("Kode booking tidak diberikan!");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Pesanan</title>
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
      <h2>Detail Pesanan</h2>
      <p><b>Kode Booking:</b> <?= htmlspecialchars($pesanan['kode_booking']); ?></p>
      <p><b>Asal:</b> <?= htmlspecialchars($pesanan['asal']); ?></p>
      <p><b>Tujuan:</b> <?= htmlspecialchars($pesanan['tujuan']); ?></p>
      <p><b>Tanggal:</b> <?= htmlspecialchars($pesanan['tanggal']); ?></p>
      <p><b>Penumpang:</b> <?= htmlspecialchars($pesanan['penumpang']); ?></p>
      <p><b>Total Harga:</b> Rp <?= number_format($pesanan['harga'], 0, ',', '.'); ?></p>
      <p><b>Waktu Pesan:</b> <?= htmlspecialchars($pesanan['created_at']); ?></p>
      <a href="pesanan.php" class="btn">Kembali ke Daftar</a>
    </div>
  </div>
</body>
</html>
