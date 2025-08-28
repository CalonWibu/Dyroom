<?php include 'global/global.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Page</title>
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

    .summary {
      background: #111;
      padding: 14px;
      border-radius: 10px;
      margin-bottom: 22px;
    }
    .summary h3 {
      font-size: 15px;
      margin: 0 0 10px;
      color: #f5b800;
    }
    .summary .item {
      display: flex;
      justify-content: space-between;
      font-size: 14px;
      margin: 4px 0;
      color: #bbb;
    }
    .summary .total {
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

    <div class="summary">
      <h3>Order Summary</h3>
      <div class="item"><span>Bugatti Chiron</span><span>Rp 20.000.000.000</span></div>
      <div class="item"><span>Pajak</span><span>Rp 200.000.000</span></div>
      <div class="total">Total: Rp 20.200.000.000</div>
    </div>

    <form>
      <label>Nama Lengkap</label>
      <input type="text" placeholder="Masukkan nama lengkap">

      <label>No. Telepon</label>
      <input type="tel" placeholder="+62 812 xxxx xxxx">

      <label>Country</label>
      <select>
        <option disabled selected>Pilih negara</option>
        <option>Indonesia</option>
        <option>Malaysia</option>
        <option>Singapore</option>
        <option>USA</option>
        <option>Japan</option>
      </select>

      <label>Alamat Lengkap</label>
      <textarea placeholder="Jl. Contoh No. 123, Kota, Kode Pos"></textarea>

      <label>Cardholder Name</label>
      <input type="text" placeholder="Name on Card">

      <label>Card Number</label>
      <input type="text" placeholder="1234 5678 9012 3456">

      <div class="row">
        <div class="col">
          <label>Expiry</label>
          <input type="text" placeholder="MM/YY">
        </div>
        <div class="col">
          <label>CVV</label>
          <input type="password" placeholder="***">
        </div>
      </div>

      <button type="submit" class="pay-btn">Bayar Sekarang</button>
    </form>

    <div class="icons">
      <i class="bi bi-credit-card-2-front"></i>
      <i class="bi bi-paypal"></i>
      <i class="bi bi-wallet2"></i>
    </div>
  </div>

</body>
</html>
