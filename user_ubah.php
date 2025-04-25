<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id_user = $_GET['id'];
    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = $id_user");
    $data = mysqli_fetch_array($result);
}

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $data['password'];
    $level = $_POST['level'];

    $query = "UPDATE user SET nama = '$nama', username = '$username', password = '$password', level = '$level' WHERE id_user = $id_user";
    if (mysqli_query($koneksi, $query)) {
        echo '<script>alert("Data pengguna berhasil diperbarui."); window.location.href="?page=user_kelola";</script>';
    } else {
        echo '<div class="alert alert-danger">Gagal memperbarui data pengguna.</div>';
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Edit User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="?page=user_kelola">User</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>

    <div class="card shadow-sm">
    <div class="card-header text-white" style="background-color: #fd7e14;">
            <i class="fas fa-user-edit me-1"></i> Form Edit User
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" value="<?= $data['nama']; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" value="<?= $data['username']; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password <small>(Kosongkan jika tidak ingin diubah)</small></label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="level" class="form-label">Level</label>
                    <select name="level" id="level" class="form-select" required>
                        <option value="Admin" <?= $data['level'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="Kasir" <?= $data['level'] == 'Kasir' ? 'selected' : ''; ?>>Kasir</option>
                        <option value="Manajer" <?= $data['level'] == 'Manajer' ? 'selected' : ''; ?>>Manajer</option>
                    </select>
                </div>
                <div class="text-end">
                    <button type="submit" name="update" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                    <a href="?page=user_kelola" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
