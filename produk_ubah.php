<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    echo '<script>alert("ID produk tidak ditemukan!"); location.href="?page=produk";</script>';
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id'");
if (mysqli_num_rows($query) == 0) {
    echo '<script>alert("Data produk tidak ditemukan!"); location.href="?page=produk";</script>';
    exit;
}
$data = mysqli_fetch_array($query);

if (isset($_POST['nama_produk'])) {
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];
    $fotoLama = $data['foto'];
    $folder = 'assets/img/produk/';

    // Proses upload jika ada file baru
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($ext, $allowed_ext)) {
            echo '<script>alert("Format gambar tidak didukung!"); window.history.back();</script>';
            exit;
        }

        $nama_file_baru = uniqid() . '.' . $ext;
        if (move_uploaded_file($tmp, $folder . $nama_file_baru)) {
            // Hapus foto lama
            if (!empty($fotoLama) && file_exists($folder . $fotoLama)) {
                unlink($folder . $fotoLama);
            }

            // Update dengan foto baru
            $query = mysqli_query($koneksi, "UPDATE produk SET nama_produk='$nama', harga='$harga', stock='$stock', foto='$nama_file_baru' WHERE id_produk='$id'");
        } else {
            echo '<script>alert("Upload foto gagal!"); window.history.back();</script>';
            exit;
        }
    } else {
        // Update tanpa ubah foto
        $query = mysqli_query($koneksi, "UPDATE produk SET nama_produk='$nama', harga='$harga', stock='$stock' WHERE id_produk='$id'");
    }

    if ($query) {
        echo '<script>alert("Ubah Produk Berhasil"); location.href="?page=produk";</script>';
    } else {
        echo '<script>alert("Ubah Produk Gagal");</script>';
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-edit me-2"></i>Edit Produk</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="?page=produk">Produk</a></li>
        <li class="breadcrumb-item active">Edit Produk</li>
    </ol>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-warning text-dark fw-semibold">
            Form Ubah Produk
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <table class="table table-bordered">
                    <tr>
                        <td>Nama Produk</td>
                        <td>
                            <input type="text" name="nama_produk" class="form-control" value="<?= htmlspecialchars($data['nama_produk']) ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>
                            <input type="number" name="harga" class="form-control" value="<?= $data['harga'] ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <td>
                            <input type="number" name="stock" class="form-control" value="<?= $data['stock'] ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Foto Produk</td>
                        <td>
                            <?php if (!empty($data['foto'])): ?>
                                <img src="assets/img/produk/<?= $data['foto'] ?>" alt="Foto Produk" class="img-thumbnail mb-2" style="max-width: 150px;">
                            <?php endif; ?>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                        </td>
                    </tr>
                </table>

                <div class="d-flex justify-content-between mt-3">
                    <a href="?page=produk" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <div>
                        <button type="reset" class="btn btn-danger me-2">Reset</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
