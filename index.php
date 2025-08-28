<?php include 'global/global.php'; ?>

<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="css/global.css">
  <title>DYROOM</title>

  <!-- Link CSS dan JS -->
<link rel="stylesheet" href="https://unpkg.com/magicmouse.js/dist/magic-mouse.css">

</head>
<body>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      /* border: 1px solid red; */
    }

    *::-webkit-scrollbar {
      display: none;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      background: linear-gradient(
  to bottom,
  #000000 0%,
  #000000 65%,
  #111111 100%
);

    }

    header {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 10;
    }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 30px;
    }

    #search {
      color: #ffffff;
      font-size: 20px;
      cursor: pointer;
    }

    .hero {
      position: relative;
      width: 100%;
      height: 100vh;
      overflow: hidden;
    }

    .hero video {
      object-fit: cover;
      width: 100%;
      height: 100%;
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(
        to bottom,
        rgba(0, 0, 0, 0.53) 0%,
        rgba(0, 0, 0, 0.48) 88%,
        rgba(0, 0, 0, 1) 100%
      );
    }

    h1 {
      font-family: 'Ethnocentric', sans-serif;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #ffffff;
      font-size: 60px;
      text-align: center;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
      z-index: 9;
    }

    .scroll-line {
      position: absolute;
      bottom: 30px;
      width: 2px;
      background: rgba(255, 255, 255, 0.2);
      height: 50px;
      overflow: hidden;
      left: 50%;
      transform: translateX(-50%);
    }

    .scroll-line::after {
      content: "";
      height: 20px;
      width: 2px;
      background: white;
      animation: scrollAnimasi 1.5s infinite ease-in-out;
      display: block;
    }

    @keyframes scrollAnimasi {
      0% {
        transform: translateY(0);
        opacity: 1;
      }
      100% {
        transform: translateY(30px);
        opacity: 0;
      }
    }

    .slider-wrapper {
      position: relative;
      overflow: hidden;
    }
    
    .display-produk {
     margin-top: 100px;
  display: flex;
  overflow-x: auto;
  overflow-y: hidden;
  scroll-snap-type: x mandatory;
  scroll-behavior: smooth;
  -webkit-overflow-scrolling: touch;
  gap: 20px;
  /* padding: 20px; */
}

