<?php include 'global/global.php'; 
$_SESSION['tittle'] = "DYROOM";
?>

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
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
    overflow-x: hidden;
    font-family: sans-serif;
    position: relative;
  }

  #star-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    pointer-events: none;
  }

  .star {
    position: absolute;
    background-color: white;
    border-radius: 50%;
    opacity: 0.8;
    animation: twinkle var(--duration) ease-in-out infinite;
  }

  @keyframes twinkle {
    0% { opacity: 0.2; transform: scale(0.8); }
    50% { opacity: 1; transform: scale(1.2); box-shadow: 0 0 10px rgba(255, 255, 255, 0.8); }
    100% { opacity: 0.2; transform: scale(0.8); }
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
    0% { transform: translateY(0); opacity: 1; }
    100% { transform: translateY(30px); opacity: 0; }
  }

  .slider-wrapper {
    margin-top: 20px;
    position: relative;
    overflow: hidden;
    padding-top: 60px;
  }

  .display-produk {
    margin-top: 40px;
    display: flex;
    overflow-x: auto;
    overflow-y: hidden;
    scroll-snap-type: x mandatory;
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
    gap: 20px;
  }

  .card {
    flex: 0 0 100%;
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
    transition: transform 0.3s ease;
  }
   
  .card:hover .produk-gambar img {
    transform: scale(1.05);
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
    z-index: 6;
  }

  .slider-nav button {
    pointer-events: all;
    background-color: rgba(255, 255, 255, 0.04);
    border: none;
    color: white;
    font-size: 30px;
    padding: 10px 15px;
    border-radius: 20px 20px 50px 50px;
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
  }

  .slider-line a {
    background-color: #ffffff;
    width: 10px;
    border-radius: 50%;
    height: 10px;
    transition: 0.5s ease-in-out;
  }

  .slider-line a.active {
    background-color: #E6FF00;
    width: 20px;
    border-radius: 20px;
  }

  section.explore {
    padding: 120px 50px;
    display: flex;
    justify-content: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 50px;
  }

  .explore-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1200px;
    width: 100%;
    gap: 60px;
    z-index: 2;
  }

  .explore-text {
    flex: 1;
    color: white;
  }

  .explore-text h2 {
    font-family: 'eras-itc-bold', sans-serif;
    text-align: left;
    font-size: 50px;
    line-height: 1.2;
    margin-bottom: 20px;
    color: #ffffff;
  }

  .explore-text p {
    font-family: 'eras-itc-regular', sans-serif;
    font-size: 18px;
    line-height: 1.6;
    color: #cccccc;
    margin-bottom: 40px;
    text-align: justify;
  }

  .explore-image {
    flex: 1;
    display: flex;
    justify-content: center;
    position: relative;
  }

  .explore-image img {
    width: 100%;
    max-width: 550px;
    transform: rotate(-15deg);
    filter: drop-shadow(0px 10px 20px rgba(230, 255, 0, 0.1));
    transition: transform 0.5s ease;
  }

  .explore-container:hover .explore-image img {
    transform: rotate(0deg) scale(1.05);
  }

  .btn-explore {
    text-decoration: none;
    font-family: 'Ethnocentric', sans-serif;
    font-size: 18px;
    color: #000000;
    background-color: #E6FF00;
    padding: 15px 40px;
    border-radius: 50px;
    display: inline-block;
    transition: 0.3s ease;
    border: 2px solid #E6FF00;
    box-shadow: 0 0 15px rgba(230, 255, 0, 0.4);
  }

  .btn-explore:hover {
    background-color: transparent;
    color: #E6FF00;
    box-shadow: 0 0 25px rgba(230, 255, 0, 0.8);
    transform: translateX(10px);
  }

  section.review {
    margin-top: 50px;
    margin-bottom: 400px;
  }

  h2 {
    font-family: 'eras-itc-bold', sans-serif;
    font-size: 40px;
    text-align: center;
    color: #ffffff;
  }

  .review-container {
    display: flex;
    margin-top: 60px;
    flex-direction: column;
    align-items: center;
  }

  .review-box {
    background-color: #fefefe;
    width: 700px;
    padding: 30px;
    border-radius: 20px;
    z-index: 6;
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
  }
   
  .review-back2 {
    background-color: #444444;
    width: 630px;
    height: 100px;
    border-radius: 20px;
    margin-bottom: 20px;
    z-index: 4;
    margin-top: -110px;
  }

  #lookall {
    position: absolute;
    top: 40px; 
    right: 30px;
    z-index: 5;
    cursor: pointer;
    font-size: 20px;
    color: white;
    transition: 0.2s ease-in-out;
  }
   
  #lookall:hover {
    color: #E6FF00;
    transform: scale(1.1);
  }

  .reveal {
    position: relative;
    opacity: 0;
    transform: translateY(50px);
    transition: all 1s ease;
  }

  .reveal.active {
    opacity: 1;
    transform: translateY(0);
  }


  @media (max-width: 768px) {
    
    h1 {
      font-size: 40px;
    }

    .card {
      flex-direction: column;
      width: 100%;
      align-items: center;
      padding: 0 20px;
    }

    .produk-gambar {
      width: 90%;
    }

    .produk-gambar img {
      width: 100%;
    }

    .produk-detail {
      width: 100%;
      align-items: center;
      text-align: center;
      margin-top: 20px;
    }

    .produk-detail .nama-detail {
      font-size: 30px;
    }
    .produk-detail .deskripsi-detail {
      font-size: 16px;
    }
    .harga-display .harga-asli {
      font-size: 30px;
    }
    .harga-display .harga-diskon {
      font-size: 16px;
    }

    .slider-nav button {
      font-size: 20px;
      padding: 5px 10px;
    }
    .slider-nav {
      padding: 0 5px;
    }

    #lookall {
      top: 20px;
      right: 20px;
    }

    section.explore {
      padding: 60px 20px;
    }

    .explore-container {
      flex-direction: column-reverse;
      gap: 30px;
      text-align: center;
    }

    .explore-text h2 {
      text-align: center;
      font-size: 35px;
    }

    .explore-text p {
      text-align: center;
      font-size: 16px;
    }

    .explore-image img {
      transform: rotate(0deg);
      max-width: 80%;
    }

    h2 {
      font-size: 30px;
    }
    .review-box {
      width: 90%;
    }
    .review-back1 {
      width: 85%;
      margin-top: -80px;
    }
    .review-back2 {
      width: 80%;
      margin-top: -100px;
    }
    .review-detail {
      margin-left: 0;
      text-align: center;
    }
    .review-box .profile {
      justify-content: center;
    }
  }

  @media (max-width: 480px) {
    h1 {
      font-size: 32px;
    }
    
    nav {
      padding: 15px 20px;
    }
    
    nav img {
      height: 30px;
    }

    .btn-beli {
      padding: 15px 25px;
      font-size: 18px;
    }
  }

