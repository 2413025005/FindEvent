<?php
// ===============================
// kategori.php: Halaman Event Kategori (FINAL MENGGUNAKAN KOMPONEN)
// ===============================

// PENTING: Memuat KONEKSI dan FUNGSI di awal agar tersedia untuk logika database
// dan untuk fungsi is_active di header.php
require_once 'koneksi.php'; 
require_once 'functions.php';

// --- LOGIKA PENGAMBILAN DATA DARI DATABASE ---

// 1. Ambil parameter 'tipe' dari URL
$tipe_url = isset($_GET['tipe']) ? strtolower($_GET['tipe']) : '';

// Jika tidak ada tipe yang valid, arahkan ke Beranda
if (empty($tipe_url) || !in_array($tipe_url, ['lomba', 'seminar', 'workshop'])) {
    header('Location: index.php');
    exit;
}

// Catatan: Fungsi ini seharusnya ada di functions.php, tapi jika belum, ini opsinya:
function getTitleCase($string) {
    return ucwords(str_replace('_', ' ', $string));
}

$judul_kategori = getTitleCase($tipe_url) . ' Kampus';
$page_title = 'Kategori ' . $judul_kategori . ' – FindEvent'; // Atur Judul Halaman

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

// --- MEMANGGIL HEADER (HTML pembuka dan Navbar) ---
require_once 'komponen/header.php'; 
?>

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
                $img = (!empty($event['gambar'])) ? $event['gambar'] : "assets/default.jpg"; // Tambah penanganan default image
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
                        <a href="detail.php?id=<?php echo $event['id']; ?>" class="btn">Baca Selengkapnya</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php
// --- MEMANGGIL FOOTER (Menutup tag body dan html) ---
require_once 'komponen/footer.php';
?>