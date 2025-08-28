<?php include 'global/global.php'; ?>

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

    /* card */
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
    </style>
    <?php include 'components/navbar.php'; ?>

    <div class="garis-atas"></div>

    <main style="position: relative;">
        <div class="search-box">
            <i class="bi bi-funnel"></i>
            <input type="text" placeholder="search your dream car here">
            <button><i class="bi bi-search"></i> Cari</button>
        </div>

        <!-- card -->
         <div class="card-container">
             <div class="card">
                 <img src="asset/barang/bugatti.jpg" alt="gambar mobil">
                 <p class="seri">BUGATTI</p>
                 <p class="nama-car">Bugatti Chiron</p>
                 <span class="info">
                     <p><i class="bi bi-fuel-pump-fill"></i> Bensin</p>
                     <p><i class="bi bi-speedometer"></i> 12000Km</p>
                     <p><i class="bi bi-car-front-fill"></i> sedan</p>
                 </span>
                 <p class="harga">Rp. 20.000.000.000</p>
                 <button>LIHAT</button>
             </div>

                      <div class="card">
                 <img src="asset/barang/bugatti.jpg" alt="gambar mobil">
                 <p class="seri">BUGATTI</p>
                 <p class="nama-car">Bugatti Chiron</p>
                 <span class="info">
                     <p><i class="bi bi-fuel-pump-fill"></i> Bensin</p>
                     <p><i class="bi bi-speedometer"></i> 12000Km</p>
                     <p><i class="bi bi-car-front-fill"></i> sedan</p>
                 </span>
                 <p class="harga">Rp. 20.000.000.000</p>
                 <button>LIHAT</button>
             </div>


                      <div class="card">
                 <img src="asset/barang/bugatti.jpg" alt="gambar mobil">
                 <p class="seri">BUGATTI</p>
                 <p class="nama-car">Bugatti Chiron</p>
                 <span class="info">
                     <p><i class="bi bi-fuel-pump-fill"></i> Bensin</p>
                     <p><i class="bi bi-speedometer"></i> 12000Km</p>
                     <p><i class="bi bi-car-front-fill"></i> sedan</p>
                 </span>
                 <p class="harga">Rp. 20.000.000.000</p>
                 <button>LIHAT</button>
             </div>


                      <div class="card">
                 <img src="asset/barang/bugatti.jpg" alt="gambar mobil">
                 <p class="seri">BUGATTI</p>
                 <p class="nama-car">Bugatti Chiron</p>
                 <span class="info">
                     <p><i class="bi bi-fuel-pump-fill"></i> Bensin</p>
                     <p><i class="bi bi-speedometer"></i> 12000Km</p>
                     <p><i class="bi bi-car-front-fill"></i> sedan</p>
                 </span>
                 <p class="harga">Rp. 20.000.000.000</p>
                 <button>LIHAT</button>
             </div>


                      <div class="card">
                 <img src="asset/barang/bugatti.jpg" alt="gambar mobil">
                 <p class="seri">BUGATTI</p>
                 <p class="nama-car">Bugatti Chiron</p>
                 <span class="info">
                     <p><i class="bi bi-fuel-pump-fill"></i> Bensin</p>
                     <p><i class="bi bi-speedometer"></i> 12000Km</p>
                     <p><i class="bi bi-car-front-fill"></i> sedan</p>
                 </span>
                 <p class="harga">Rp. 20.000.000.000</p>
                 <button>LIHAT</button>
             </div>


                      <div class="card">
                 <img src="asset/barang/bugatti.jpg" alt="gambar mobil">
                 <p class="seri">BUGATTI</p>
                 <p class="nama-car">Bugatti Chiron</p>
                 <span class="info">
                     <p><i class="bi bi-fuel-pump-fill"></i> Bensin</p>
                     <p><i class="bi bi-speedometer"></i> 12000Km</p>
                     <p><i class="bi bi-car-front-fill"></i> sedan</p>
                 </span>
                 <p class="harga">Rp. 20.000.000.000</p>
                 <button>LIHAT</button>
             </div>


         </div>
    </main>

    <?php include 'components/footer.php'; ?>

</body>
</html>