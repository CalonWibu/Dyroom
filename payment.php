<?php include 'global/global.php';

if (!isset($_SESSION["email"]) || !isset($_POST["nama_car"]) || !isset($_POST["harga"])) {
    $_SESSION["redirect_url"] = $_SERVER["REQUEST_URI"];
    header("Location: login-system/register.php");
    exit();
}


    $nama_car = $_POST["nama_car"];
    $harga = (int)$_POST["harga"];
    $img_car_detail = $_POST["img_car_detail"];




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CHECKOUT</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      background: #0c0c0c;
      font-family: Arial, sans-serif;
      color: #eee;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .payment-box {
      background: #1a1a1a;
      padding: 28px;
      border-radius: 14px;
      width: 420px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.7);
    }

    .payment-box h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #f5b800;
      letter-spacing: .5px;
    }

    .keranjang {
      background: #111;
      padding: 14px;
      border-radius: 10px;
      margin-bottom: 22px;
    }
    .keranjang h3 {
      font-size: 15px;
      margin: 0 0 10px;
      color: #f5b800;
    }
    .keranjang .item {
      display: flex;
      justify-content: space-between;
      font-size: 14px;
      margin: 4px 0;
      color: #bbb;
    }
    .keranjang .total {
      margin-top: 8px;
      font-weight: bold;
      color: #fff;
    }

    label {
      display: block;
      font-size: 13px;
      margin-bottom: 6px;
      color: #aaa;
    }
    input, select, textarea {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: none;
      background: #2a2a2a;
      color: #fff;
      margin-bottom: 15px;
      font-size: 14px;
      outline: none;
    }
    textarea { resize: none; min-height: 70px; }

    .row {
      display: flex;
      gap: 10px;
    }
    .row .col {
      flex: 1;
    }

    .pay-btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 8px;
      background: #f5b800;
      color: #000;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      transition: .25s;
    }
    .pay-btn:hover {
      background: #d4a627;
    }

    .icons {
      text-align: center;
      margin-top: 14px;
      font-size: 22px;
      color: #666;
    }
    .icons i { margin: 0 6px; }
  </style>
</head>
<body>

  <div class="payment-box">
    <h2>Payment</h2>

    <div class="keranjang">
      <h3>Keranjang</h3>
     <div class="item">
  <span><?= htmlspecialchars($nama_car) ?></span>
  <span>Rp <?= number_format($harga, 0, ',', '.') ?></span>
</div>

<div class="total">
  Total: Rp <?= number_format($harga, 0, ',', '.') ?>
</div>

    </div>

    <form method="POST" action="proses/payment-proses.php">
      <label>Nama Lengkap</label>
      <input type="text" placeholder="Masukkan nama lengkap" name="namalengkap">

      <label>No. Telepon</label>
      <input type="tel" placeholder="+61 812 xxxx xxxx" name="telp">

      <label>Country</label>
      <select name="country">
        <option disabled selected>Pilih negara</option>
        <option value="Indonesia">Indonesia</option>
        <option value="Malaysia">Malaysia</option>
        <option value="Singapore">Singapore</option>
        <option value="USA">USA</option>
        <option value="Japan">Japan</option>
        <option value="India">India</option>
      </select>

      <label>Alamat Lengkap</label>
      <textarea placeholder="Jl singotrunan, rt rw.." name="alamat"></textarea>

      <input type="text" name="nama_car" value="<?= htmlspecialchars($nama_car) ?>" hidden>
      <input type="text" name="harga" value="<?= $harga?>" hidden>
      <input type="text" name="img_car" value="<?= $img_car_detail?>" hidden>
      <input type="text" name="bayar" value="yes" hidden>

      <button type="submit" class="pay-btn">Bayar Sekarang</button>
    </form>
  </div>

</body>
</html>

