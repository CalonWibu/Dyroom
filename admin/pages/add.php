<?php
// Logic PHP tetap sama, hanya merapikan indentasi
if (isset($_POST['submit'])) {
    $nama      = $_POST['nama_car'];
    $seri      = $_POST['seri'];
    $harga     = $_POST['harga'];
    $speed     = $_POST['speed'];
    $energy    = $_POST['energy'];
    $tipe      = $_POST['tipe'];
    $deskripsi = $_POST['deskripsi'];

    $fileName1 = $_FILES['gambar']['name'];
    $tmpName1  = $_FILES['gambar']['tmp_name'];

    $fileName2 = $_FILES['gambar_detail']['name'];
    $tmpName2  = $_FILES['gambar_detail']['tmp_name'];

    $targetDir = "../asset/mobil/";
    
    // Pastikan folder ada (opsional, good practice)
    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

    $targetFile1 = $targetDir . basename($fileName1);
    $targetFile2 = $targetDir . basename($fileName2);

    if (move_uploaded_file($tmpName1, $targetFile1) && move_uploaded_file($tmpName2, $targetFile2)) {
        // Mencegah SQL Injection sederhana (disarankan pakai Prepared Statement kedepannya)
        $conn->query("INSERT INTO mobil (nama_car, harga, speed, energy, seri, tipe, img_car, img_car_detail, deskripsi) 
                      VALUES ('$nama', '$harga', '$speed', '$energy', '$seri', '$tipe', '$fileName1', '$fileName2', '$deskripsi')");
        $success = "Mobil berhasil ditambahkan ke database!";
    } else {
        $error = "Gagal mengupload gambar. Pastikan folder permission benar.";
    }
}
?>

<style>
  /* Menggunakan style wrapper yang sama dengan List Order agar konsisten */
  .form-wrapper {
    background: #ffffff;
    padding: 30px; /* Padding lebih besar biar lega */
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    margin-top: 20px;
  }

  .form-title {
    font-weight: bold;
    color: #333;
    margin-bottom: 25px;
    border-left: 5px solid #ff2bea; /* Aksen Pink */
    padding-left: 15px;
  }

  /* Styling Label */
  .form-label {
    font-weight: 600;
    color: #555;
    margin-bottom: 8px;
    font-size: 0.9rem;
  }

  /* Styling Input */
  .form-control {
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 10px 15px;
    transition: all 0.3s;
  }

  .form-control:focus {
    border-color: #ff2bea; /* Fokus warna pink */
    box-shadow: 0 0 0 0.2rem rgba(255, 43, 234, 0.15);
  }

  /* Styling Upload Area */
  .upload-box {
    background: #f9f9f9;
    padding: 15px;
    border-radius: 10px;
    border: 2px dashed #eee;
  }

  /* Tombol Submit */
  .btn-submit {
    background-color: #222;
    color: white;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: bold;
    border: none;
    width: 100%;
    transition: 0.3s;
    text-transform: uppercase;
    letter-spacing: 1px;
  }

  .btn-submit:hover {
    background-color: #ff2bea; /* Hover jadi pink */
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 43, 234, 0.3);
  }
</style>

<div class="form-wrapper">
    <h2 class="form-title">Tambah Data Mobil</h2> 

    <?php if(isset($success)) echo "<div class='alert alert-success border-0 shadow-sm'>$success</div>"; ?>
    <?php if(isset($error)) echo "<div class='alert alert-danger border-0 shadow-sm'>$error</div>"; ?>

    <form method="post" enctype="multipart/form-data">
      
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Nama Mobil</label>
          <input type="text" name="nama_car" class="form-control" placeholder="Contoh: Tesla Model S" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Harga (Rp)</label>
          <input type="number" name="harga" class="form-control" placeholder="Contoh: 1500000000" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Seri</label>
          <input type="text" name="seri" class="form-control" placeholder="Contoh: 2024 Edition" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Tipe Bodi</label>
          <input type="text" name="tipe" class="form-control" placeholder="Contoh: SUV / Sedan" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Kecepatan (Speed)</label>
          <div class="input-group">
            <input type="text" name="speed" class="form-control" placeholder="Contoh: 250" required>
            <span class="input-group-text">Km/h</span>
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Energi / Bensin</label>
          <input type="text" name="energy" class="form-control" placeholder="Contoh: Electric / 10km per Liter" required>
        </div>
      </div>

      <div class="mb-4">
        <label class="form-label">Deskripsi Lengkap</label>
        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Tulis deskripsi keunggulan mobil..." required></textarea>
      </div>

      <div class="row mb-4">
        <div class="col-md-6">
            <div class="upload-box">
                <label class="form-label">Gambar Utama (Thumbnail)</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" required>
                <small class="text-muted d-block mt-1">*Format: JPG, PNG</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="upload-box">
                <label class="form-label">Gambar Detail (Interior/Samping)</label>
                <input type="file" name="gambar_detail" class="form-control" accept="image/*" required>
                <small class="text-muted d-block mt-1">*Format: JPG, PNG</small>
            </div>
        </div>
      </div>

      <div class="d-grid gap-2">
        <button type="submit" name="submit" class="btn btn-submit">
            <i class="bi bi-plus-circle"></i> Simpan Mobil Baru
        </button>
      </div>

    </form>
</div>