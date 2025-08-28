<?php
include '../koneksi/db.php';

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

$stmt = $conn->prepare("SELECT seri, nama_car, harga, img_car, deskripsi FROM mobil WHERE nama_car = ?");
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

// ambil mobil lain dengan seri sama (maksimal 4)
$stmt2 = $conn->prepare("SELECT nama_car, img_car FROM mobil WHERE seri = ? AND nama_car != ? LIMIT 4");
$stmt2->bind_param("ss", $mobil['seri'], $mobil['nama_car']);
$stmt2->execute();
$related = $stmt2->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($mobil['nama_car']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        .card {
            max-width: 800px;
            margin: auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        .card img {
            width: 100%;
            display: block;
        }
        .content {
            padding: 20px;
        }
        .content h1 {
            margin: 0;
            font-size: 28px;
        }
        .harga {
            color: #e63946;
            font-size: 22px;
            margin: 10px 0;
        }
        .deskripsi {
            line-height: 1.6;
        }

        /* style mobil terkait */
        .related {
            max-width: 800px;
            margin: 40px auto;
        }
        .related h2 {
            font-size: 22px;
            margin-bottom: 15px;
        }
        .related-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
        }
        .related-item {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
            text-align: center;
            padding: 10px;
            transition: transform 0.2s;
        }
        .related-item:hover {
            transform: scale(1.03);
        }
        .related-item img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
        }
        .related-item p {
            margin: 8px 0 0;
            font-size: 14px;
            font-weight: bold;
        }
        .related-item a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
    <!-- detail mobil utama -->
    <div class="card">
        <img src="../asset/mobil/<?= htmlspecialchars($mobil['img_car']); ?>" alt="<?= htmlspecialchars($mobil['nama_car']); ?>">
        <div class="content">
            <h1><?= htmlspecialchars($mobil['nama_car']); ?></h1>
            <div class="harga">Rp <?= number_format($mobil['harga'], 0, ',', '.'); ?></div>
            <div class="deskripsi"><?= nl2br(htmlspecialchars($mobil['deskripsi'])); ?></div>
        </div>
    </div>

    <!-- mobil terkait -->
    <?php if ($related->num_rows > 0): ?>
    <div class="related">
        <h2>Mobil lain dari seri <?= htmlspecialchars($mobil['seri']); ?>:</h2>
        <div class="related-list">
            <?php while ($row = $related->fetch_assoc()): ?>
                <div class="related-item">
                    <a href="?nama=<?= urlencode($row['nama_car']); ?>">
                        <img src="../asset/mobil/<?= htmlspecialchars($row['img_car']); ?>" alt="<?= htmlspecialchars($row['nama_car']); ?>">
                        <p><?= htmlspecialchars($row['nama_car']); ?></p>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>