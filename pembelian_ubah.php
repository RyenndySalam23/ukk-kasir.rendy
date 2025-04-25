<?php 
$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id_penjualan = '$id'"));

if (isset($_POST['update'])) {
    $bayar = $_POST['bayar'];
    $total = $data['total_harga'];
    $kembalian = $bayar - $total;
    $status = ($bayar >= $total) ? 'Lunas' : 'Belum Lunas';

    $query = mysqli_query($koneksi, "UPDATE penjualan SET 
        bayar = '$bayar',
        kembalian = '$kembalian',
        status_pembayaran = '$status' 
        WHERE id_penjualan = '$id'");

    if ($query) {
        echo '<script>alert("Data pembayaran berhasil diperbarui!"); window.location.href="?page=pembelian";</script>';
    } else {
        echo '<script>alert("Gagal memperbarui data pembayaran!");</script>';
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-edit me-2"></i>Edit Transaksi</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="?page=pembelian">Pembelian</a></li>
        <li class="breadcrumb-item active">Edit Transaksi</li>
    </ol>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-warning text-dark fw-semibold">
            Informasi Transaksi
        </div>
        <div class="card-body">
            <form method="post">
                <h5 class="mb-3">Detail Produk Dibeli</h5>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $detail = mysqli_query($koneksi, "SELECT * FROM detail_penjualan 
                            LEFT JOIN produk ON produk.id_produk = detail_penjualan.id_produk 
                            WHERE id_penjualan = '$id'");
                        while ($row = mysqli_fetch_array($detail)) {
                        ?>
                            <tr class="text-center align-middle">
                                <td class="text-start"><?= $row['nama_produk']; ?></td>
                                <td>Rp <?= number_format($row['harga']); ?></td>
                                <td><?= $row['jumlah_produk']; ?></td>
                                <td>Rp <?= number_format($row['sub_total']); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

                <h5 class="mb-3">Pembayaran</h5>
                <table class="table table-bordered">
                    <tr>
                        <td>Total Harga</td>
                        <td>
                            <input type="number" name="total_harga" id="total" value="<?= $data['total_harga']; ?>" class="form-control" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Bayar</td>
                        <td>
                            <input type="number" name="bayar" id="bayar" value="<?= $data['bayar']; ?>" class="form-control" required oninput="hitungKembalianDanStatus()">
                        </td>
                    </tr>
                    <tr>
                        <td>Kembalian</td>
                        <td>
                            <input type="number" id="kembalian" class="form-control" value="<?= $data['kembalian']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Status Pembayaran</td>
                        <td>
                            <input type="text" id="status_text" class="form-control" value="<?= $data['status_pembayaran']; ?>" readonly>
                            <input type="hidden" name="status_pembayaran" id="status_pembayaran" value="<?= $data['status_pembayaran']; ?>">
                        </td>
                    </tr>
                </table>

                <div class="d-flex justify-content-between mt-3">
                    <a href="?page=pembelian" class="btn btn-danger">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <div>
                        <button type="reset" class="btn btn-danger me-2">Reset</button>
                        <button type="submit" name="update" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const totalInput = document.getElementById('total');
    const bayarInput = document.getElementById('bayar');
    const kembalianInput = document.getElementById('kembalian');
    const statusText = document.getElementById('status_text');
    const statusHidden = document.getElementById('status_pembayaran');

    function hitungKembalianDanStatus() {
        const total = parseFloat(totalInput.value) || 0;
        const bayar = parseFloat(bayarInput.value) || 0;
        let kembalian = 0;

        if (bayar >= total) {
            kembalian = bayar - total;
        }

        kembalianInput.value = kembalian;
        const status = (bayar >= total && bayar > 0) ? "Lunas" : "Belum Lunas";
        statusText.value = status;
        statusHidden.value = status;
        statusText.style.color = (status === "Lunas") ? "green" : "orange";
        statusText.style.fontWeight = "bold";
    }

    bayarInput.addEventListener('input', hitungKembalianDanStatus);
});
</script>
