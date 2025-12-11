<?php
// detail.php: Halaman Detail Event

require_once 'koneksi.php'; 
require_once 'functions.php'; 
require_once 'data_static.php'; // Data tambahan dari array lama

if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $_GET['id'] <= 0) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

// --- 1. AMBIL DATA INTI DARI DATABASE ---
$query = "SELECT * FROM event WHERE id = $id";
$result = $koneksi->query($query);

if ($result && $result->num_rows === 1) {
    $event_db = $result->fetch_assoc();
} else {
    header('Location: index.php');
    exit;
}

// --- 2. CARI DETAIL TAMBAHAN DARI ARRAY STATIS ---
$event_full = null;
foreach ($events as $static_event) {
    if ($static_event['judul'] === $event_db['judul']) {
        $event_full = $static_event;
        break;
    }
}
// Jika tidak ditemukan di array statis, gunakan data database (minimal)
if ($event_full === null) {
    $event_full = $event_db;
}

// Flags untuk membedakan event
$kategori_event = strtolower($event_full['kategori']);
$is_lomba = $kategori_event === 'lomba'; 
$is_workshop = $kategori_event === 'workshop'; 
$is_seminar = $kategori_event === 'seminar'; 
$is_gamud = strpos($event_full['judul'], 'GAMUD') !== false; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event | <?php echo $event_full['judul']; ?></title>
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

