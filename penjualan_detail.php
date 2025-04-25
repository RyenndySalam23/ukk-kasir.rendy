<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM penjualan 
    LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan 
    LEFT JOIN pegawai ON pegawai.id_pegawai = penjualan.id_pegawai
    WHERE id_penjualan = $id");
$data = mysqli_fetch_array($query);



?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Detail Pembelian</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="?page=pembelian">Pembelian</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
    <!-- Informasi Pegawai -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <strong>Informasi Pegawai</strong>
        </div>
        <div class="card-body">
            <table class="table table-sm table-borderless mb-0">
                <tr>
                    <th width="200">Nama Pegawai</th>
                    <td width="1">:</td>
                    <td><?= $data['nama_pegawai']; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <strong>Informasi Pelanggan</strong>
        </div>
        <div class="card-body">
            <table class="table table-sm table-borderless mb-0">
                <tr>
                    <th width="200">Nama Pelanggan</th>
                    <td width="1">:</td>
                    <td><?= $data['nama_pelanggan']; ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>:</td>
                    <td><?= $data['alamat']; ?></td>
                </tr>
                <tr>
                    <th>No. Telepon</th>
                    <td>:</td>
                    <td><?= $data['no_telpon']; ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <strong>Detail Produk</strong>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-bordered mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th width="100">Foto</th>
                        <th>Produk</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $pro = mysqli_query($koneksi, "SELECT * FROM detail_penjualan 
                        LEFT JOIN produk ON produk.id_produk = detail_penjualan.id_produk 
                        WHERE id_penjualan = $id");
                    while ($produk = mysqli_fetch_array($pro)) {
                    ?>    
                    <tr class="text-center align-middle">
                        <td>
                            <img src="assets/img/produk/<?= $produk['foto']; ?>" width="80" class="img-thumbnail" alt="<?= $produk['nama_produk']; ?>">
                        </td>
                        <td class="text-start"><?= $produk['nama_produk']; ?></td>
                        <td>Rp <?= number_format($produk['harga']); ?></td>
                        <td><?= $produk['jumlah_produk']; ?></td>
                        <td>Rp <?= number_format($produk['sub_total']); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-warning">
            <strong>Rincian Pembayaran</strong>
        </div>
        <div class="card-body">
            <table class="table table-sm table-borderless mb-0">
                <tr>
                    <th width="200">Total Harga</th>
                    <td width="1">:</td>
                    <td>Rp <?= number_format($data['total_harga']); ?></td>
                </tr>
                <tr>
                    <th>Bayar</th>
                    <td>:</td>
                    <td>Rp <?= number_format($data['bayar']); ?></td>
                </tr>
                <tr>
                    <th>Kembalian</th>
                    <td>:</td>
                    <td>Rp <?= number_format($data['kembalian']); ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>:</td>
                    <td>
                        <span class="badge bg-<?= $data['status_pembayaran'] == 'Lunas' ? 'success' : 'danger'; ?>">
                            <?= $data['status_pembayaran']; ?>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <a href="?page=pembelian" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
