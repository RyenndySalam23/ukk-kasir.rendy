<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM penjualan 
    LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan 
    WHERE id_penjualan = $id");
$data = mysqli_fetch_array($query);

$pegawai_query = mysqli_query($koneksi, "SELECT nama_pegawai FROM pegawai WHERE id_pegawai = " . $data['id_pegawai']);
$pegawai = mysqli_fetch_array($pegawai_query);

$detail = mysqli_query($koneksi, "SELECT * FROM detail_penjualan 
    LEFT JOIN produk ON produk.id_produk = detail_penjualan.id_produk 
    WHERE id_penjualan = $id");

// Link WhatsApp
$whatsapp_link = "https://wa.me/6281326400035";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembelian</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        font-size: 13px;
        color: #333;
    }

    .struk {
        width: 360px;
        margin: 30px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px dashed #999;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        font-size: 20px;
        margin: 0 0 4px;
        font-weight: bold;
    }

    .info {
        text-align: center;
        font-size: 12px;
        margin-bottom: 10px;
        color: #666;
    }

    .line {
        border-top: 1px dashed #999;
        margin: 10px 0;
    }

    table {
        width: 100%;
        font-size: 13px;
    }

    td {
        padding: 3px 0;
        vertical-align: top;
    }

    .item-row td:first-child {
        width: 60%;
    }

    .item-row td:last-child {
        text-align: right;
    }

    .total-row td {
        font-weight: bold;
        border-top: 1px solid #ccc;
        padding-top: 6px;
    }

    .footer {
        text-align: center;
        font-size: 11px;
        color: #888;
        margin-top: 10px;
        font-style: italic;
    }

    .qr {
        text-align: center;
        margin-top: 15px;
    }
    .qr img {
        width: 100px;
        height: 100px;
    }

    .center {
        text-align: center;
    }
    </style>
</head>
<body onload="window.print()">
    <div class="struk">
        <h2>Cafe Rendy</h2>
        <div class="center">Jl. Contoh Alamat No.123</div>
        <div class="center">Telp: 0813-2640-0035</div>
        <div class="line"></div>
        <td style="text-align:right;">Tanggal : <?= $data['tanggal_penjualan']; ?></td><br>
        <td style="text-align:right;">Pelanggan : <?= $data['nama_pelanggan']; ?></td><br>
        <td style="text-align:right;">Kasir : <?= $pegawai['nama_pegawai']; ?></td><br>
        <td style="text-align:right;">Status : <?= $data['status_pembayaran']; ?></td><br>
        <div class="line"></div>

        <table>
            <?php while ($row = mysqli_fetch_array($detail)) { ?>
            <tr>
                <td colspan="2"><?= $row['nama_produk']; ?></td>
            </tr>
            <tr>
                <td><?= $row['jumlah_produk']; ?> x Rp<?= number_format($row['harga']); ?></td>
                <td style="text-align:right;">Rp<?= number_format($row['sub_total']); ?></td>
            </tr>
            <?php } ?>
        </table>

        <div class="line"></div>
        <table>
            <tr>
                <td><strong>Total</strong></td>
                <td style="text-align:right;"><strong>Rp<?= number_format($data['total_harga']); ?></strong></td>
            </tr>
            <tr>
                <td>Bayar</td>
                <td style="text-align:right;">Rp<?= number_format($data['bayar']); ?></td>
            </tr>
            <tr>
                <td>Kembalian</td>
                <td style="text-align:right;">Rp<?= number_format($data['kembalian']); ?></td>
            </tr>
        </table>

        <div class="line"></div>
        <p class="center">-- TERIMA KASIH --</p>

        <div class="qr">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=<?= urlencode($whatsapp_link); ?>" alt="QR Code WhatsApp">
            <div style="font-size:11px; color:#777; margin-top:4px;">Scan untuk menghubungi cafe jika</div>
            <div style="font-size:11px; color:#777; margin-top:4px;">memiliki masalah dalam transaksi</div>
        </div>
    </div>
</body>
</html>