<section class="event-detail">
    <div class="detail-wrapper">
      <div class="detail-left">
        <img src="<?php echo $event_full['gambar']; ?>" alt="<?php echo $event_full['judul']; ?>">
        
        <?php if (isset($event_full['link_daftar']) && !empty($event_full['link_daftar'])): ?>
            <a href="<?php echo $event_full['link_daftar']; ?>" class="btn-daftar" target="_blank">Daftar Sekarang!</a>
            
            <?php if ($is_workshop): ?>
                <p class="small-text">Link pendaftaran juga bisa diakses melalui QR code pada pamflet.</p>
            <?php elseif ($is_lomba): ?>
                <p class="small-text">Link informasi dan pendaftaran lebih lanjut.</p>
            <?php endif; ?>
        <?php endif; ?>

      </div>
      <div class="detail-right">
        
        <?php if (isset($event_full['kolaborasi'])): ?>
            <p class="tag-kolaborasi">🎉 Kolaborasi: <strong><?php echo $event_full['kolaborasi']; ?></strong></p>
        <?php endif; ?>
        
        <?php if (isset($event_full['organizer'])): ?>
            <p class="tag-kolaborasi">📢 Organizer: <strong><?php echo $event_full['organizer']; ?></strong></p>
        <?php endif; ?>

        <h2><?php echo $event_full['judul']; ?></h2>
        
        <?php if (isset($event_full['tag_tema'])): ?>
            <p class="tag-tema">Tema: <strong>"<?php echo $event_full['tag_tema']; ?>"</strong></p>
        <?php endif; ?>

        <div class="event-meta">
          <p>📅 <?php echo $event_full['tanggal']; ?></p>
          <p>🕒 <?php echo $event_full['waktu']; ?></p>
          <p>📍 <?php echo $event_full['lokasi']; ?></p>
          
          <?php 
          $status = get_event_status($event_full['deadline']);
          ?>
          <p>Status Pendaftaran: 
              <span class="event-status <?php echo $status['class']; ?>">
                  <?= $status['text']; ?>
              </span>
          </p>
        </div>

        <p class="desc"><?php echo $event_full['deskripsi']; ?></p>
        
        <div class="tambahan-info">
        
        <?php if ($is_lomba && isset($event_full['cabang_lomba'])): ?>
            <h3>Cabang Lomba</h3>
            <ul class="list-pemateri">
                <?php foreach ($event_full['cabang_lomba'] as $lomba): ?>
                    <li><strong><?php echo $lomba['nama']; ?></strong><br>Tingkat: <?php echo $lomba['tingkat']; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        
        <?php if (isset($event_full['aktivitas'])): ?>
            <h3>Aktivitas</h3>
            <ul class="list-benefit">
                <?php foreach ($event_full['aktivitas'] as $aktivitas): ?>
                    <li><?php echo $aktivitas; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if ($is_lomba && isset($event_full['timeline'])): ?>
            <h3>Timeline Kegiatan</h3>
            <ul class="list-timeline">
                <?php foreach ($event_full['timeline'] as $item): ?>
                    <li><strong><?php echo $item['kegiatan']; ?></strong>: <?php echo $item['tanggal']; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        
        <?php if (isset($event_full['pendaftaran']) || isset($event_full['htm'])): ?>
            <h3>💰 HTM (Harga Tiket Masuk)</h3>
            
            <?php if ($is_lomba): // Lomba menggunakan tabel HTM ?>
                <table class="table-htm">
                    <thead>
                      <tr>
                        <th>Lomba</th>
                        <?php if ($is_gamud): ?><th>Gelombang</th><th>Harga</th><?php else: ?><th>Gel. 1</th><th>Gel. 2</th><?php endif; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      if ($is_gamud):
                          $gamud_htm = [];
                          if (isset($event_full['htm'])) {
                              foreach ($event_full['htm'] as $item) { $gamud_htm[$item['lomba']][] = $item; }
                          }
                          foreach ($gamud_htm as $lomba => $gelombangs): 
                              $rowspan = count($gelombangs);
                              foreach ($gelombangs as $index => $item):
                      ?>
                        <tr>
                          <?php if ($index == 0): ?><td rowspan="<?php echo $rowspan; ?>"><strong><?php echo $lomba; ?></strong></td><?php endif; ?>
                          <td><?php echo $item['gelombang']; ?></td><td><strong><?php echo $item['harga']; ?></strong></td>
                        </tr>
                      <?php endforeach; endforeach; 
                      else:
                          if (isset($event_full['htm'])) {
                              foreach ($event_full['htm'] as $htm): ?>
                                <tr><td><strong><?php echo $htm['lomba']; ?></strong></td><td>Rp <?php echo $htm['gel1']; ?></td><td>Rp <?php echo $htm['gel2']; ?></td></tr>
                              <?php endforeach;
                          } 
                      endif;
                      ?>
                    </tbody>
                </table>
                <?php if (isset($event_full['htm_note'])): ?><p class="small-text mt-3">NOTE: <?php echo $event_full['htm_note']; ?></p><?php endif; ?>

            <?php else: // Seminar/Workshop HTM sederhana ?>
              <?php if (isset($event_full['pendaftaran'])): foreach ($event_full['pendaftaran'] as $pendaftaran): ?>
                <p><strong><?php echo $pendaftaran['gelombang']; ?></strong><br>Periode: <?php echo $pendaftaran['periode']; ?><br>Harga: <strong><?php echo $pendaftaran['htm']; ?></strong></p>
              <?php endforeach; endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        
        <?php if (isset($event_full['pemateri']) && !empty($event_full['pemateri'])): ?>
            <h3>Pemateri</h3>
            <ul class="list-pemateri">
                <?php foreach ($event_full['pemateri'] as $pemateri): ?>
                    <li><strong><?php echo $pemateri['materi']; ?></strong><br><?php echo $pemateri['nama']; ?> (*<?php echo $pemateri['jabatan']; ?>*)</li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (isset($event_full['link_tambahan'])): ?>
            <a href="<?php echo $event_full['link_tambahan']['url']; ?>" class="btn-link" target="_blank"><?php echo $event_full['link_tambahan']['text']; ?></a>
        <?php endif; ?>
        
        <?php if (isset($event_full['benefit'])): ?>
            <div class="benefit-wrapper">
                <h3>🎉 <?php echo ($is_lomba) ? 'Hadiah Lomba' : 'Benefit yang Kamu Dapatkan'; ?></h3>
                <ul class="list-benefit">
                    <?php foreach ($event_full['benefit'] as $benefit): ?>
                        <li><?php echo $benefit; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (isset($event_full['catatan'])): ?><p class="small-text mt-3">📌 Catatan: <?php echo $event_full['catatan']; ?></p><?php endif; ?>

        <?php if (isset($event_full['pembayaran'])): ?>
            <h3>Metode Pembayaran</h3>
            <?php foreach ($event_full['pembayaran'] as $pembayaran): ?>
              <p><strong><?php echo $pembayaran['metode']; ?></strong> (A/N: <?php echo $pembayaran['an']; ?>)<br>No. Rek: <?php echo $pembayaran['rekening']; ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <?php if (isset($event_full['kontak'])): ?>
          <h3>Narahubung & Konfirmasi</h3>
          <ul class="list-kontak">
            <?php foreach ($event_full['kontak'] as $nama => $nomor): ?>
              <li><strong><?php echo $nama; ?>:</strong> <a href="https://wa.me/<?php echo preg_replace('/[^\d]/', '', $nomor); ?>" target="_blank"><?php echo $nomor; ?></a></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <?php if (isset($event_full['sosial_media'])): ?>
          <div class="organizer-sosmed-wrapper">
            <h3>Visit & Follow Us</h3>
            <ul class="list-sosial">
                <?php foreach ($event_full['sosial_media'] as $sosmed): ?>
                    <li><strong><?php echo $sosmed['platform']; ?>:</strong> <a href="#" target="_blank"><?php echo $sosmed['akun']; ?></a></li>
                <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
        
        </div>
        <a href="index.php" class="btn-back">← Kembali ke Beranda</a>
      </div>
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