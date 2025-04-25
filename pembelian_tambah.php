<?php 
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pelanggan = $_POST['id_pelanggan'];
    $bayar = $_POST['bayar'];
    $status_pembayaran = $_POST['status_pembayaran'];
    $id_pegawai = $_POST['id_pegawai'];


    $tanggal_penjualan = date('Y-m-d H:i:s');
    $total_harga = 0;

    // Hitung total harga dan persiapkan data produk
    $produk_data = [];
    foreach ($_POST['produk'] as $id_produk => $jumlah) {
        if ($jumlah > 0) {
            $query_produk = mysqli_query($koneksi, "SELECT harga FROM produk WHERE id_produk = '$id_produk'");
            $produk = mysqli_fetch_assoc($query_produk);
            $harga = $produk['harga'];
            $sub_total = $harga * $jumlah;

            $produk_data[] = [
                'id_produk' => $id_produk,
                'jumlah' => $jumlah,
                'harga' => $harga,
                'sub_total' => $sub_total
            ];

            $total_harga += $sub_total;
        }
    }

    $kembalian = $bayar - $total_harga;
    if ($kembalian < 0) $kembalian = 0;

    // Simpan ke tabel penjualan
    $insert_penjualan = mysqli_query($koneksi, "INSERT INTO penjualan (tanggal_penjualan, id_pelanggan, total_harga, bayar, kembalian, status_pembayaran, id_pegawai) VALUES ('$tanggal_penjualan', '$id_pelanggan', '$total_harga', '$bayar', '$kembalian', '$status_pembayaran', '$id_pegawai')");

    if ($insert_penjualan) {
        $id_penjualan = mysqli_insert_id($koneksi);

        // Simpan ke tabel penjualan_detail dan update stok produk
        foreach ($produk_data as $item) {
            $id_produk = $item['id_produk'];   
            $jumlah = $item['jumlah'];
            $sub_total = $item['sub_total'];

            mysqli_query($koneksi, "INSERT INTO detail_penjualan (id_penjualan, id_produk, jumlah_produk, sub_total, id_pegawai) VALUES ('$id_penjualan', '$id_produk', '$jumlah', '$sub_total', '$id_pegawai')");

            mysqli_query($koneksi, "UPDATE produk SET stock = stock - $jumlah WHERE id_produk = '$id_produk'");
        }

        echo "<script>alert('Transaksi berhasil disimpan.'); window.location='?page=pembelian';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data.'); window.location='?page=pembelian_tambah';</script>";
    }
}
?>



<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-shopping-cart me-2"></i>Tambah Pembelian</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="?page=pembelian">Pembelian</a></li>
        <li class="breadcrumb-item active">Tambah Pembelian</li>
    </ol>

    <div class="card shadow-sm mb-4">
    <div class="card-header text-white" style="background-color: #198754;">
            Form Tambah Pembelian
        </div>
        <div class="card-body">
            <form method="post" id="formPembelian">
                <div class="mb-3">
                    <label for="id_pelanggan" class="form-label">Nama Pelanggan</label>
                    <select class="form-control form-select" name="id_pelanggan" required>
                        <?php
                        $p = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                        while ($pel = mysqli_fetch_array($p)) {
                            echo "<option value='{$pel['id_pelanggan']}'>{$pel['nama_pelanggan']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id_pelanggan" class="form-label">Nama Pegawai</label>
                    <select class="form-control form-select" name="id_pegawai" required>
                        <?php
                        $p = mysqli_query($koneksi, "SELECT * FROM pegawai");
                        while ($pel = mysqli_fetch_array($p)) {
                            echo "<option value='{$pel['id_pegawai']}'>{$pel['nama_pegawai']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Daftar Produk</label>
                    <table class="table table-bordered table-striped">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $pro = mysqli_query($koneksi, "SELECT * FROM produk");
                            while ($produk = mysqli_fetch_array($pro)) {
                                $foto = !empty($produk['foto']) ? $produk['foto'] : 'default.jpg';
                            ?>
                                <tr class="align-middle text-center">
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <img src="assets/img/produk/<?= htmlspecialchars($foto); ?>" alt="Foto Produk"
                                            width="60" height="60" class="rounded shadow-sm border">
                                    </td>
                                    <td class="text-start"><?= htmlspecialchars($produk['nama_produk']); ?></td>
                                    <td>Rp<?= number_format($produk['harga']); ?></td>
                                    <td><?= $produk['stock']; ?></td>
                                    <td>
                                        <input class="form-control jumlah" type="number" min="0" max="<?= $produk['stock']; ?>"
                                            data-harga="<?= $produk['harga']; ?>"
                                            name="produk[<?= $produk['id_produk']; ?>]" value="0">
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="mb-3">
                    <label for="total" class="form-label">Total Harga</label>
                    <input type="text" id="total" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label for="bayar" class="form-label">Bayar</label>
                    <input type="number" name="bayar" id="bayar" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="kembalian" class="form-label">Kembalian</label>
                    <input type="text" id="kembalian" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label for="status_text" class="form-label">Status Pembayaran</label>
                    <input type="text" id="status_text" class="form-control" value="Belum Lunas" readonly>
                    <input type="hidden" name="status_pembayaran" id="status_pembayaran" value="Belum Lunas">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="?page=pembelian" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                    <div>
                        <button type="reset" class="btn btn-danger me-2">Reset</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const jumlahInputs = document.querySelectorAll('.jumlah');
    const totalInput = document.getElementById('total');
    const bayarInput = document.getElementById('bayar');
    const kembalianInput = document.getElementById('kembalian');
    const statusText = document.getElementById('status_text');
    const statusHidden = document.getElementById('status_pembayaran');

    function hitungTotal() {
        let total = 0;
        jumlahInputs.forEach(input => {
            const harga = parseFloat(input.dataset.harga);
            const qty = parseFloat(input.value) || 0;
            total += harga * qty;
        });
        totalInput.value = total.toLocaleString('id-ID');
        return total;
    }

    function hitungKembalian() {
        const total = hitungTotal();
        const bayar = parseFloat(bayarInput.value) || 0;
        let kembalian = 0;

        if (bayar >= total) {
            kembalian = bayar - total;
        }

        kembalianInput.value = kembalian.toLocaleString('id-ID');

        const status = (bayar >= total && bayar > 0) ? "Lunas" : "Belum Lunas";
        statusText.value = status;
        statusHidden.value = status;
        statusText.style.color = (status === "Lunas") ? "green" : "orange";
        statusText.style.fontWeight = "bold";
    }

    jumlahInputs.forEach(input => input.addEventListener('input', hitungKembalian));
    bayarInput.addEventListener('input', hitungKembalian);
});
</script>
