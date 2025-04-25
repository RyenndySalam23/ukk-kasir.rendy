<?php
include "koneksi.php"; 
?>

<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-address-book"></i> Kelola Pelanggan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Kelola Pelanggan</li>
    </ol>

    <!-- Tombol Tambah -->
    <div class="mb-3">
        <a href="?page=pelanggan_tambah" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Tambah Pelanggan
        </a>
    </div>

    <!-- Filter Pencarian -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari nama, alamat, atau telepon...">
    </div>

    <!-- Tabel Pelanggan -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <strong><i class="fas fa-users"></i> Daftar Pelanggan</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0" id="pelangganTable">
                    <thead class="table-secondary text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= htmlspecialchars($data['nama_pelanggan']); ?></td>
                                <td><?= htmlspecialchars($data['alamat']); ?></td>
                                <td><?= htmlspecialchars($data['no_telpon']); ?></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-between">
                                        <a href="?page=pelanggan_ubah&id=<?= $data['id_pelanggan']; ?>" class="btn btn-sm btn-warning me-2">
                                            <i class="fas fa-edit"></i> Ubah
                                        </a>
                                        <a href="?page=pelanggan_hapus&id=<?= $data['id_pelanggan']; ?>" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i> Hapus
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

<!-- Script JavaScript untuk pencarian -->
<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        const input = this.value.toLowerCase();
        const rows = document.querySelectorAll("#pelangganTable tbody tr");

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(input) ? "" : "none";
        });
    });
</script>
