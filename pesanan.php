<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}
include "koneksi.php";

$result = mysqli_query($conn, "SELECT * FROM pesanan ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Pesanan</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  
 
  <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="#">KAI Mini</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link active" href="pesanan.php">Pesanan</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  
  <div class="container mt-4">
    <div class="card shadow">
      <div class="card-body">
        <h2 class="text-center mb-4">Daftar Pesanan</h2>
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover align-middle text-center">
            <thead class="table-danger">
              <tr>
                <th>Kode Booking</th>
                <th>Asal</th>
                <th>Tujuan</th>
                <th>Tanggal</th>
                <th>Penumpang</th>
                <th>Harga</th>
                <th>Waktu Pesan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                  <td><?= htmlspecialchars($row['kode_booking']); ?></td>
                  <td><?= htmlspecialchars($row['asal']); ?></td>
                  <td><?= htmlspecialchars($row['tujuan']); ?></td>
                  <td><?= htmlspecialchars($row['tanggal']); ?></td>
                  <td><?= htmlspecialchars($row['penumpang']); ?></td>
                  <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                  <td><?= htmlspecialchars($row['created_at']); ?></td>
                  <td>
                    <a href="detail.php?kode_booking=<?= urlencode($row['kode_booking']); ?>" 
                       class="btn btn-sm btn-primary">
                       Lihat Detail
                    </a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php mysqli_close($conn); ?>
</body>
</html>