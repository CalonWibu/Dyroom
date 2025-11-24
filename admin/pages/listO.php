<?php
// Query Data
$sql = "SELECT c.*, u.nama, u.email, m.nama_car, m.harga, m.seri 
        FROM personal c 
        JOIN users u ON c.id_pembeli = u.id
        JOIN mobil m ON c.id_mobil = m.id
        ORDER BY c.id_pembeli DESC"; // Order terbaru
$orders = $conn->query($sql);
?>

<div class="table-wrapper">
    <h2 class="table-title">Daftar Order Masuk</h2>
    
    <div class="table-responsive">
        <table class="table custom-table">
          <thead>
            <tr>
              <th>Nama User</th>
              <th>Email</th>
              <th>Mobil</th>
              <th class="text-center">Qty</th>
              <th>Total Harga</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($orders->num_rows > 0): ?>
                <?php while($row = $orders->fetch_assoc()) { ?>
                <tr>
                  <td>
                      <strong><?= htmlspecialchars($row['nama']); ?></strong>
                  </td>
                  <td>
                      <span class="email-text"><?= htmlspecialchars($row['email']); ?></span>
                  </td>
                  <td>
                      <?= htmlspecialchars($row['nama_car']); ?> 
                      <span class="badge bg-secondary" style="font-size: 0.7rem;"><?= htmlspecialchars($row['seri']); ?></span>
                  </td>
                  <td class="text-center">1</td>
                  <td>
                      <span class="price-tag">Rp<?= number_format($row['harga'], 0, ',', '.'); ?></span>
                  </td>
                </tr>
                <?php } ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">
                        <h4>Belum ada pesanan masuk.</h4>
                    </td>
                </tr>
            <?php endif; ?>
          </tbody>
        </table>
    </div>
</div>