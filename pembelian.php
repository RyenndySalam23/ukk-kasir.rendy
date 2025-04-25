<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-shopping-cart me-2"></i>Transaksi Pembelian</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Pembelian</li>
    </ol>

    <a href="?page=pembelian_tambah" class="btn btn-success mb-3">
        <i class="fas fa-plus me-1"></i> Tambah Data
    </a>

    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari pelanggan, tanggal, atau status...">

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-success text-white fw-bold">
            <i class="fas fa-table me-1"></i> Daftar Pembelian
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0" id="pelangganTable">
                    <thead class="table-secondary text-center">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Pelanggan</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th width="200px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM penjualan 
                                                         LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan 
                                                         ORDER BY tanggal_penjualan DESC");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $data['tanggal_penjualan']; ?></td>
                                <td><?= htmlspecialchars($data['nama_pelanggan']); ?></td>
                                <td>Rp <?= number_format($data['total_harga'], 0, ',', '.'); ?></td>
                                <td class="text-center">
                                    <span class="badge bg-<?= $data['status_pembayaran'] == 'Lunas' ? 'success' : 'warning'; ?>">
                                        <?= $data['status_pembayaran']; ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-between gap-2">
                                        <a href="?page=penjualan_detail&id=<?= $data['id_penjualan']; ?>" class="btn btn-sm btn-secondary">
                                            <i class="fas fa-info-circle"></i> Detail
                                        </a>
                                        <a href="struk.php?id=<?= $data['id_penjualan']; ?>" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fas fa-print"></i> Struk
                                        </a>
                                        <a href="?page=pembelian_ubah&id=<?= $data['id_penjualan'] ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Ubah
                                        </a>
                                        <a href="?page=penjualan_hapus&id=<?= $data['id_penjualan'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus pembelian ini?')">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#pelangganTable tbody tr');

    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});
</script>
