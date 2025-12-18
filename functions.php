<?php
// =======================================================================
// functions.php: Fungsi Global untuk Navigasi dan Status Event (VERSI FINAL AMAN)
// =======================================================================

// FUNGSI 1: Penentuan Status Aktif Navigasi (set_active)
// Ini adalah versi sederhana yang HANYA membandingkan nama file dan parameter 'tipe'.
function set_active($target_file, $target_tipe = null) {
    
    $current_file = basename($_SERVER['PHP_SELF']); 
    $current_tipe = isset($_GET['tipe']) ? strtolower($_GET['tipe']) : '';
    $active_class = 'active';

    // 1. Cek Navigasi Beranda/Tentang
    if ($current_file === $target_file && empty($target_tipe)) {
        return $active_class;
    }

    // 2. Cek Navigasi Kategori (Lomba, Seminar, Workshop)
    if ($target_file === 'kategori.php' && $target_tipe !== null) {
        if ($current_file === 'kategori.php' && $target_tipe === $current_tipe) {
            return $active_class;
        }
    }

    // Catatan: Di halaman detail.php, link kategori tidak akan aktif, 
    // tetapi ini jauh lebih aman daripada menjalankan query SQL di setiap render header.

    return '';
}


// FUNGSI 2: Penentuan Status Timer Event (get_event_status)
function get_event_status($deadline_date) {
    // Current date (Hari Ini)
    $today = new DateTime();
    // Deadline date (Batas Waktu)
    $deadline = new DateTime($deadline_date);

    // 1. Cek jika sudah lewat (EXPIRED)
    if ($deadline < $today) {
        return ['text' => '⏳ TELAH BERAKHIR', 'class' => 'expired'];
    }

    // 2. Hitung selisih hari
    $interval = $today->diff($deadline);
    $days_left = $interval->days;

    // 3. Tentukan status (URGENT / ACTIVE)
    if ($days_left == 0) {
        return ['text' => "🔴 HARI INI TERAKHIR!", 'class' => 'urgent'];
    } elseif ($days_left <= 7) {
        return ['text' => "🔴 H-$days_left (SEGERA)", 'class' => 'urgent'];
    } else {
        return ['text' => "🟢 H-$days_left Hari Lagi", 'class' => 'active'];
    }
}
// HAPUS TAG PENUTUP PHP DI SINI! (Ini adalah praktik terbaik untuk menghindari output tak terduga)