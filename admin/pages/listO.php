<style>
.table-title {
  font-weight: bold;
  color: #333;
  margin-bottom: 25px;
  border-left: 5px solid #007bff;
  padding-left: 15px;
}
.price-tag {
  font-weight: bold;
  color: #28a745;
}
</style>

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
                <?php if (isset($orders) && count($orders) > 0): ?>
                    <?php foreach($orders as $row) { ?>
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