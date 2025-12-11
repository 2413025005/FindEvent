<?php
// tentang.php: Halaman Statis Tentang Kami

// Memuat koneksi database dan fungsi global
require_once 'koneksi.php'; 
require_once 'functions.php'; 
// Kode lama include 'data.php'; sudah dihapus karena tidak diperlukan

// Catatan: Karena ini adalah halaman statis, kita set $id=0 dan $tipe=null.
$id = 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami – FindEvent</title>
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
            <a href="index.php" class="<?php echo is_active('index.php', null, $id, $koneksi) ? 'active' : ''; ?>">Beranda</a>
      <a href="kategori.php?tipe=lomba" class="<?php echo is_active('kategori.php', 'lomba', $id, $koneksi) ? 'active' : ''; ?>">Lomba</a>
      <a href="kategori.php?tipe=seminar" class="<?php echo is_active('kategori.php', 'seminar', $id, $koneksi) ? 'active' : ''; ?>">Seminar</a>
      <a href="kategori.php?tipe=workshop" class="<?php echo is_active('kategori.php', 'workshop', $id, $koneksi) ? 'active' : ''; ?>">Workshop</a>
      <a href="tentang.php" class="<?php echo is_active('tentang.php', null, $id, $koneksi) ? 'active' : ''; ?>">Tentang</a>
    </nav>
</header>

<section class="container tentang-page">
    <h2 class="section-title">Apa itu FindEvent?</h2>
    <div class="tentang-content">
      <p>FindEvent adalah portal informasi terpadu yang didedikasikan untuk memudahkan mahasiswa Universitas Lampung dalam menemukan berbagai kegiatan akademik maupun non-akademik di lingkungan kampus. Kami menyajikan informasi terbaru tentang seminar, workshop, lomba, dan event lainnya yang diselenggarakan oleh berbagai organisasi mahasiswa dan unit di Unila.</p>
      <p>Tujuan kami adalah menghubungkan Anda dengan peluang terbaik untuk pengembangan diri, ekspresi kreativitas, dan peningkatan jejaring di era digital. Jangan lewatkan satu pun event penting di Unila!</p>
      <p>Kami berkomitmen untuk menyediakan data event yang akurat dan *up-to-date*. Jika Anda memiliki event kampus yang ingin dipublikasikan, silakan hubungi tim kami.</p>
    </div>
</section>

<footer>
    <div class="footer-container">
      <div class="footer-left">
        <img src="assets/logo.png" alt="FindEvent Logo">
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