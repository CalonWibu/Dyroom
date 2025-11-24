<?php
include '../koneksi/db.php';
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: ../login-system/login.php");
    exit();
}

$email = $_SESSION["email"];
$nama = $_SESSION["nama"]; // Pastikan session nama ada
$query = $conn->query("SELECT * FROM users WHERE email='$email'");
$user = $query->fetch_assoc();

if ($user['admin'] != 1) {
    header("Location: ../index.php/?url=akun");
    exit();
}

$url = $_GET['url'] ?? 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    /* --- RESET & BASIC --- */
    body {
      margin: 0;
      overflow: hidden; /* Default hidden untuk intro */
      background: #f4f6f9; /* Background sedikit abu-abu biar modern */
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* --- VIDEO INTRO --- */
    #intro {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      object-fit: cover;
      z-index: 9999;
      background: black;
    }

    /* --- SIDEBAR --- */
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
    .sidebar.show { left: 0; }
    .sidebar a {
      color: #ccc;
      text-decoration: none;
      display: block;
      margin: 15px 0;
      font-size: 16px;
      transition: 0.2s;
    }
    .sidebar a:hover {
      color: #f5b800;
      transform: translateX(5px);
    }

    /* --- MAIN CONTENT (FIXED LAYOUT) --- */
    .main {
      margin-left: 220px;
      min-height: 100vh;
      
      /* PERBAIKAN: Menggunakan display block dan padding agar konten turun */
      display: block; 
      padding: 30px; 
      padding-top: 50px; /* Jarak dari atas agar tidak mentok */
      
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 1s ease, transform 1s ease;
      box-sizing: border-box;
    }
    .main.show {
      opacity: 1;
      transform: translateY(0);
    }

    h2 { color: #ff2bea; font-weight: bold; }

    /* --- CSS TABEL (CARD STYLE) --- */
    /* Dipasang di sini agar bisa dipakai di listO.php */
    .table-wrapper {
      background: #ffffff;
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
      margin-top: 20px;
    }
    .table-title {
      font-weight: bold; color: #333; margin-bottom: 20px;
      border-left: 5px solid #ff2bea; padding-left: 15px;
    }
    .custom-table { width: 100%; border-collapse: separate; border-spacing: 0 10px; }
    .custom-table thead th {
      background-color: #333; color: #fff; padding: 15px; border: none;
    }
    .custom-table thead th:first-child { border-radius: 10px 0 0 10px; }
    .custom-table thead th:last-child { border-radius: 0 10px 10px 0; }
    .custom-table tbody tr {
      background-color: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.02); transition: 0.3s;
    }
    .custom-table tbody tr:hover {
      transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .custom-table td { padding: 15px; vertical-align: middle; border-bottom: 1px solid #f0f0f0; }
    .price-tag { font-weight: bold; color: #ff2bea; }
    .email-text { font-size: 0.85rem; color: #888; }
  </style>
</head>
<body>
  
  <video id="intro" muted playsinline>
    <source src="intro.mp4" type="video/mp4">
  </video>

  <div class="sidebar" id="sidebar">
    <img src="../asset/Logo.png" alt="DYROOM" width="100%" style="cursor: pointer; margin-bottom: 20px;" onclick="window.location.href='../?url=home'">
    <hr style="border-color: #555;">
    <a href="?url=dashboard">Dashboard</a>
    <a href="?url=listO">List Order</a>
    <a href="?url=add">Mobil Baru</a>
    <hr style="border-color: #555;">
    <a href="../logout.php">Logout</a>
  </div>

  <div class="main" id="main">
    <?php 
      if(isset($url)) {
            $url = rtrim($url, '/');
            $url = explode('/', $url);
            
            switch($url[0]) {
                case 'dashboard':
                    echo "<h2>Dashboard Overview</h2>";
                    echo "<p>Selamat datang kembali, <strong>" . htmlspecialchars($user['nama']) . "</strong>!</p>";
                    break;
                case 'add':
                      if(file_exists('pages/add.php')) require_once('pages/add.php');
                      else echo "<div class='alert alert-danger'>File pages/add.php tidak ditemukan.</div>";
                      break;
                case 'listO':
                      if(file_exists('pages/listO.php')) require_once('pages/listO.php');
                      else echo "<div class='alert alert-danger'>File pages/listO.php tidak ditemukan.</div>";
                      break;
                default:
                    echo "<h2>Selamat Datang</h2>";
                    break;
            }
        }
    ?>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const video = document.getElementById("intro");
        const sidebar = document.getElementById("sidebar");
        const main = document.getElementById("main");

        function showContent() {
            video.style.display = "none";
            sidebar.classList.add("show");
            main.classList.add("show");
            document.body.style.overflow = "auto";
        }

        if (localStorage.getItem("intro_played")) {
            showContent();
        } else {
            video.play().catch(e => {
                console.log("Autoplay blocked, showing content immediately.");
                showContent();
            });

            video.addEventListener("ended", () => {
                localStorage.setItem("intro_played", "true");
                showContent();
            });
        }
    });
  </script>
</body>
</html>