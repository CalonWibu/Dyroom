<?php include 'global/global.php'; 


$nama  = $_POST['nama'] ?? '';
$seri  = $_POST['seri'] ?? '';
$tipe  = $_POST['tipe'] ?? '';
$harga = $_POST['harga'] ?? '';

$query = "SELECT * FROM mobil WHERE 1=1 ORDER BY RAND()";
if ($nama != '') $query .= " AND nama_car LIKE '%".$conn->real_escape_string($nama)."%'";
if ($seri != '') $query .= " AND seri LIKE '%".$conn->real_escape_string($seri)."%'";
if ($tipe != '') $query .= " AND tipe LIKE '%".$conn->real_escape_string($tipe)."%'";

$result = $conn->query($query);

$seri_list = $conn->query("SELECT DISTINCT seri FROM mobil");
$tipe_list = $conn->query("SELECT DISTINCT tipe FROM mobil");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/global.css">
    <title>View all</title>
</head>
<body>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            flex-wrap: wrap;
            background-color: #0A0A0A;
            font-family: sans-serif;
        }

        .garis-atas {
            position: absolute;
            top: 80px;
            left: 50%;
            transform: translate(-50%, 0);
            width: 90%;
            height: 2px;
            background-color: #1F1F1F;
        }


        main {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 100px;
            margin-bottom: 100px;
            flex-direction: column;
        }

         .search-box {
      display: flex;
      align-items: center;
      background: #1a1a1aff;
      border-radius: 50px;
      padding: 8px 12px 8px 15px;
      width: 80%;
      max-width: 90%;
    }


    .search-box i {
      color: #f5b800;
      font-size: 18px;
      margin-right: 10px;
      cursor: pointer;
    }

    .search-box input {
      flex: 1;
      border: none;
      outline: none;
      background: transparent;
      color: white;
      font-size: 14px;
    }

    .search-box input::placeholder {
      color: #888;
    }

    .search-box button {
      background: #d4a627;
      border: none;
      outline: none;
      padding: 8px 18px;
      border-radius: 50px;
      font-weight: bold;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .search-box button:hover {
      background: #c19120;
    }

    .search-box button i {
      color: black;
    }





    .card-container {
        margin-top: 50px;
        width: 90%;
        display: flex;
        justify-content: center;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 20px;
    }

     .card {
      background: #1e1e1e;
      border-radius: 10px;
      overflow: hidden;
      width: 280px;
      color: white;
      box-shadow: 0 4px 10px rgba(0,0,0,0.4);
      transition: transform 0.3s;
    }

    .card img {
      width: 100%;
      height: 170px;
      object-fit: cover;
      display: block;
      background-color: #FF4400;
    }

    .card .seri {
      margin: 10px 15px 0 15px;
      font-size: 12px;
      color: #e5a40bff;
    }

    .card .nama-car {
      margin: 3px 15px;
      font-family: 'Ethnocentric', sans-serif;
      font-weight: bold;
      font-size: 16px;
    }

    .card .info {
      display: flex;
      justify-content: space-between;
      margin: 10px 15px;
      font-size: 12px;
      color: #e5a40bff;
    }

    .card .info p {
      display: flex;
      align-items: space-evenly;
      margin-left: 10px;
      gap: 2px;
    }

    .card .harga {
      margin: 10px 15px;
       font-family: 'eras-itc-bold', sans-serif;
      font-weight: bold;
      color: #f5b800;
      font-size: 20px;
    }


    .card button {
      flex: 1;
      background: transparent;
      border: 1px solid #f5b800;
      color: #f5b800;
      padding: 6px 0;
      margin: 10px 15px 15px 15px;
    width: 90%;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      transition: 0.3s;
    }

    .card button:hover {
      background: #f5b800;
      color: black;
    }
    .filter {
      position: absolute;
      margin-top: 150px;
      margin-left: 5px;
      background-color: #313131;
      border-radius: 0 0 10px 10px;
      overflow: hidden;
      display: flex;
      flex-direction: row;
      gap: 20px;
      align-items: flex-end;

      max-height: 0;   
      padding: 0 20px; 
      transition: max-height 0.5s ease, padding 0.5s ease;
    }


    #filter-box.open {
      max-height: 500px;   
      padding: 20px;     
    }

    .filter label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      color: #fff;
    }

    .filter input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    </style>
    <?php include 'components/navbar.php'; ?>

    <div class="garis-atas"></div>

    <main style="position: relative;">
 
 
 <!-- search -->
   <form method="POST" class="search-box">
            
            <i class="bi bi-funnel" style="cursor: pointer;" id="filter-btn"></i>
            <input type="text" name="nama" placeholder="search your dream car here"  value="<?= htmlspecialchars($nama) ?>">
            <button type="submit"><i class="bi bi-search"></i> Cari</button>
            
            
            <div class="filter" id="filter-box">


            <label for="seri">Brand</label>   
            <input list="seriList" name="seri" placeholder="Cari seri..." value="<?= htmlspecialchars($seri) ?>">
                <datalist id="seriList">
                  <?php while($row = $seri_list->fetch_assoc()) { ?>
                    <option value="<?= $row['seri'] ?>">
                  <?php } ?>
                </datalist> 


                <label for="tipe">Tipe</label>
                        <input list="tipeList" name="tipe" placeholder="Cari tipe..." value="<?= htmlspecialchars($tipe) ?>">
                        <datalist id="tipeList">
                          <?php while($row = $tipe_list->fetch_assoc()) { ?>
                            <option value="<?= $row['tipe'] ?>">
                          <?php } ?>
                        </datalist>

            </div>
    
</form>
        <!-- card -->

              <div class='card-container'>
        <?php
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) { ?>
                      <div class='card'>
                          <img src='../asset/mobil/<?= $row['img_car']?>' alt='<?=$row['nama_car']?>'>
                          <p class='seri'><?=$row['seri']?></p>
                          <p class='nama-car'><?=$row['nama_car']?></p>
                          <span class='info'>
                              <p><i class='bi bi-fuel-pump-fill'></i> <?=$row['energy']?></p>
                              <p><i class='bi bi-speedometer'></i> <?=$row['speed']?> km/h</p>
                              <p><i class='bi bi-car-front-fill'></i> <?=$row['tipe']?></p>
                          </span>
                          <p class='harga'>Rp. <?= number_format($row['harga'], 0, ',', '.') ?></p>

                          <button  onclick="window.location.href='detail.php?nama=<?=$row['nama_car'] ?>'">LIHAT</button>
                      </div>
              <?php  }
                } else {
                  echo "<p>Tidak ada data mobil ditemukan.</p>";
                }

          ?>




         </div>
    </main>

    <?php include 'components/footer.php'; ?>
    <?php include 'components/animation.php'; ?>


  <script>
    const btn = document.getElementById('filter-btn');
    const filterBox = document.getElementById('filter-box');

    btn.addEventListener('click', () => {
      filterBox.classList.toggle('open');
    });
  </script>


</body>
</html>