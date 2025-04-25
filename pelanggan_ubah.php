<?php
$id = $_GET['id'];

if (isset($_POST['nama_pelanggan'])) {
    $nama = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $no_telpon = $_POST['no_telpon'];

    $query = mysqli_query($koneksi, "UPDATE pelanggan 
                                     SET nama_pelanggan='$nama', alamat='$alamat', no_telpon='$no_telpon' 
                                     WHERE id_pelanggan='$id'");
    if ($query) {
        echo '<script>alert("Ubah Data Berhasil"); location.href="?page=pelanggan";</script>';
    } else {
        echo '<script>alert("Ubah Data Gagal");</script>';
    }
}

$query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
$data = mysqli_fetch_array($query);
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Pelanggan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ubah Data Pelanggan</li>
    </ol>

    <a href="?page=pelanggan" class="btn btn-danger mb-3">Kembali</a>

    <form method="post">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th width="200">Nama Pelanggan</th>
                    <td><input type="text" name="nama_pelanggan" class="form-control" value="<?= $data['nama_pelanggan']; ?>" required></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><textarea name="alamat" class="form-control" rows="3" required><?= $data['alamat']; ?></textarea></td>
                </tr>
                <tr>
                    <th>No. Telepon</th>
                    <td><input type="text" name="no_telpon" class="form-control" value="<?= $data['no_telpon']; ?>" required></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
