<?php
session_start();
include '../koneksi/db.php';
include '../components/midtrans-header.php';

// wajib
$email = $_SESSION["email"];
$bayar = $_POST["bayar"] ?? null;






$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();
$user_id = $user['id'] ?? null;

if (!$user_id) {
    header("Location: ../view.php");
    exit;
}

if ($bayar === "yes") {
    // jika baru melakukan transaksi
    $namaLengkap = $_POST['namalengkap'];
    $telp        = $_POST['telp'];
    $country     = $_POST['country'];
    $alamat      = $_POST['alamat'];
    $imgcar      = $_POST['img_car'];
    $namaCar     = $_POST['nama_car'];
    $harga       = (int)(str_replace('.', '', $_POST['harga']) ?? 0);
    $stmt2 = $conn->prepare("SELECT id FROM mobil WHERE nama_car = ?");
    $stmt2->bind_param("s", $namaCar);
    $stmt2->execute();
    $res2 = $stmt2->get_result();
    $mobil = $res2->fetch_assoc();
    $mobil_id = $mobil['id'] ?? null;
    $orderId = uniqid("ORDER-");
    $status  = "pending";
    $banyak  = 1;





    $stmt3 = $conn->prepare("INSERT INTO orders (user_id, mobil_id, banyak, total_harga, status, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt3->bind_param("iiiss", $user_id, $mobil_id, $banyak, $harga, $status);
    $stmt3->execute();
    $lastOrderId = $conn->insert_id;

    $stmt4 = $conn->prepare("INSERT INTO personal (id_pembeli, id_mobil, country, alamat) VALUES (?, ?, ?, ?)");
    $stmt4->bind_param("iiss", $user_id, $mobil_id, $country, $alamat);
    $stmt4->execute();

    $namacar = $namaCar;
    $hargaakhir   = $harga;
    $orderidakhir = $orderId;
    $namapanjangakhir = $namaLengkap;
    $telpakhir        = $telp;

} else {
    // jika akun sudha melakukan transaksi
    $stmtcek = $conn->prepare("SELECT * FROM orders WHERE user_id = ? AND status = 'pending' LIMIT 1");
    $stmtcek->bind_param("i", $user_id);
    $stmtcek->execute();
    $rescek = $stmtcek->get_result();
    $order = $rescek->fetch_assoc();

    if (!$order) {
        header("Location: ../view.php");
        exit;
    }
    $lastOrderId = $order['id'];
    $mobil_id    = $order['mobil_id'];
    $hargaakhir    = $order['total_harga'];

    $stmt2 = $conn->prepare("SELECT nama_car FROM mobil WHERE id = ?");
    $stmt2->bind_param("i", $mobil_id);
    $stmt2->execute();
    $res2 = $stmt2->get_result();
    $mobil = $res2->fetch_assoc();
    $namacar = $mobil['nama_car'];

    $stmtUser = $conn->prepare("SELECT nama, telp FROM users WHERE id = ?");
    $stmtUser->bind_param("i", $user_id);
    $stmtUser->execute();
    $resUser = $stmtUser->get_result();
    $userData = $resUser->fetch_assoc();
    $namapanjangakhir = $userData['nama_lengkap'];
    $telpakhir        = $userData['telp'];

    $orderidakhir = "ORDER-" . $lastOrderId;
}


// intergrasi midtrans
$datatransaksi = [
    'transaction_details' => [
        'order_id' => $orderidakhir,
        'gross_amount' => $hargaakhir,
    ],
    'customer_details' => [
        'first_name' => $namapanjangakhir,
        'email' => $email,
        'phone' => $telpakhir,
    ],
];

$snapToken = \Midtrans\Snap::getSnapToken($datatransaksi);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>PAYMENT</title>
  <link rel="stylesheet" href="../css/global.css">
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-DRmZNwaaMlyqFCtd"></script>
</head>
<body>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #0b0b0b;
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }
    header {
      width: 100%;
      text-align: center;
      margin-bottom: 25px;
      font-size: 18px;
      font-weight: bold;
      color: #00d4ff;
    }

    #timer {
        font-family: 'ethnocentric', sans-serif;
        font-size: 40px;
    }

    .wrapper {
      max-width: 900px;
      text-align: center;
    }
    .wrapper img {
      width: 100%;
      max-height: 450px;
      object-fit: cover;
      border-radius: 14px;
      margin-bottom: 25px;

    }
    .car-name {
      font-size: 26px;
      font-weight: 700;
      margin-bottom: 12px;
    }
    .price {
      font-size: 60px;
      font-weight: bold;
      color: #ffc400ff;
      margin-top: -50px;
      margin-bottom: 10px;
      font-family: 'ethnocentric', sans-serif;
    }
    .btn {
      display: inline-block;
      padding: 20px 40px;
      background: linear-gradient(90deg, #ffa13cff, #ff8400ff);
      border: none;
      border-radius: 10px;
      color: #071018;
      font-weight: 700;
      font-size: 16px;
      text-decoration: none;
      cursor: pointer;
      box-shadow: 0 6px 20px rgba(0,0,0,0.6);
      transition: transform .2s ease, box-shadow .2s ease;
    }
    .btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.8);
    }
  </style>

  <header>
    <span id="timer">00:00:00</span>
  </header>

  <div class="wrapper">
    <img src="../asset/mobil/<?= $imgcar?>" alt="<?= $namaCar?>">
    <div class="price">Rp  <?= number_format($harga, 0, ',', '.') ?></div>
    <button class="btn" id="pay-button">Bayar Sekarang</button>
  </div>

  <script>
    const timerEl = document.getElementById("timer");

    let endTime = localStorage.getItem("endTime");
    if (!endTime) {
      const now = new Date().getTime();
      endTime = now + 60 * 60 * 1000; // +1 jam
      localStorage.setItem("endTime", endTime);
    } else {
      endTime = parseInt(endTime, 10);
    }

    function updateTimer() {
      const now = new Date().getTime();
      const distance = endTime - now;

      if (distance <= 0) {
        timerEl.textContent = "Waktu habis";
        localStorage.removeItem("endTime"); 
        return;
      }

      const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
      const minutes = Math.floor((distance / (1000 * 60)) % 60);
      const seconds = Math.floor((distance / 1000) % 60);

      timerEl.textContent =
        String(hours).padStart(2, "0") + ":" +
        String(minutes).padStart(2, "0") + ":" +
        String(seconds).padStart(2, "0");
    }

    updateTimer();
    setInterval(updateTimer, 1000);

    document.getElementById('pay-button').onclick = function(){
      snap.pay('<?= $snapToken ?>', {
        onSuccess: function(result){
          console.log(result);
          alert("Pembayaran berhasil!");
          window.location.href = "../akun.php";
        },
        onPending: function(result){
          console.log(result);
          alert("Menunggu pembayaran...");
          window.location.href = "../akun.php";
        },
        onError: function(result){
          console.log(result);
          alert("Pembayaran gagal!");
          window.location.href = "../view.php";
        },
        onClose: function(){
          alert("Popup ditutup tanpa menyelesaikan pembayaran");
        }
      });
    };
  </script>
</body>
</html>
