<?php include "koneksi.php"; ?>

<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-user"></i> Kelola User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Kelola User</li>
    </ol>

    <!-- Tombol Tambah -->
    <div class="mb-3">
        <a href="?page=user_tambah" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Tambah User
        </a>
    </div>

    <!-- Filter Pencarian -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder=" Cari nama atau username...">
    </div>

    <!-- Tabel User -->
    <div class="card shadow mb-4">
    <div class="card-header text-white" style="background-color: #fd7e14;">
            <strong><i class="fas fa-users-cog"></i> Data User</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0" id="userTable">
                    <thead class="table-secondary text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Level</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM user ORDER BY nama ASC");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= htmlspecialchars($data['nama']); ?></td>
                                <td><?= htmlspecialchars($data['username']); ?></td>
                                <td><?= htmlspecialchars($data['password']); ?></td>
                                <td class="text-capitalize text-center"><?= htmlspecialchars($data['level']); ?></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-between">
                                        <a href="?page=user_ubah&id=<?= $data['id_user']; ?>" class="btn btn-sm btn-warning me-2">
                                            <i class="fas fa-edit"></i> Ubah
                                        </a>
                                        <a href="?page=user_hapus&id=<?= $data['id_user']; ?>"
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Yakin ingin menghapus data ini?')">
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

<!-- Script JavaScript untuk pencarian -->
<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        const input = this.value.toLowerCase();
        const rows = document.querySelectorAll("#userTable tbody tr");

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(input) ? "" : "none";
        });
    });
</script>