.card {
  flex: 0 0 100%; /* lebar satu layar penuh */
  scroll-snap-align: center;
  display: flex;
}


    .produk-gambar {
      width: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .produk-gambar img {
      width: 70%;
    }

    .produk-gambar .nama-gambar {
      font-family: 'Ethnocentric', sans-serif;
      color: #ffffff;
      margin-top: -30px;
      text-align: center;
    }

    .produk-detail {
      width: 45%;
      display: flex;
      justify-content: center;
      flex-direction: column;
    }

    .produk-detail .nama-detail {
      font-family: 'Ethnocentric', sans-serif;
      color: #ffffff;
      font-size: 40px;
    }

    .produk-detail .deskripsi-detail {
      margin-top: 5px;
      font-family: 'eras-itc-regular', sans-serif;
      color: #ffffff;
      font-size: 20px;
    }

    .harga-display {
      margin-top: 10px;
      font-family: 'eras-itc-bold', sans-serif;
    }

    .harga-display .harga-asli {
      color: #FF9D00;
      font-size: 40px;
    }

    .harga-display .harga-diskon {
      color: red;
      font-size: 20px;
    }

    .btn-beli {
      background-color: #ffffff00;
      border: none;
      color: #ffffff;
      border: 3px solid #ffffff;
      padding: 20px 32px;
      text-align: center;
      font-size: 22px;
      text-decoration: none;
      display: inline-block;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 20px;
      font-family: 'eras-itc-bold', sans-serif;
      margin-top: 20px;
      transition: 0.2s ease-in-out;
    }

    .btn-beli:hover {
      background-color: #E6FF00;
      color: #000000;
      border-color: #E6FF00;
    }

    .slider-nav {
      position: absolute;
      top: 50%;
      width: 100%;
      display: flex;
      justify-content: space-between;
      transform: translateY(-50%);
      padding: 0 20px;
      pointer-events: none;
    }

    .slider-nav button {
      pointer-events: all;
      background-color: rgba(255, 255, 255, 0.3);
      border: none;
      color: white;
      font-size: 30px;
      padding: 10px 15px;
      border-radius: 50%;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .slider-nav button:hover {
      background-color: #E6FF00;
      color: black;
    }

    .slider-line {
        margin-top: 60px;
     display: flex;
     flex-direction: row;
     align-items: center;
     justify-content: center;
      gap: 5px;
      /* background: rgba(255, 0, 0, 0.2); */
      /* height: 50px; */
    }

    .slider-line a {
        background-color: #ffffff;
        width: 10px;
        border-radius: 50%;
        height: 10px;
        transition: 0.5s ease-in-out;
    }

    .slider-line a.active {
        background-color: #ff0000;
        width: 20px;
        border-radius: 20px;
    }




    /* //////////////////////////////////////////////////// */
    section.review {
        margin-top: 100px;
        margin-bottom: 400px;
    }

    h2 {
              font-family: 'eras-itc-bold', sans-serif;
            font-size: 40px;
            text-align: center;
            color: #ffffff;
    }

    .review-container {
      /* background-color: #E6FF00; */
        display: flex;
        margin-top: 60px;
        flex-direction: column;
        align-items: center;
    }

    .review-box {
        background-color: #fefefe;
        width: 700px;
        /* height: 300px; */
        padding: 30px;
        border-radius: 20px;
        z-index: 6;
        /* margin-bottom: 20px; */
    }

    .review-box .profile {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .review-box .profile-identitas {
      margin-left: 10px;
    }

    .profile-nama {
        font-family: 'ethnocentric', sans-serif;
        font-size: 18px;
    }

    .job {
        font-family: 'eras-itc-regular', sans-serif;
        font-size: 12px;
        font-weight: bold;
    }

    .review-detail {
        font-family: 'eras-itc-regular', sans-serif;
        font-size: 16px;
        margin-top: 10px;
        margin-left: 70px;
    }

    .review-back1 {
      background-color: #9B9B9B;
      width: 660px;
      height: 100px;
      border-radius: 20px;
      margin-bottom: 20px;
      z-index: 5;
      margin-top: -90px;
      /* opacity: 0.5; */
      /* margin-left: 20px; */
    }
    
    .review-back2 {
      background-color: #444444;
      width: 630px;
      height: 100px;
      border-radius: 20px;
      margin-bottom: 20px;
      z-index: 4;
      margin-top: -110px;
      /* opacity: 0.5; */
      /* margin-left: 20px; */
    }

    .bg-footer {
      width: 80vw;

      opacity: 0.19;
      margin-top: -400px;
    }

    #lookall {
      margin-top: 90px;
    float: right;
    margin-right: 20px;
    margin-bottom: -100px;
    cursor: pointer;
    font-size: 20px;
    color: white;
    transition: 0.2s ease-in-out;
    }
    
    #lookall:hover {
      color: #E6FF00;
      font-size: 20.5px;
    }

  </style>

  <header>
    <nav>
      <img src="logo.png" alt="DYROOM">
      <a href="view.php">
        <i class="bi bi-search" id="search"></i>
      </a>
    </nav>
  </header>

  <main>
    <section class="hero">
      <video src="asset/Hero.mp4" autoplay loop muted playsinline style="width: 100%;"></video>
      <div class="hero-overlay"></div>
      <h1>find your<br><span style="color: #E6FF00;">dream car</span></h1>
      <div class="scroll-line"></div>
    </section>

    <section class="slider-wrapper">
      <a href="view.php">
        <i class="bi bi-microsoft" id="lookall"></i>

      </a>
      <div class="display-produk" id="produkSlider">
        <div class="card" id="card1">
          <div class="produk-gambar">
            <img src="asset/barang/bugatti_bagus_png.png" alt="mobil">
            <p class="nama-gambar">Bugatti Chiron</p>
          </div>
          <div class="produk-detail">
            <p class="nama-detail">Bugatti Chiron</p>
            <p class="deskripsi-detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labo....</p>
            <p class="harga-display">
              <span class="harga-asli">Rp. 20.000.000.000</span>
              <span class="harga-diskon"><s>Rp. 90.000.000.000</s></span>
            </p>
            <button class="btn-beli">LIHAT</button>
          </div>
        </div>

        <div class="card" id="card2">
          <div class="produk-gambar">
            <img src="asset/barang/bugatti_bagus_png.png" alt="mobil">
            <p class="nama-gambar">Bugatti Chiron</p>
          </div>
          <div class="produk-detail">
            <p class="nama-detail">Bugatti Chiron</p>
            <p class="deskripsi-detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labo....</p>
            <p class="harga-display">
              <span class="harga-asli">Rp. 20.000.000.000</span>
              <span class="harga-diskon"><s>Rp. 90.000.000.000</s></span>
            </p>
            <button class="btn-beli">LIHAT</button>
          </div>
        </div>

        <div class="card" id="card3">
          <div class="produk-gambar">
            <img src="asset/barang/bugatti_bagus_png.png" alt="mobil">
            <p class="nama-gambar">Bugatti Chiron</p>
          </div>
          <div class="produk-detail">
            <p class="nama-detail">Bugatti Chiron</p>
            <p class="deskripsi-detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labo....</p>
            <p class="harga-display">
              <span class="harga-asli">Rp. 20.000.000.000</span>
              <span class="harga-diskon"><s>Rp. 90.000.000.000</s></span>
            </p>
            <button class="btn-beli">LIHAT</button>
          </div>
        </div>
        
      </div>

    <div class="slider-line">
        <a href="#card1" class="active"></a>
        <a href="#card2"></a>
        <a href="#card3"></a>
    </div>
        </section>
        <section class="review">
            <h2>RE<span style="color: #FF9D00;">VIEW</span></h2>
        
            <div class="review-container">
                <div class="review-box">
                  <div class="profile">
                    <img src="asset/profile-kotak.png" alt="profile">
                    <div class="profile-identitas">
                      <p class="profile-nama">SUREGAR</p>
                      <p class="job">CEO OF MAYORA</p>
                    </div>
                  </div>
                  <p class="review-detail">Gila, Saya beli bmw seri 2 dengan harga yang jauh di bawah harga pasar dan mendapat kualitas yang sangat memuaskah</p>
                </div>
                <div class="review-back1"></div>
                <div class="review-back2"></div>
            </div>
        
        </section>
    </main>
    <footer>
      <img src="asset/footer.png" alt="DYROOM by LALY">
      <center>
        <img src="asset/barang/bg-footer.png" class="bg-footer">

      </center>
    </footer>
<script>
  const titikLinks = document.querySelectorAll('.slider-line a');
  let currentIndex = 0;

  function goToIndex(index) {
    // Hapus semua 'active'
    titikLinks.forEach(l => l.classList.remove('active'));

    // Tambahkan 'active' pada yang dipilih
    const link = titikLinks[index];
    link.classList.add('active');

    // Scroll ke target
    const targetId = link.getAttribute('href');
    const targetElement = document.querySelector(targetId);
    if (targetElement) {
      targetElement.scrollIntoView({ behavior: 'smooth' });
    }
  }

  // Manual click event
  titikLinks.forEach((link, i) => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      currentIndex = i; // Update index agar sinkron dengan auto-slide
      goToIndex(currentIndex);
    });
  });

  // Auto-slide setiap 20 detik
  setInterval(() => {
    currentIndex = (currentIndex + 1) % titikLinks.length;
    goToIndex(currentIndex);
  }, 20000); // 20000 ms = 20 detik
</script>


</body>
</html>
