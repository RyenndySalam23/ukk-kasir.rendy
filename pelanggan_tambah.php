<?php
if (isset($_POST['nama_pelanggan'])) {
    $nama = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $no_telpon = $_POST['no_telpon'];

    $cek = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE no_telpon='$no_telpon'");
    if (mysqli_num_rows($cek) > 0) {
        echo '<script>alert("Nomor telepon sudah digunakan oleh pelanggan lain!");</script>';
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO pelanggan(nama_pelanggan, alamat, no_telpon) 
                                         VALUES('$nama', '$alamat', '$no_telpon')");
        if ($query) {
            echo '<script>alert("Tambah Pelanggan Berhasil"); window.location.href="?page=pelanggan";</script>';
        } else {
            echo '<script>alert("Tambah Pelanggan Gagal");</script>';
        }
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Pelanggan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="?page=pelanggan">Pelanggan</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            Form Tambah Pelanggan
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="no_telpon" class="form-label">No. Telepon</label>
                    <input type="number" name="no_telpon" id="no_telpon" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
                <a href="?page=pelanggan" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
            </form>
        </div>
    </div>
</div>
