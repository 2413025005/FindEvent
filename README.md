<?php
// index.php: Halaman Utama (Beranda)

// Menggunakan require_once untuk keandalan koneksi database
require_once 'koneksi.php'; 
require_once 'functions.php'; 

// --- LOGIKA PENGAMBILAN DATA DARI DATABASE ---
// Query untuk mengambil event terbaru (diurutkan berdasarkan ID terbaru)
$query = "SELECT id, judul, tanggal, waktu, lokasi, gambar, kategori, deadline FROM event ORDER BY id DESC";
$result = $koneksi->query($query);

// Array untuk menampung data event
$events_from_db = []; 
$error_message = "";

if ($result && $result->num_rows > 0) {
    // Ambil semua hasil dan simpan dalam array asosiatif
    $events_from_db = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // Pesan jika database kosong
    $error_message = "Belum ada event yang terdaftar di database. Silakan tambahkan event pertama Anda.";
}
// --- AKHIR LOGIKA DATABASE ---
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindEvent – Portal Event Universitas Lampung</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">
      <img src="assets/logo.png" alt="Logo FindEvent">
      <span>FindEvent</span>
    </div>

    <button id="dark-mode-toggle" title="Toggle Dark Mode">🌙</button>
    <nav>
      <a href="index.php" class="<?php echo is_active('index.php', null, 0, $koneksi) ? 'active' : ''; ?>">Beranda</a>
      <a href="kategori.php?tipe=lomba" class="<?php echo is_active('kategori.php', 'lomba', 0, $koneksi) ? 'active' : ''; ?>">Lomba</a>
      <a href="kategori.php?tipe=seminar" class="<?php echo is_active('kategori.php', 'seminar', 0, $koneksi) ? 'active' : ''; ?>">Seminar</a>
      <a href="kategori.php?tipe=workshop" class="<?php echo is_active('kategori.php', 'workshop', 0, $koneksi) ? 'active' : ''; ?>">Workshop</a>
      <a href="tentang.php" class="<?php echo is_active('tentang.php', null, 0, $koneksi) ? 'active' : ''; ?>">Tentang</a>
    </nav>
</header>

<section class="hero">
    <div class="hero-content">
      <h2>Temukan Berbagai Event di Universitas Lampung!</h2>
      <p>Jelajahi seminar, lomba, dan workshop menarik yang diselenggarakan di lingkungan Universitas Lampung.</p>
    </div>
</section>
  
<main class="container">
    <h2 class="section-title">✨ Rekomendasi Event </h2>
    
    <?php if (!empty($error_message)): ?>
        <p class="empty-message text-center"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <div class="event-grid">
        <?php 
        // Melakukan loop pada data yang diambil dari database
        foreach ($events_from_db as $event): 
        $status = get_event_status($event['deadline']);
        ?>
        <div class="event-card" data-kategori="<?php echo $event['kategori']; ?>">
            <span class="event-status <?php echo $status['class']; ?>">
                <?php echo $status['text']; ?>
            </span>
            <img src="<?php echo $event['gambar']; ?>" alt="<?php echo $event['judul']; ?>">
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
