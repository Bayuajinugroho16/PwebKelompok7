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
    <div class="form-boxPesan">
      <h2>Form Pemesanan Tiket</h2>
      <form action="proses.php" method="POST" onsubmit="return cekForm()">
        
        <label for="asal">Stasiun Asal:</label>
        <select id="asal" name="asal" onchange="hitungHarga()" required>
          <option value="">-- Pilih Asal --</option>
          <option value="Surabaya">Surabaya</option>
          <option value="Jember">Jember</option>
          <option value="Yogyakarta">Yogyakarta</option>
          <option value="Jakarta">Jakarta</option>
          <option value="Kalibaru">Kalibaru</option>
          <option value="Ketapang">Ketapang</option>
        </select>

        <label for="tujuan">Stasiun Tujuan:</label>
        <select id="tujuan" name="tujuan" onchange="hitungHarga()" required>
          <option value="">-- Pilih Tujuan --</option>
          <option value="Surabaya">Surabaya</option>
          <option value="Jember">Jember</option>
          <option value="Yogyakarta">Yogyakarta</option>
          <option value="Jakarta">Jakarta</option>
          <option value="Kalibaru">Kalibaru</option>
          <option value="Ketapang">Ketapang</option>
        </select>

        <label for="penumpang">Jumlah Penumpang:</label>
        <input type="number" id="penumpang" name="penumpang" value="1" min="1" onchange="hitungHarga()" required>

        <label for="tanggal">Tanggal Berangkat:</label>
        <input type="date" id="tanggal" name="tanggal" required>

        <label for="harga">Total Harga:</label>
        <input type="text" id="harga" readonly>
        <input type="hidden" id="harga_numeric" name="harga_numeric">

        <button type="submit">Pesan Tiket</button>
      </form>
    </div>
  </div>

  <script src="assets/script.js"></script>
</body>
</html>
