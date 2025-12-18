<?php
// FILE: komponen/header.php (FINAL DENGAN DARK MODE DI POJOK KANAN)
// Pastikan file utama (index.php, detail.php, dll.) memanggil functions.php sebelum require header ini.
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'FindEvent – Portal Event Universitas Lampung'; ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <style>
        /* CSS INLINE MINIMAL UNTUK LOGO */
        .logo-link {
            text-decoration: none;
            color: inherit; 
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        header .logo {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>

<header>
    <a href="index.php" class="logo-link"> 
        <div class="logo">
            <img src="assets/logo.png" alt="Logo FindEvent">
            <span>FindEvent</span>
        </div>
    </a>
    
    <nav>
      <a href="index.php" class="<?php echo set_active('index.php'); ?>">Beranda</a>
      <a href="kategori.php?tipe=lomba" class="<?php echo set_active('kategori.php', 'lomba'); ?>">Lomba</a>
      <a href="kategori.php?tipe=seminar" class="<?php echo set_active('kategori.php', 'seminar'); ?>">Seminar</a>
      <a href="kategori.php?tipe=workshop" class="<?php echo set_active('kategori.php', 'workshop'); ?>">Workshop</a>
      <a href="tentang.php" class="<?php echo set_active('tentang.php'); ?>">Tentang</a>
    </nav>
    
    <button id="dark-mode-toggle" title="Mode Gelap / Terang">🌙</button>

</header>