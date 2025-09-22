<?php
session_start();
include "koneksi.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $confirm  = trim($_POST['confirm']);

  if ($password !== $confirm) {
    $message = "❌ Password dan konfirmasi tidak sama!";
  } else {
    // hash password
    $hashed = md5($password);

    // cek apakah username sudah ada
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' LIMIT 1");
    if (mysqli_num_rows($check) > 0) {
      $message = "⚠️ Username sudah dipakai!";
    } else {
      $insert = mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$hashed')");
      if ($insert) {
        $message = "✅ Registrasi berhasil, silakan login.";
      } else {
        $message = "❌ Gagal registrasi: " . mysqli_error($conn);
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register - KAI Mini</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="container">
    <div class="form-box" style="max-width:350px; text-align:center;">
      <h2>Register Akun</h2>
      <?php if ($message) echo "<p style='color:red;'>$message</p>"; ?>
      <form method="POST" action="">
        <label>Username</label>
        <input type="text" name="username" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <label>Konfirmasi Password</label>
        <input type="password" name="confirm" required>
        <button type="submit" class="btn">Daftar</button>
      </form>
      <p style="margin-top:10px;">Sudah punya akun? <a href="index.php">Login</a></p>
    </div>
  </div>
</body>
</html>