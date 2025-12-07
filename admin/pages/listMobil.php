<?php
if (!isset($mobils) || !is_array($mobils)) {
    echo "<div class='alert alert-danger'>Data mobil tidak ada</div>";
    return;
}
?>

<div class="table-wrapper">
    <h2 class="table-title">Daftar Mobil</h2>

    <?php if (empty($mobils)): ?>
        <div class="alert alert-info">Belum ada mobil yang ditambahkan <a href="?url=add">Tambah Mobil Baru</a>.</div>
    <?php else: ?>
        <table class="custom-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Mobil</th>
                    <th>Harga</th>
                    <th>Seri</th>
                    <th>Tipe</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mobils as $mobil): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($mobil['id']); ?></td>
                        <td><strong><?php echo htmlspecialchars($mobil['nama_car']); ?></strong></td>
                        <td class="price-tag">Rp <?php echo number_format($mobil['harga'], 0, ',', '.'); ?></td>
                        <td><?php echo htmlspecialchars($mobil['seri']); ?></td>
                        <td><?php echo htmlspecialchars($mobil['tipe']); ?></td>
                        <td>
                            <a href="?url=editMobil&id=<?php echo $mobil['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="?url=deleteMobil&id=<?php echo $mobil['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('yakin mau menghapus mobil ini?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
