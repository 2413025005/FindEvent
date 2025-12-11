<?php
// =======================================================================
// functions.php: Fungsi Global untuk Navigasi dan Status Event (VERSI DATABASE)
// =======================================================================

// FUNGSI 1: Penentuan Status Aktif Navigasi (is_active)
// Fungsi ini harus menerima objek koneksi database ($koneksi)
function is_active($target_file, $target_tipe = null, $current_id = 0, $koneksi = null) {
    
    $current_file = basename($_SERVER['PHP_SELF']); 
    $current_tipe = isset($_GET['tipe']) ? strtolower($_GET['tipe']) : '';
    $active_class = 'active';

    // --- 1. Jika sedang di halaman detail.php, TENTUKAN KATEGORI dari DATABASE ---
    if ($current_file === 'detail.php' && $current_id > 0 && $koneksi !== null) {
        $stmt = $koneksi->prepare("SELECT kategori FROM event WHERE id = ?");
        // Kita menggunakan prepared statement untuk keamanan
        if ($stmt) {
            $stmt->bind_param("i", $current_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($row = $result->fetch_assoc()) {
                $current_tipe = strtolower($row['kategori']); // Kategori yang sedang aktif di halaman detail
            }
            $stmt->close();
        }
    }

    // --- 2. Cek Navigasi Beranda ---
    if ($target_file === 'index.php') {
        // Active jika di index.php ATAU jika di detail.php/kategori.php tapi tanpa tipe spesifik
        if ($current_file === 'index.php' && empty($current_tipe)) {
            return $active_class;
        }
    }

    // --- 3. Cek Navigasi Tentang ---
    if ($target_file === 'tentang.php') {
        if ($current_file === 'tentang.php') {
            return $active_class;
        }
    }
    
    // --- 4. Cek Navigasi Kategori (Lomba, Seminar, Workshop) ---
    if ($target_file === 'kategori.php' && $target_tipe !== null) {
        // Jika file saat ini adalah kategori.php ATAU detail.php, dan kategorinya cocok
        if ($target_tipe === $current_tipe) {
            return $active_class;
        }
    }

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
?>