</style>

<div id="star-container"></div>

<header>
  <nav>
    <img src="asset/Logo.png" alt="DYROOM">
    <a href="?url=view">
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

  <section class="slider-wrapper reveal">
    <a href="view.php">
      <i class="bi bi-grid-fill" id="lookall"></i>
    </a>
    
    <div class="slider-nav">
      <button id="prevBtn">&lt;</button>
      <button id="nextBtn">&gt;</button>
    </div>

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
          <p class="nama-gambar">Bugatti Chiron 2</p>
        </div>
        <div class="produk-detail">
          <p class="nama-detail">Bugatti Chiron 2</p>
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
          <p class="nama-gambar">Bugatti Chiron 3</p>
        </div>
        <div class="produk-detail">
          <p class="nama-detail">Bugatti Chiron 3</p>
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
      <a href="#" style="pointer-events: none;" class="active"></a> 
      <a href="#" style="pointer-events: none;"></a>
      <a href="#" style="pointer-events: none;"></a>
    </div>
  </section>

  <section class="explore reveal">
    <div class="explore-container">
      <div class="explore-text">
        <h2>WHO <span style="color: #FF9D00;">ARE WE?</span></h2>
        <p>
          DYROOM bukan sekadar showroom, ini adalah gerbang menuju impian otomotif Anda. 
          Kami mengkurasi koleksi hypercar dan luxury car terbaik di dunia, mulai dari 
          Bugatti hingga seri langka lainnya. Kualitas, performa, dan prestise adalah 
          bahasa yang kami gunakan. Temukan kendaraan yang mendefinisikan jati diri Anda sekarang.
        </p>
        <a href="?url=view" class="btn-explore">
          EXPLORE NOW <i class="bi bi-arrow-right"></i>
        </a>
      </div>
      
      <div class="explore-image">
        <img src="asset/barang/bugatti_bagus_png.png" alt="Luxury Car Showcase">
      </div>
    </div>
  </section>

  <section class="review reveal">
    <h2>RE<span style="color: #FF9D00;">VIEW</span></h2>
   
    <div class="review-container">
      <div class="review-box">
        <div class="profile">
          <img src="asset/profile-kotak.png" alt="profile picture of Suregar">
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

