<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM pegawai WHERE id_pegawai=$id");
if($query) {
    echo '<script>alert("Hapus Data Berhasil"); location.href="?page=pegawai"</script>';
}            
else{
    echo '<script>alert("Hapus Data Gagal")</script>';
}