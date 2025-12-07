<style>
.form-wrapper {
  background: #ffffff;
  padding: 30px; 
  border-radius: 15px;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
  margin-top: 20px;
}

.form-title {
  font-weight: bold;
  color: #333;
  margin-bottom: 25px;
  border-left: 5px solid #ff2bea; 
  padding-left: 15px;
}

.form-label {
  font-weight: 600;
  color: #555;
  margin-bottom: 8px;
  font-size: 0.9rem;
}

.form-control {
  border-radius: 8px;
  border: 1px solid #ddd;
  padding: 10px 15px;
  transition: all 0.3s;
}

.form-control:focus {
  border-color: #ff2bea; 
  box-shadow: 0 0 0 0.2rem rgba(255, 43, 234, 0.15);
}

.upload-box {
  background: #f9f9f9;
  padding: 15px;
  border-radius: 10px;
  border: 2px dashed #eee;
}

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
  background-color: #ff2bea; 
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(255, 43, 234, 0.3);
}
</style>

<div class="form-wrapper">
    <h2 class="form-title">Tambah Mobil</h2> 

    <?php 
    $status = $_GET['status'] ?? '';
    if ($status == 'success') {
        echo "<div class='alert alert-success border-0 shadow-sm'>Mobil berhasil ditambahkan ke database!</div>";
    } elseif ($status == 'error_upload') {
        echo "<div class='alert alert-danger border-0 shadow-sm'>Gagal mengupload gambar. Pastikan folder permission benar.</div>";
    } elseif ($status == 'error_db') {
        echo "<div class='alert alert-danger border-0 shadow-sm'>Gagal menyimpan data ke database.</div>";
    }
    ?>

    <form method="post" enctype="multipart/form-data">
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Mobil</label>
                <input type="text" name="nama_car" class="form-control" placeholder="Contoh: Teoyota Flying Mewing" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" placeholder="Contoh: 1500000000" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Merek</label>
                <input type="text" name="seri" class="form-control" placeholder="Contoh: 2024 Edition" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">tipe body</label>
                <input type="text" name="tipe" class="form-control" placeholder="Contoh: SUV / Sedan / family car" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Kecepatan</label>
                <div class="input-group">
                    <input type="text" name="speed" class="form-control" placeholder="Contoh: 250" required>
                    <span class="input-group-text">Km/h</span>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Energi / Bensin</label>
                <input type="text" name="energy" class="form-control" placeholder="Bemsin, Baterai, lainnya" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Deskripsi Lengkap</label>
            <textarea name="deskripsi" class="form-control" rows="3" placeholder="deskripsi tentang mobil" required></textarea>
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
                    <label class="form-label">Gambar Detail</label>
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