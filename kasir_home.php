<?php include 'koneksi.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mt-4 text-dark">
        <i class="fas fa-tachometer-alt me-2 text-primary"></i> Dashboard
    </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active text-muted">Dashboard</li>
    </ol>
</div>

<style>
    /* General Styling */
    body {
        background: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .glass-card {
        background: #ffffff;
        border-radius: 1.2rem;
        border: 1px solid #dee2e6;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        color: #333;
    }
    .glass-card:hover {
        transform: translateY(-8px);
    }
    .card-icon {
        font-size: 2.5rem;
        margin-right: 15px;
        color: #4e73df;
    }
    .dashboard-label {
        font-weight: bold;
        font-size: 1.5rem;
        color: #333;
    }

    /* Grid layout for statistics */
    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    /* Jam Styling - Removed the circle */
    .time-card {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .time-display {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
        background-color: #fff;
        padding: 10px 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Media Queries */
    @media (max-width: 768px) {
        .dashboard-label {
            font-size: 1.2rem;
        }
    }
</style>

<?php
    $jumlah_pelanggan = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pelanggan"));
    $jumlah_produk    = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk"));
    $jumlah_transaksi = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM penjualan"));
    $jumlah_user      = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user"));
    $jumlah_pegawai   = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pegawai"));
?>

<!-- Statistik Ringkas -->
<div class="card-container">
    <div class="glass-card p-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-users card-icon" style="color: #0d6efd;"></i>
            <div>
                <div class="dashboard-label"><?= $jumlah_pelanggan ?> Pelanggan</div>
                <a href="index.php?page=pelanggan" class="text-muted small">Lihat detail <i class="fas fa-angle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="glass-card p-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-boxes card-icon" style="color: #6f42c1;"></i>
            <div>
                <div class="dashboard-label"><?= $jumlah_produk ?> Produk</div>
                <a href="?" class="text-muted small" >(Akses Manajer) <i class="fas fa-angle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="glass-card p-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-shopping-cart card-icon" style="color: #198754;"></i>
            <div>
                <div class="dashboard-label"><?= $jumlah_transaksi ?> Transaksi</div>
                <a href="index.php?page=pembelian" class="text-muted small">Lihat detail <i class="fas fa-angle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="glass-card p-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-user-shield card-icon" style="color: #fd7e14;"></i>
            <div>
                <div class="dashboard-label"><?= $jumlah_user ?> User</div>
                <a href="?" class="text-muted small">(Akses Admin) <i class="fas fa-angle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="glass-card p-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-briefcase card-icon" style="color: #20c997;"></i>
            <div>
                <div class="dashboard-label"><?= $jumlah_pegawai ?> Pegawai</div>
                <a href="index.php?page=pegawai" class="text-muted small">(Akses Admin/Manajer)<i class="fas fa-angle-right"></i></a>
            </div>
        </div>
    </div>

    <!-- Jam -->
    <div class="time-card glass-card p-4">
        <div class="time-display" id="clockContainer"></div>
    </div>
</div>

<!-- Kalender & Quote -->
<div class="row mt-4 d-flex justify-content-center">
    <div class="col-lg-12 d-flex flex-column align-items-center">
        <div class="mt-4 text-center">
            <div id="calendarBox" class="mb-2 fw-semibold text-dark"></div>
            <div id="quoteBox" class="quote-display"></div>
        </div>
    </div>
</div>

<script>

    // Kalender
    function updateCalendar() {
        const calendarElement = document.getElementById('calendarBox');
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        calendarElement.textContent = now.toLocaleDateString('id-ID', options);
    }

    // Quote Harian (berganti setiap 4 detik)
    const quotes = [
        "Jangan takut gagal, karena kegagalan adalah awal dari kesuksesan.",
        "Kerja keras tidak akan mengkhianati hasil.",
        "Setiap hari adalah kesempatan baru untuk tumbuh.",
        "Jadilah versi terbaik dari dirimu hari ini.",
        "Keberhasilan dimulai dengan langkah kecil yang konsisten.",
        "Kesabaran dan ketekunan adalah kunci utama.",
        "Hidup bukan tentang menunggu badai reda, tapi belajar menari di tengah hujan."
    ];

    function showRandomQuote() {
        const quoteBox = document.getElementById('quoteBox');
        const randomIndex = Math.floor(Math.random() * quotes.length);
        quoteBox.textContent = quotes[randomIndex];
    }
    
    function updateClock() {
        const clockElement = document.getElementById('clockContainer');
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        clockElement.textContent = `${hours}:${minutes}:${seconds}`;
    }

    setInterval(updateClock, 1000);
    updateClock();
    updateCalendar();
    showRandomQuote();
    setInterval(showRandomQuote, 4000); // Ganti quote setiap 4 detik
</script>
