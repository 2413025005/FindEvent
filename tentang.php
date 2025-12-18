<?php
// ===============================
// tentang.php: Halaman Statis Tentang Kami (FINAL MENGGUNAKAN KOMPONEN)
// ===============================

// Halaman ini TIDAK butuh koneksi ke database ($koneksi), tapi BUTUH fungsi navigasi.
// Memuat functions.php secara manual untuk memastikan fungsi navigasi tersedia
require_once 'functions.php';

// Atur judul halaman
$page_title = 'Tentang Kami – FindEvent'; 

// --- MEMANGGIL HEADER (HTML pembuka, Navigasi, dll.) ---
// Pastikan komponen/header.php tidak memiliki require_once di dalamnya.
require_once 'komponen/header.php'; 
?>

<section class="container tentang-page">
    <h2 class="section-title">Apa itu FindEvent?</h2>
    <div class="tentang-content">
      <p>FindEvent adalah portal informasi terpadu yang didedikasikan untuk memudahkan mahasiswa Universitas Lampung dalam menemukan berbagai kegiatan akademik maupun non-akademik di lingkungan kampus. Kami menyajikan informasi terbaru tentang seminar, workshop, lomba, dan event lainnya yang diselenggarakan oleh berbagai organisasi mahasiswa dan unit di Unila.</p>
      <p>Tujuan kami adalah menghubungkan Anda dengan peluang terbaik untuk pengembangan diri, ekspresi kreativitas, dan peningkatan jejaring di era digital. Jangan lewatkan satu pun event penting di Unila!</p>
      <p>Kami berkomitmen untuk menyediakan data event yang akurat dan *up-to-date*. Jika Anda memiliki event kampus yang ingin dipublikasikan, silakan hubungi tim kami.</p>
    </div>
</section>
<?php
// --- MEMANGGIL FOOTER (Menutup tag body dan html) ---
require_once 'komponen/footer.php';
?>