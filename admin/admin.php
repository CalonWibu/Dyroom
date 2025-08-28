<?php
include '../koneksi/db.php';
session_start();

// Cek apakah user login
if (!isset($_SESSION["email"])) {
    header("Location: ../login-system/login.php");
    exit();
}

// Ambil data user dari database
$email = $_SESSION["email"];
$query = $conn->query("SELECT * FROM users WHERE email='$email'");
$user = $query->fetch_assoc();

$nama = $_SESSION["nama"];

// Cek apakah admin
if ($user['admin'] != 1) {
    header("Location: ../akun.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    body {
      margin: 0;
      overflow: hidden;
      background: #ffffffff;
    }

    .main {
      overflow: hidden;

    }

    /* Video full layar */
    #intro {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      object-fit: cover;
      z-index: 9999;
    }

    .sidebar {
      width: 220px;
      height: 100vh;
      background: #222;
      color: #fff;
      padding: 20px;
      position: fixed;
      left: -220px;
      top: 0;
      transition: left 0.6s ease;
      z-index: 10;
    }

    .sidebar.show {
      left: 0;
    }

    .sidebar a {
      color: #fff;
      text-decoration: none;
      display: block;
      margin: 10px 0;
      font-size: 18px;
      transition: 0.1s ease-in-out;
    }

    .sidebar a:hover {
      color: #f5b800;
      transform: translateX(5px);
    }

    .main {
      margin-left: 220px;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 1s ease, transform 1s ease;
    }

    .main.show {
      opacity: 1;
      transform: translateY(0);
    }

    h2 {
      color: #ff2bea;
      font-size: 2.5rem;
    }
  </style>
</head>
<body>
  <!-- Video Intro -->
  <video id="intro" autoplay muted playsinline>
    <source src="intro.mp4" type="video/mp4">
  </video>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <img src="../logo.png" alt="DYROOM" style="cursor: pointer; margin-bottom: 20px;" onclick="window.location.href='view.php'">
    <a href="admin1.php">Dashboard</a>
    <a href="admin2.php">Mobil Baru</a>
    <a href="../logout.php">Logout</a>
  </div>

  <!-- Main -->
  <div class="main" id="main">
    <h2>Halo, <?= $user['nama']; ?>!</h2>
  </div>

  <script>
    // Setelah 5 detik
    setTimeout(() => {
      document.getElementById("intro").style.display = "none"; // sembunyikan video
      document.getElementById("sidebar").classList.add("show"); // munculkan sidebar
      document.getElementById("main").classList.add("show"); // munculkan main
      document.body.style.overflow = "auto"; // aktifkan scroll kembali
    }, 5000);
  </script>
</body>
</html>
