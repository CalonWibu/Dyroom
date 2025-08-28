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

// Ambil daftar orders
$sql = "SELECT c.*, u.nama, u.email, m.nama_car, m.harga, m.seri, m.speed, m.energy 
        FROM personal c 
        JOIN users u ON c.id_pembeli = u.id
        JOIN mobil m ON c.id_mobil = m.id";
$orders = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    body { display: flex; }
    .sidebar {
      width: 220px;
      height: 100vh;
      background: #222;
      color: #fff;
      padding: 20px;
    }
    .sidebar a {
      color: #fff;
      text-decoration: none;
      display: block;
      margin: 10px 0;
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
      flex: 1;
      padding: 20px;
      height: 100vh;
      overflow-y: scroll;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <img src="../logo.png" alt="DYROOM" style="cursor: pointer; margin-bottom: 20px;" onclick="window.location.href='view.php'">
    <a href="admin1.php" style="transform: translateX(5px); color: #f5b800;">Dashboard</a>
    <a href="admin2.php">Mobil Baru</a>
    <a href="../logout.php">Logout</a>
  </div>
  <div class="main">
    <h2>Daftar Order</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nama User</th>
          <th>Email</th>
          <th>Mobil</th>
          <th>Jumlah</th>
          <th>Total Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $orders->fetch_assoc()) { ?>
        <tr>
          <td><?= htmlspecialchars($row['nama']); ?></td>
          <td><?= htmlspecialchars($row['email']); ?></td>
          <td><?= htmlspecialchars($row['nama_car']); ?></td>
          <td>1</td>
          <td>Rp<?= number_format($row['harga'], 0, ',', '.'); ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>
</html>
