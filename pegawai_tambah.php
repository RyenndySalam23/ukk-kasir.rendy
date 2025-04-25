<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pegawai = mysqli_real_escape_string($koneksi, $_POST['nama_pegawai']);

    $query = mysqli_query($koneksi, "INSERT INTO pegawai (nama_pegawai) VALUES ('$nama_pegawai')");

    if ($query) {
        echo "<script>alert('Data pegawai berhasil ditambahkan.'); window.location='?page=pegawai';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data pegawai.');</script>";
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Pegawai</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="?page=pegawai">Pegawai</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            Form Tambah Pegawai
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                    <input type="text" name="nama_pegawai" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="?page=pegawai" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
