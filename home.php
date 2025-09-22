<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.php"); 
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pemesanan Tiket Kereta</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="navbar">
    <div><b>KAI Mini</b></div>
    <div class="nav-links">
      <a href="home.php">Beranda</a>
      <a href="pesanan.php">Pesanan</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <div class="container">
    <div class="form-box">
      <h2>Pemesanan Tiket</h2>
      <form action="proses.php" method="POST" onsubmit="return cekForm()">
        <label>Stasiun Asal</label>
        <select name="asal" id="asal" required onchange="hitungHarga()">
          <option value="">-- Pilih --</option>
          <option>Surabaya</option>
          <option>Kalibaru</option>
          <option>Ketapang</option>
          <option>Rogojampi</option>
          <option>Setail</option>
          <option>Jember</option>
          <option>Rambipuji</option>
          <option>Jatiroto</option>
          <option>Klakah</option>
          <option>Gubeng</option>
          <option>Yogyakarta</option>
          <option>Jakarta</option>
        </select>

        <label>Stasiun Tujuan</label>
        <select name="tujuan" id="tujuan" required onchange="hitungHarga()">
          <option value="">-- Pilih --</option>
          <option>Surabaya</option>
          <option>Kalibaru</option>
          <option>Ketapang</option>
          <option>Rogojampi</option>
          <option>Setail</option>
          <option>Jember</option>
          <option>Rambipuji</option>
          <option>Jatiroto</option>
          <option>Klakah</option>
          <option>Gubeng</option>
          <option>Yogyakarta</option>
          <option>Jakarta</option>
        </select>

        <label>Tanggal Berangkat</label>
        <input type="date" name="tanggal" id="tanggal" required>

        <label>Jumlah Penumpang</label>
        <input type="number" name="penumpang" min="1" value="1" oninput="hitungHarga()">

        <label>Estimasi Harga</label>
        <input type="text" name="harga" id="harga" readonly>
        <input type="hidden" name="harga_numeric" id="harga_numeric">

        <button type="submit" class="btn">Pesan & Cari Kereta</button>
      </form>
    </div>
  </div>

  <script src="assets/script.js"></script>
</body>
</html>