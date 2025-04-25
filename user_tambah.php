<?php 
if (isset($_POST['nama'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $cek = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> Username sudah digunakan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $query = mysqli_query($koneksi, "INSERT INTO user(nama, username, password, level) 
                                          VALUES('$nama', '$username', '$password_hash', '$level')");
        if ($query) {
            echo '<script>alert("Tambah User Berhasil"); window.location.href="?page=user_kelola";</script>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Tambah user gagal.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="?page=user_kelola">Kelola User</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>

    <div class="card shadow-sm">
    <div class="card-header text-white" style="background-color: #fd7e14;">
            Form Tambah User
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="level" class="form-label">Level</label>
                    <select name="level" id="level" class="form-select" required>
                        <option value="">-- Pilih Level --</option>
                        <option value="admin">Admin</option>
                        <option value="kasir">Kasir</option>
                        <option value="manajer">Manajer</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Simpan</button>
                <a href="?page=user_kelola" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
            </form>
        </div>
    </div>
</div>
