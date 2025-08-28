<?php
session_start();
include 'koneksi/db.php';

if (!isset($_SESSION['email'])) {
    die("Anda harus login terlebih dahulu.");
}

$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    die("User tidak ditemukan.");
}
$user = $result->fetch_assoc();
$user_id = $user['id'];

$stmt = $conn->prepare("SELECT status FROM orders WHERE user_id = ? ORDER BY created_at DESC LIMIT 1");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

if ($order) {
    if ($order['status'] == 'pending') {
        header("Location: proses/payment-proses.php");
        exit;
    } elseif ($order['status'] == 'paid') {
        // ambil data dari table personal
        $stmt = $conn->prepare("SELECT country FROM personal WHERE id_pembeli = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $personal = $result->fetch_assoc();
        $country = $personal ? $personal['country'] : '';
    } else {
        die("lakukanlah transaksi untuk memasuki halaman ini!");
        header("Location: view.php");
        exit;
    }
} else {
    $country = '';
            die("lakukanlah transaksi untuk memasuki halaman ini!");
        header("Location: view.php");
        exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Bounded World Map</title>
  <link rel="stylesheet" href="css/global.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <style>
    html, body, #map {
      height: 100%;
      margin: 0;
      background: #262626;
    }

    header {
        z-index: 1000;
    }

    .leaflet-control { display: none; }

    .detail-order {
        transition: 0.3s ease-in-out;
        display: flex;
        flex-direction: column;
      position: absolute;
      bottom: 0;
      left: 50%;
      z-index: 1000;
      transform: translate(-50%, -20%);
      text-align: center;
      justify-content: center;

       background: rgba(255, 255, 255, 0.3); 
        backdrop-filter: blur(10px); 
        -webkit-backdrop-filter: blur(10px); 
        padding: 20px 30px;
        border-radius: 20px;
    }

    .country {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 80px;
    }

    .detail-data {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 80px;
    }
  </style>
</head>
<body>
    <?php include 'components/navbar.php'; ?>

  <div id="map"></div>
  <div class="detail-order">
    <div class="country" style="color: white;">
        <p style="font-family: sans-serif; font-weight: bold;">India</p>
        <p style="font-family: sans-serif; font-weight: bold;">--------------------------></p>
        <p style="font-family: sans-serif; font-weight: bold;"><?= $country ?></p>
    </div>
    <div class="detail-data">
        <p><span style="font-family: 'ethnocentric', sans-serif; font-size: 20px; color: white; font-weight: bold;">Estimasi</span><br><span style="font-family: 'eras-itc-bold', sans-serif; font-size: 20px; font-weight: bold; color: #FF9D00;">15 April 2026</span></p>
        <p><span style="font-family: 'ethnocentric', sans-serif; font-size: 20px; color: white; font-weight: bold;">Invoice</span><br><span style="font-family: 'eras-itc-bold', sans-serif; font-size: 20px; font-weight: bold; color: #FF9D00;">Au38023G93K</span></p>
    </div>
  </div>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    const worldBounds = L.latLngBounds(
      L.latLng(-85, -180),
      L.latLng(85, 180)
    );

    const map = L.map('map', {
      center: [20, 0],
      zoom: 2,
      maxBounds: worldBounds,
      maxBoundsViscosity: 1.0,
      zoomControl: false,
      attributionControl: false
    });

    L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_nolabels/{z}/{x}/{y}{r}.png', {
      maxZoom: 10,
      minZoom: 2,
      noWrap: true,
      bounds: worldBounds
    }).addTo(map);




    const countryCoords = {
      Indonesia: [-6.2000, 106.8167],
      Malaysia: [3.1390, 101.6869],

      Singapore: [1.3521, 103.8198],
      USA: [38.9072, -77.0369],
      Japan: [35.6895, 139.6917],
      India: [28.6139, 77.2090]
    };

    const originMarker = L.circleMarker([20.5937, 78.9629], {
      radius: 5,
      color: '#00ffff',
      fillOpacity: 1
    }).addTo(map).bindPopup("Origin");

    let destMarker = null;
    let connectionLine = null;

    const country = "<?php echo $country; ?>";

    if (country && countryCoords[country]) {
      const coords = countryCoords[country];

      destMarker = L.circleMarker(coords, {
        radius: 5,
        color: '#ff00ff',
        fillColor: '#ff00ff'
      }).addTo(map).bindPopup(country);

      connectionLine = L.polyline(
        [[20.5937, 78.9629], coords],
        {color: '#00ffff', weight: 2}
      ).addTo(map);
        // biar keliatan bedanya soalnya deket deketan
      let zoomLevel = 4;
      if (country === "Indonesia" || country === "Malaysia" || country === "Singapore") {
        zoomLevel = 6;
      }
      map.flyTo(coords, zoomLevel);
    }
  </script>
</body>
</html>
