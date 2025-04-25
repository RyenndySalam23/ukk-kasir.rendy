<?php 
include "koneksi.php";  

if (isset($_POST['nama_produk'])) {
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];   

    // Inisialisasi nama file
    $nama_file = '';

    // Jika ada foto yang diupload
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $ext = pathinfo($foto, PATHINFO_EXTENSION);
        $nama_file = uniqid() . '.' . $ext;
        $folder = 'assets/img/produk/' . $nama_file;

        // Pindahkan file ke folder tujuan
        if (!move_uploaded_file($tmp, $folder)) {
            echo '<script>alert("Upload foto gagal."); window.history.back();</script>';
            exit;
        }
    }
    
    $query = mysqli_query($koneksi, "INSERT INTO produk(nama_produk, harga, stock, foto) VALUES('$nama', '$harga', '$stock', '$nama_file')");

    if ($query) {
        echo '<script>alert("Tambah Produk Berhasil"); window.location.href="?page=produk";</script>';
    } else {
        echo '<script>alert("Tambah Produk Gagal");</script>';
    }
}
?>


<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-plus me-2"></i>Tambah Produk</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="?page=produk">Produk</a></li>
        <li class="breadcrumb-item active">Tambah Produk</li>
    </ol>

    <div class="card shadow-sm mb-4">
    <div class="card-header text-white" style="background-color: #6f42c1;">
            Form Tambah Produk
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stok</label>
                    <input type="number" name="stock" id="stock" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Produk</label>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                </div>
                <div class="d-flex justify-content-between">
                    <a href="?page=produk" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                    <div>
                        <button type="reset" class="btn btn-danger me-2">Reset</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
