<?php
include '../koneksi/db.php';
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: login-system/login.php");
    exit();
}

$email = $_SESSION["email"];
$query = $conn->query("SELECT * FROM users WHERE email='$email'");
$user = $query->fetch_assoc();

// biar kalau bukan admin langsung ke halaman akun
if ($user['admin'] != 1) {
    header("Location: ../akun.php");
    exit();
}


if (isset($_POST['submit'])) {
    $nama   = $_POST['nama_car'];
    $seri   = $_POST['seri'];
    $harga  = $_POST['harga'];
    $speed  = $_POST['speed'];
    $energy = $_POST['energy'];
    $tipe   = $_POST['tipe'];
    $deskripsi = $_POST['deskripsi'];

    $fileName1 = $_FILES['gambar']['name'];
    $tmpName1  = $_FILES['gambar']['tmp_name'];

    $fileName2 = $_FILES['gambar_detail']['name'];
    $tmpName2  = $_FILES['gambar_detail']['tmp_name'];

    $targetDir = "../asset/mobil/";
    $targetFile1 = $targetDir . basename($fileName1);
    $targetFile2 = $targetDir . basename($fileName2);

    if (move_uploaded_file($tmpName1, $targetFile1) && move_uploaded_file($tmpName2, $targetFile2)) {
        $conn->query("INSERT INTO mobil (nama_car, harga, speed, energy, seri, tipe, img_car, img_car_detail, deskripsi) 
                      VALUES ('$nama', '$harga', '$speed', '$energy', '$seri', '$tipe', '$fileName1', '$fileName2', '$deskripsi')");
        $success = "Mobil berhasil ditambahkan!";
    } else {
        $error = "Gagal upload gambar!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Mobil</title>
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
      font-size: 18px;
      transition: 0.1s ease-in-out;
    }

    .sidebar a:hover {
      color: #f5b800;
      transform: translateX(5px);
    }
    .main { flex: 1; padding: 20px;  height: 100vh; overflow-y: scroll;}
  </style>
</head>
<body>
  <div class="sidebar">
        <img src="../logo.png" alt="DYROOM" style="cursor: pointer; margin-bottom: 20px;" onclick="window.location.href='view.php'">

    <a href="admin1.php">Dashboard</a>
    <a href="admin2.php" style="transform: translateX(5px); color: #f5b800;">Mobil Baru</a>
    <a href="../logout.php">Logout</a>
  </div>
  <div class="main">
    <h2>Tambah Mobil Baru</h2>
    <?php if(isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Nama Mobil</label>
        <input type="text" name="nama_car" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Harga</label>
        <input type="number" name="harga" class="form-control" required>
      </div>
     <div class="mb-3">
  <label class="form-label">Speed</label>
  <input type="text" name="speed" class="form-control" required>
</div>
<div class="mb-3">
  <label class="form-label">Energy</label>
  <input type="text" name="energy" class="form-control" required>
</div>
<div class="mb-3">
  <label class="form-label">Seri</label>
  <input type="text" name="seri" class="form-control" required>
</div>
<div class="mb-3">
  <label class="form-label">Tipe</label>
  <input type="text" name="tipe" class="form-control" required>
</div>
<div class="mb-3">
  <label class="form-label">Deskripsi</label>
  <input type="text" name="deskripsi" class="form-control" required>
</div>


      <div class="mb-3">
        <label class="form-label">Gambar Mobil (Utama)</label>
        <input type="file" name="gambar" class="form-control" accept="image/*" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Gambar Mobil (Detail)</label>
        <input type="file" name="gambar_detail" class="form-control" accept="image/*" required>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Tambah Mobil</button>
    </form>
  </div>
</body>
</html>
