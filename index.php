<?php
session_start();
if (isset($_SESSION['username'])) {
  header("Location: home.php"); 
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
    if ($row['password'] === ($password)) {
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
    <div class="form-boxLog">
      <h2>Login KAI Mini</h2>
      <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
      <form method="post" autocomplete="off">
      <label>Username</label>
      <input type="text" name="username" autocomplete="new-username">

      <label>Password</label>
      <input type="password" name="password" autocomplete="new-password">

      <button type="submit">Login</button>
    </form>
      <p style="margin-top:10px;">
        Belum punya akun? <a href="register.php">Register</a>
      </p>
    </div>
  </div>
</body>
</html>

