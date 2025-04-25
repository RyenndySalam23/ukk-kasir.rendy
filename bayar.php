<?php
include 'koneksi.php'; 

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id_penjualan = $id");
$data = mysqli_fetch_assoc($query);

$tanggal = $data['tanggal_penjualan'];
$total = $data['total_harga'];

$cek = mysqli_query($koneksi, "SELECT * FROM pendapatan_harian WHERE tanggal = '$tanggal' AND total_harga = '$total'");
if (mysqli_num_rows($cek) == 0) {
    mysqli_query($koneksi, "INSERT INTO pendapatan_harian (tanggal, total_harga) VALUES ('$tanggal', '$total')");
}

header("Location: adminpage.php?page=pembelian");
exit;
?>
