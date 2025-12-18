<?php
// ===============================
// INDEX.PHP — Halaman Beranda (FINAL MENGGUNAKAN KOMPONEN)
// ===============================

// Hapus require_once 'koneksi.php'; dan 'functions.php'; dari sini!
// Keduanya sekarang harus ada di dalam file komponen/header.php atau dipanggil sebelum header.

// --- 1. Ambil data event dari database ---
$events_from_db = [];
$error_message = "";
$page_title = 'FindEvent – Portal Event Universitas Lampung'; // Atur Judul Halaman

// PANGGIL KONEKSI dan FUNGSI MANUAL DI SINI SEBAGAI SAFETY NET
require_once 'koneksi.php'; 
require_once 'functions.php'; 

// --- MEMANGGIL HEADER (HTML pembuka, Navigasi, dll.) ---
require_once 'komponen/header.php'; 

// Lanjutkan dengan logika PHP yang menggunakan $koneksi dan fungsi
$query = "SELECT id, judul, tanggal, waktu, lokasi, gambar, kategori, deadline FROM event ORDER BY id DESC";
$result = $koneksi->query($query);

if ($result && $result->num_rows > 0) {
    $events_from_db = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $error_message = "Belum ada event yang tersedia untuk saat ini.";
}

?>

<section class="hero">
    <div class="hero-content">
        <h2>Temukan Berbagai Event di Universitas Lampung!</h2>
        <p>Jelajahi seminar, lomba, dan workshop menarik yang diselenggarakan di lingkungan Universitas Lampung.</p>
    </div>
</section>

<main class="container">

    <h2 class="section-title">✨ Rekomendasi Event</h2>

    <?php if ($error_message): ?>
        <p class="empty-message text-center"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <div class="event-grid">

        <?php foreach ($events_from_db as $event): 
            $status = get_event_status($event['deadline']);
            $img = (!empty($event['gambar'])) ? $event['gambar'] : "assets/default.jpg";
        ?>

        <div class="event-card" data-kategori="<?php echo $event['kategori']; ?>">

            <span class="event-status <?php echo $status['class']; ?>">
                <?php echo $status['text']; ?>
            </span>

            <img src="<?php echo $img; ?>" alt="<?php echo $event['judul']; ?>">

            <div class="event-info">
                <h3><?php echo $event['judul']; ?></h3>

                <div class="event-meta">
                    <span>📅 <?php echo $event['tanggal']; ?></span>
                    <span>🕒 <?php echo $event['waktu']; ?></span>
                    <span>📍 <?php echo $event['lokasi']; ?></span>
                </div>

                <a href="detail.php?id=<?php echo $event['id']; ?>" class="btn">
                    Baca Selengkapnya
                </a>
            </div>

        </div>

        <?php endforeach; ?>

    </div>
</main>

<?php
// --- MEMANGGIL FOOTER (Menutup tag body dan html) ---
require_once 'komponen/footer.php';
?>