<?php
if (!isset($mobil) || !is_array($mobil)) {
    echo "<div class='alert alert-danger'>Data mobil tidak ditemukan</div>";
    return;
}
?>

<div class="form-wrapper">
    <h2 class="form-title">Edit Mobil: <?php echo htmlspecialchars($mobil['nama_car']); ?></h2>

    <form action="admin.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $mobil['id']; ?>">
        <input type="hidden" name="form_action" value="update_mobil">
        
        <div class="mb-3">
            <label for="nama_car" class="form-label">Nama Mobil</label>
            <input type="text" class="form-control" id="nama_car" name="nama_car" value="<?php echo htmlspecialchars($mobil['nama_car']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?php echo htmlspecialchars($mobil['harga']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="speed" class="form-label">Speed (km/h)</label>
            <input type="text" class="form-control" id="speed" name="speed" value="<?php echo htmlspecialchars($mobil['speed']); ?>">
        </div>
        <div class="mb-3">
            <label for="energy" class="form-label">Energy</label>
            <input type="text" class="form-control" id="energy" name="energy" value="<?php echo htmlspecialchars($mobil['energy']); ?>">
        </div>
        <div class="mb-3">
            <label for="seri" class="form-label">Seri</label>
            <input type="text" class="form-control" id="seri" name="seri" value="<?php echo htmlspecialchars($mobil['seri']); ?>">
        </div>
        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe</label>
            <input type="text" class="form-control" id="tipe" name="tipe" value="<?php echo htmlspecialchars($mobil['tipe']); ?>">
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"><?php echo htmlspecialchars($mobil['deskripsi']); ?></textarea>
        </div>
      
        <hr>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Utama</label>
            <p>Current: <img src="../asset/mobil/<?php echo htmlspecialchars($mobil['img_car']); ?>" width="100"></p>
            <input type="file" class="form-control" id="gambar" name="gambar">
            <input type="hidden" name="old_img_car" value="<?php echo htmlspecialchars($mobil['img_car']); ?>">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar utama.</small>
        </div>
        
        <div class="mb-3">
            <label for="gambar_detail" class="form-label">Gambar Detail</label>
            <p>Current: <img src="../asset/mobil/<?php echo htmlspecialchars($mobil['img_car_detail']); ?>" width="100"></p>
            <input type="file" class="form-control" id="gambar_detail" name="gambar_detail">
            <input type="hidden" name="old_img_car_detail" value="<?php echo htmlspecialchars($mobil['img_car_detail']); ?>">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar detail.</small>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Update Mobil</button>
        <a href="?url=listMobil" class="btn btn-secondary">Batal</a>
    </form>
</div>
