<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM pendapatan_harian WHERE id_pendapatan=$id");
if($query) {
    echo '<script>alert("Hapus Data Berhasil"); location.href="?page=pelanggan"</script>';
}            
else{
    echo '<script>alert("Hapus Data Gagal")</script>';
}