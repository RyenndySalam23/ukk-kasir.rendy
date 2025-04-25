<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-id-card-alt"></i> Kelola Pegawai</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Kelola Pegawai</li>
    </ol>

    <!-- Tombol Tambah -->
    <div class="mb-3">
        <a href="?page=pegawai_tambah" class="btn btn-primary"><i class="fas fa-user-plus"></i> Tambah Pegawai</a>
    </div>

    <!-- Filter Pencarian -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari nama pegawai...">
    </div>

    <!-- Tabel Pegawai -->
    <div class="card shadow mb-4">
    <div class="card-header text-white" style="background-color: #20c997;">
            <strong><i class="fas fa-user-tie" ></i> Daftar Pegawai</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0" id="pegawaiTable">
                    <thead class="table-secondary text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY nama_pegawai ASC");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= htmlspecialchars($data['nama_pegawai']); ?></td>
                                <td class="text-center">
                                        <a href="?page=pegawai_hapus&id=<?= $data['id_pegawai']; ?>"
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
        const rows = document.querySelectorAll("#pegawaiTable tbody tr");

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(input) ? "" : "none";
        });
    });
</script>
