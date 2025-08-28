<?php include 'global/global.php'; ?>

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
            top: 320px;
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
            <img src="asset/mobil/chirondisplay.png" alt="car">
        </div>
        <div class="color">
            <div class="red"></div>
            <div class="blue"></div>
            <div class="yellow"></div>
        </div>

        <div class="info">
            <p class="nama-car">BUGATTI CHIRON</p>
            <p class="harga">Rp. 20.000.000.000</p>
            <button>CHECKOUT</button>
        </div>
        
        <div class="deskripsi">
            <h2>Description</h2>
            <p>
                Engine

Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore etLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore etLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore etLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore etLorem ip

sum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore etLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore etLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore etLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore etLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore etLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore etLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore etLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore etLorem ipsum dolor sit amet, 


consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore etLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore etLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            </p>
        </div>

        <div class="relate"> 
    <h2 style="color: white;">Related</h2>
    <div class="card-container">
      <a href="#" class="card">
        <img src="asset/barang/porche.jpg" alt="car">
      </a>
      <a href="#" class="card">
        <img src="asset/barang/porche.jpg" alt="car">
      </a>
      <a href="#" class="card">
        <img src="asset/barang/porche.jpg" alt="car">
      </a>
        <a href="#" class="card">
        <img src="asset/barang/porche.jpg" alt="car">
      </a>
      
    </div>
  </div>
    </main>
    <?php include 'components/footer.php'; ?>
</body>
</html>