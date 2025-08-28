<?php include 'global/global.php'; 

include 'koneksi/db.php';
$nama = isset($_GET['nama']) ? urldecode($_GET['nama']) : '';

if ($nama == '') {
    ?>
    <script>
        alert('tidak ada bro');
        window.location.href = 'view.php';
    </script>
    <?php
    exit;
}

$stmt = $conn->prepare("SELECT seri, nama_car, harga, img_car_detail, deskripsi FROM mobil WHERE nama_car = ?");
$stmt->bind_param("s", $nama);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $mobil = $result->fetch_assoc();
} else {
    ?>
    <script>
        alert('tidak ada bro');
        window.location.href = 'view.php';
    </script>
    <?php
    exit;
}

$stmt2 = $conn->prepare("SELECT nama_car, img_car FROM mobil WHERE seri = ? AND nama_car != ? LIMIT 4");
$stmt2->bind_param("ss", $mobil['seri'], $mobil['nama_car']);
$stmt2->execute();
$related = $stmt2->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/global.css">
    <title>Detail</title>
</head>
<body>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* border: 1px solid red; */
        }

        body {
            background: #000000;
            font-family: sans-serif;
        }
        
        main {
            margin-bottom: 60px;
        }


        .hero {
            /* background-color: blue; */
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            width: 100%;
            margin-top: 100px;
            margin-bottom: -20px;
        }

        .hero img {
            width: 70%;
        }

        .color {
            position: absolute;
            right: 10px;
            top: 180px;
            float: right;
            /* background-color: yellow; */
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 30px;
            /* height: 100px; */
            gap: 10px;
            cursor: pointer;
        }

        .color .red, .blue, .yellow {

            background-color: red;
            width: 30px;
            height: 30px;
            border-radius: 50px;
            transition: 0.1s ease-in-out;
        }

        .color .red:hover, .blue:hover, .yellow:hover {
            transform: translate(-2px, 0px);
        }

        .blue {
            background-color: blue;
        }

        .yellow {
            background-color: yellow;
        }

        .info {
            /* background-color: green; */
            display: flex;
            flex-direction: column;
            /* width: 100%; */
            /* margin-top: -10px; */
            color: white;
            margin-left: 30px;
        }

        .nama-car {
            font-family: 'Ethnocentric', sans-serif;
            font-size: 30px;
            margin-left: 20px;
            margin-top: 20px;
        }

        .harga {
            font-size: 30px;
            margin-left: 20px;
            color: #FF9D00;
             font-family: 'eras-itc-bold', sans-serif;
        }

        .info button {
            margin-left: 20px;
            width: 400px;
            background: transparent;
            border: 3px solid #FF4400;
            border-radius: 10px;
            margin-top: 10px;
            color: #FF4400;
            font-family: 'eras-itc-bold', sans-serif;
            font-size: 25px;
            height: 50px;
            cursor: pointer;
            transition: 0.1s ease-in-out;
        }

        .info button:hover {
            background: #FF4400;
            color: white;
        }

        .deskripsi {
            /* margin-left: 20px; */
            margin-top: 50px;
            color: white;
            font-family: sans-serif;
            font-size: 13px;
            margin-left: 47px;
        }

        .deskripsi h2 {
            margin-bottom: 20px;
            
        }

        .deskripsi p {
            width: 50%;
            font-size: 15px;
        }

         .relate {
      margin-top: 200px;
      /* width: 100%; */
      margin-left: 47px;
    }

    .relate h2 {
      font-size: 22px;
      margin-bottom: 15px;
    }

    .relate .card-container {
      display: flex;
      gap: 40px;
      flex-wrap: wrap;
      justify-content: center;
    }

    .relate .card {
      display: block;
      width: 300px;
      border-radius: 12px;
      overflow: hidden;
      transition: transform 0.3s;
    }

    .relate .card img {
      width: 100%;
      height: 160px;
      object-fit: cover;
      display: block;
      border-radius: 12px;
    }

    .relate .card:hover {
      transform: scale(1.05);
    }

    </style>
    <?php include 'components/navbar.php'; ?>
    <main>
        <div class="hero">
            <img src="/asset/mobil/<?= htmlspecialchars($mobil['img_car_detail']); ?>" alt="<?= htmlspecialchars($mobil['nama_car']); ?>">
        </div>
        <div class="color">
            <div class="red"></div>
            <div class="blue"></div>
            <div class="yellow"></div>
        </div>
   <div class="info">
    <p class="nama-car"><?= htmlspecialchars($mobil['nama_car']); ?></p>
    <p class="harga">Rp <?= number_format($mobil['harga'], 0, ',', '.'); ?></p>
    <form method="POST" action="payment.php">
        <input type="hidden" name="nama_car" value="<?= htmlspecialchars($mobil['nama_car']); ?>">
        <input type="hidden" name="harga" value="<?= (int)$mobil['harga']; ?>">
        <input type="hidden" name="img_car_detail" value="<?= htmlspecialchars($mobil['img_car_detail']); ?>">
        <button type="submit" class="btn-buy">Beli Sekarang</button>
    </form>
</div>

        </div>
        <div class="deskripsi">
            <h2>Description</h2>
            <p><?= nl2br(htmlspecialchars($mobil['deskripsi'])); ?></p>
        </div>
    <?php if ($related->num_rows > 0): ?>
        <div class="relate"> 
    <h2 style="color: white;">Related From <span style="color: #FF9D00;"><?= htmlspecialchars($mobil['seri']); ?></span></h2>
    <div class="card-container">
          <?php while ($row = $related->fetch_assoc()): ?>
      <a href="?nama=<?= urlencode($row['nama_car']); ?>" class="card">
        <img src="asset/mobil/<?= htmlspecialchars($row['img_car']); ?>" alt="<?= htmlspecialchars($row['nama_car']); ?>" style="background-color: #FF4400;">
      </a>
     <?php endwhile; ?>
    </div>
  </div>
  <?php endif; ?>
    </main>
    <?php include 'components/footer.php'; ?>
    <?php include 'components/animation.php'; ?>

        
</body>
</html>