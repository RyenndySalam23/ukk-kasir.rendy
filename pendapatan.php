<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-chart-line me-2"></i>Laporan Pendapatan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Hasil Pendapatan</li>
    </ol>

    <?php
    include 'koneksi.php';

    // Proses hapus data
    if (isset($_GET['hapus'])) {
        $tanggal = $_GET['hapus'];
        mysqli_query($koneksi, "DELETE FROM pendapatan_harian WHERE tanggal = '$tanggal'");
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data pendapatan tanggal <strong>' . $tanggal . '</strong> berhasil dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    // Sinkronisasi data
    $query = mysqli_query($koneksi, "SELECT tanggal_penjualan, SUM(total_harga) AS total_pendapatan
                                     FROM penjualan
                                     WHERE status_pembayaran = 'Lunas'
                                     GROUP BY tanggal_penjualan
                                     ORDER BY tanggal_penjualan DESC");
    while ($data = mysqli_fetch_array($query)) {
        $tanggal = $data['tanggal_penjualan'];
        $total = $data['total_pendapatan'];
        $cek = mysqli_query($koneksi, "SELECT * FROM pendapatan_harian WHERE tanggal = '$tanggal'");
        if (mysqli_num_rows($cek) == 0) {
            mysqli_query($koneksi, "INSERT INTO pendapatan_harian (tanggal, total_pendapatan) VALUES ('$tanggal', '$total')");
        } else {
            mysqli_query($koneksi, "UPDATE pendapatan_harian SET total_pendapatan = '$total' WHERE tanggal = '$tanggal'");
        }
    }

    // Hitung total keseluruhan, minggu ini, dan bulan ini
    $totalAll = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(total_pendapatan) AS total FROM pendapatan_harian"))['total'];
    $totalWeek = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(total_pendapatan) AS total FROM pendapatan_harian WHERE WEEK(tanggal, 1) = WEEK(CURDATE(), 1) AND YEAR(tanggal) = YEAR(CURDATE())"))['total'];
    $totalMonth = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(total_pendapatan) AS total FROM pendapatan_harian WHERE MONTH(tanggal) = MONTH(CURDATE()) AND YEAR(tanggal) = YEAR(CURDATE())"))['total'];
    ?>

    <!-- Ringkasan Pendapatan -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body text-center">
                    <h6 class="fw-bold text-muted mb-1">Total Seluruh</h6>
                    <h4 class="text-success">Rp <?= number_format($totalAll, 0, ',', '.'); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body text-center">
                    <h6 class="fw-bold text-muted mb-1">Minggu Ini</h6>
                    <h4 class="text-primary">Rp <?= number_format($totalWeek, 0, ',', '.'); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body text-center">
                    <h6 class="fw-bold text-muted mb-1">Bulan Ini</h6>
                    <h4 class="text-warning">Rp <?= number_format($totalMonth, 0, ',', '.'); ?></h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-success text-white fw-bold">
            <i class="fas fa-table me-1"></i> Daftar Pendapatan Harian
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0" id="pendapatanTable">
                    <thead class="table-secondary text-center">
                        <tr>
                            <th class="text-center" width="50">No</th>
                            <th class="text-start">Tanggal</th>
                            <th class="text-end">Total Pendapatan</th>
                            <th class="text-center" width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($koneksi, "SELECT * FROM pendapatan_harian ORDER BY tanggal DESC");
                        $no = 1;
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-start"><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                <td class="text-end">Rp <?= number_format($row['total_pendapatan'], 0, ',', '.'); ?></td>
                                <td class="text-center">
                                    <a href="?page=pendapatan&hapus=<?= $row['tanggal']; ?>" class="btn btn-sm btn-danger"
                                       onclick="return confirm('Yakin ingin menghapus data tanggal <?= date('d-m-Y', strtotime($row['tanggal'])); ?>?')">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
