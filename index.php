<?php
session_start();
if (isset($_SESSION['username'])) {
  header("Location: home.php"); // kalau sudah login, langsung ke home
  exit;
}
include "koneksi.php";

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['password'] === md5($password)) {
      $_SESSION['username'] = $username;
      header("Location: home.php");
      exit;
    } else {
      $error = "Password salah!";
    }
  } else {
    $error = "Username tidak ditemukan!";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - KAI Mini</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="container">
    <div class="form-box">
      <h2>Login KAI Mini</h2>
      <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
      <form method="POST" action="">
        <label>Username</label>
        <input type="text" name="username" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit" class="btn">Login</button>
      </form>
      <p style="margin-top:10px;">
        Belum punya akun? <a href="register.php">Register</a>
      </p>
    </div>
  </div>
</body>
</html>

