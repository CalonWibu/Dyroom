<?php
include '../koneksi/db.php';

$nama  = $_POST['nama'] ?? '';
$seri  = $_POST['seri'] ?? '';
$tipe  = $_POST['tipe'] ?? '';
$harga = $_POST['harga'] ?? '';

$query = "SELECT * FROM mobil WHERE 1=1";
if ($nama != '') $query .= " AND nama_car LIKE '%".$conn->real_escape_string($nama)."%'";
if ($seri != '') $query .= " AND seri LIKE '%".$conn->real_escape_string($seri)."%'";
if ($tipe != '') $query .= " AND tipe LIKE '%".$conn->real_escape_string($tipe)."%'";

$result = $conn->query($query);

$seri_list = $conn->query("SELECT DISTINCT seri FROM mobil");
$tipe_list = $conn->query("SELECT DISTINCT tipe FROM mobil");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Mobil</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f8f8f8; margin: 0; padding: 20px; }
    .search-box { background: white; padding: 15px; margin-bottom: 20px; border-radius: 8px; }
    .car-card { display: flex; gap: 15px; background: white; margin-bottom: 15px; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,.1); }
    .car-card img { width: 200px; height: 120px; object-fit: cover; border-radius: 5px; }
    .car-info h3 { margin: 0; }
  </style>
</head>
<body>
<div class="search-box">
  <form method="POST">
    <input type="text" name="nama" placeholder="Cari nama mobil..." value="<?= htmlspecialchars($nama) ?>">

    <input list="seriList" name="seri" placeholder="Cari seri..." value="<?= htmlspecialchars($seri) ?>">
    <datalist id="seriList">
      <?php while($row = $seri_list->fetch_assoc()) { ?>
        <option value="<?= $row['seri'] ?>">
      <?php } ?>
    </datalist>

    <input list="tipeList" name="tipe" placeholder="Cari tipe..." value="<?= htmlspecialchars($tipe) ?>">
    <datalist id="tipeList">
      <?php while($row = $tipe_list->fetch_assoc()) { ?>
        <option value="<?= $row['tipe'] ?>">
      <?php } ?>
    </datalist>

    <button type="submit">Cari</button>
  </form>
</div>








<?php
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<div class='car-card'>
            <img src='../asset/mobil/{$row['img_car']}' alt='{$row['nama_car']}'/>
            <div class='car-info'>
              <h3>{$row['seri']} - {$row['nama_car']}</h3>
              <p><b>Harga:</b> Rp ".number_format($row['harga'],0,',','.')."</p>
              <p><b>Speed:</b> {$row['speed']} km/h</p>
              <p><b>Energy:</b> {$row['energy']}</p>
              <p><b>Tipe:</b> {$row['tipe']}</p>
              <a href='../asset/mobil/{$row['img_car_detail']}' target='_blank'>Lihat Detail</a>
            </div>
          </div>";
  }
} else {
  echo "<p>Tidak ada data mobil ditemukan.</p>";
}
?>

</body>
</html>
