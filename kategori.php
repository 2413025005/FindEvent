<?php
// kategori.php: Halaman untuk menampilkan event yang difilter

require_once 'koneksi.php'; // Menggunakan require_once untuk keandalan koneksi
require_once 'functions.php';

// --- LOGIKA PENGAMBILAN DATA DARI DATABASE ---

// 1. Ambil parameter 'tipe' dari URL
$tipe_url = isset($_GET['tipe']) ? strtolower($_GET['tipe']) : '';

// Jika tidak ada tipe yang valid, arahkan ke Beranda
if (empty($tipe_url) || !in_array($tipe_url, ['lomba', 'seminar', 'workshop'])) {
    header('Location: index.php');
    exit;
}

function getTitleCase($string) {
    return ucwords(str_replace('_', ' ', $string));
}

$judul_kategori = getTitleCase($tipe_url) . ' Kampus';

// Bersihkan input untuk keamanan database
$tipe_url_bersih = $koneksi->real_escape_string($tipe_url);

// 2. Definisikan Query SQL dengan klausa WHERE
$query = "SELECT id, judul, tanggal, waktu, lokasi, gambar, kategori, deadline 
          FROM event 
          WHERE kategori = '$tipe_url_bersih' 
          ORDER BY id DESC";

// 3. Jalankan Query
$result = $koneksi->query($query);

// Array untuk menampung data event
$filtered_events = []; 

if ($result && $result->num_rows > 0) {
    // Ambil semua hasil dan simpan dalam array asosiatif
    $filtered_events = $result->fetch_all(MYSQLI_ASSOC);
} 
// --- AKHIR LOGIKA DATABASE ---
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori <?php echo $judul_kategori; ?> – FindEvent</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">
      <img src="assets/logo.png" alt="Logo FindEvent">
      <span>FindEvent</span>
    </div>

    <nav>
      <a href="index.php" class="<?php echo is_active('index.php', null, 0, $koneksi) ? 'active' : ''; ?>">Beranda</a>
      <a href="kategori.php?tipe=lomba" class="<?php echo is_active('kategori.php', 'lomba', 0, $koneksi) ? 'active' : ''; ?>">Lomba</a>
      <a href="kategori.php?tipe=seminar" class="<?php echo is_active('kategori.php', 'seminar', 0, $koneksi) ? 'active' : ''; ?>">Seminar</a>
      <a href="kategori.php?tipe=workshop" class="<?php echo is_active('kategori.php', 'workshop', 0, $koneksi) ? 'active' : ''; ?>">Workshop</a>
      <a href="tentang.php" class="<?php echo is_active('tentang.php', null, 0, $koneksi) ? 'active' : ''; ?>">Tentang</a>
    </nav>
</header>

<main class="container">
    <h2 class="section-title">✨ Kategori: <?php echo $judul_kategori; ?></h2>
    
    <?php if (empty($filtered_events)): ?>
        <p class="text-center">Maaf, belum ada event di kategori <strong><?php echo $judul_kategori; ?></strong> saat ini.</p>
    <?php else: ?>
        <div class="event-grid">
            <?php 
            foreach ($filtered_events as $event): 
                
                // Panggil function status untuk Badge Timer
                $status = get_event_status($event['deadline']);
            ?>
                <div class="event-card" data-kategori="<?php echo $event['kategori']; ?>">
                    <span class="event-status <?php echo $status['class']; ?>">
                        <?php echo $status['text']; ?>
                    </span>
                    <img src="/<?php echo $event['gambar']; ?>" alt="<?php echo $event['judul']; ?>">
                    <div class="event-info">
                        <h3><?php echo $event['judul']; ?></h3>
                        <div class="event-meta">
                            <span>📅 <?php echo $event['tanggal']; ?></span>
                            <span>🕒 <?php echo $event['waktu']; ?></span>
                            <span>📍 <?php echo $event['lokasi']; ?></span>
                        </div>
                        <a href="detail.php?id=<?php echo $event['id']; ?>" class="btn">Baca Selengkapnya</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<footer>
    <div class="footer-container">
      <div class="footer-left">
        <img src="assets/logo.png" alt="Logo FindEvent">
        <h2>FindEvent</h2>
        <p>Temukan berbagai event kampus di Universitas Lampung seperti seminar, lomba, dan workshop mahasiswa.</p>
      </div>

      <div class="footer-right">
        <h3>Hubungi Kami</h3>
        <div class="social-icons">
          <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook"></a>
          <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram"></a>
          <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/5968/5968830.png" alt="X"></a>
          <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/3670/3670051.png" alt="WhatsApp"></a>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; 2025 FindEvent. Semua hak dilindungi.</p>
    </div>
</footer>
<script src="script.js"></script> 
</body>
</html>