<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-boxes me-2"></i>Data Produk</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Produk</li>
    </ol>

    <div class="mb-3 d-flex justify-content-between align-items-center">
        <a href="?page=produk_tambah" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle me-1"></i> Tambah Produk
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered" id="datatablesSimple">
                <thead class="table-secondary text-center">
                    <tr>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM produk");
                    while ($data = mysqli_fetch_array($query)) {
                        $foto = !empty($data['foto']) ? $data['foto'] : 'default.jpg';
                    ?>
                    <tr class="align-middle text-center">
                        <td>
                            <img src="assets/img/produk/<?= htmlspecialchars($foto) ?>" alt="Foto Produk" width="60" class="img-thumbnail">
                        </td>
                        <td class="text-start"><?= htmlspecialchars($data['nama_produk']) ?></td>
                        <td>Rp <?= number_format($data['harga'], 0, ',', '.') ?></td>
                        <td><?= $data['stock'] ?></td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="?page=produk_ubah&id=<?= $data['id_produk'] ?>" class="btn btn-warning shadow-sm">
                                    <i class="fas fa-edit me-1"></i> Ubah
                                </a>
                                <a href="?page=produk_hapus&id=<?= $data['id_produk'] ?>" class="btn btn-danger shadow-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    <i class="fas fa-trash-alt me-1"></i> Hapus
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