<script>
  const slider = document.getElementById('produkSlider');
  const cards = document.querySelectorAll('.card');
  const dots = document.querySelectorAll('.slider-line a');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  let currentIndex = 0;
  let autoSlideInterval;

  function goToSlide(index) {
    if (index < 0) index = cards.length - 1;
    if (index >= cards.length) index = 0;

    const targetCard = cards[index];
    if (targetCard) {
      slider.scrollTo({
        left: targetCard.offsetLeft - slider.offsetLeft,
        behavior: 'smooth'
      });
    }
    currentIndex = index;
    updateDots();
  }

  function updateDots() {
    dots.forEach((dot, i) => {
      dot.classList.toggle('active', i === currentIndex);
    });
  }

  function nextSlide() {
    goToSlide(currentIndex + 1);
  }
  function prevSlide() {
    goToSlide(currentIndex - 1);
  }

  prevBtn.addEventListener('click', () => {
    prevSlide();
    resetAutoSlide();
  });
  nextBtn.addEventListener('click', () => {
    nextSlide();
    resetAutoSlide();
  });

  dots.forEach((dot, i) => {
    dot.addEventListener('click', (e) => {
      e.preventDefault();
      goToSlide(i);
      resetAutoSlide();
    });
  });

  const observerOptions = {
    root: slider, 
    rootMargin: '0px',
    threshold: 0.6 
  };

  const slideObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const intersectingCard = entry.target;
        const newIndex = Array.from(cards).indexOf(intersectingCard);
        if (newIndex !== -1) {
          currentIndex = newIndex;
          updateDots();
        }
      }
    });
  }, observerOptions);

  cards.forEach(card => slideObserver.observe(card));

  function startAutoSlide() {
    autoSlideInterval = setInterval(nextSlide, 20000);
  }

  function resetAutoSlide() {
    clearInterval(autoSlideInterval);
    startAutoSlide();
  }

  startAutoSlide();


  function revealOnScroll() {
    const reveals = document.querySelectorAll('.reveal');
    const revealObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('active');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });
    reveals.forEach(reveal => revealObserver.observe(reveal));
  }
  revealOnScroll();


  document.addEventListener("DOMContentLoaded", () => {
    const starContainer = document.getElementById('star-container');
    const starCount = 150;

    for (let i = 0; i < starCount; i++) {
      const star = document.createElement('div');
      star.classList.add('star');
      
      const x = Math.random() * 100;
      const y = Math.random() * 100;
      
      const size = Math.random() * 2 + 1;
      
      const duration = Math.random() * 3 + 2;
      
      star.style.left = `${x}%`;
      star.style.top = `${y}%`;
      star.style.width = `${size}px`;
      star.style.height = `${size}px`;
      star.style.setProperty('--duration', `${duration}s`);
      
      starContainer.appendChild(star);
    }
  });
  
</script>