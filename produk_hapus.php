<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    echo '<script>alert("ID produk tidak ditemukan!"); location.href="?page=produk";</script>';
    exit;
}

$id = $_GET['id'];

// Ambil data produk
$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id'");
if (mysqli_num_rows($query) == 0) {
    echo '<script>alert("Data produk tidak ditemukan!"); location.href="?page=produk";</script>';
    exit;
}

$data = mysqli_fetch_array($query);
$foto = $data['foto'];
$folder = 'assets/img/produk/';

// Hapus data produk
$hapus = mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk='$id'");

if ($hapus) {
    // Hapus foto jika ada dan file-nya eksis
    if (!empty($foto) && file_exists($folder . $foto)) {
        unlink($folder . $foto);
    }

    echo '<script>alert("Produk berhasil dihapus!"); location.href="?page=produk";</script>';
} else {
    echo '<script>alert("Gagal menghapus produk!"); location.href="?page=produk";</script>';
}
