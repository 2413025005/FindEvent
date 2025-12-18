<?php
// FILE: admin/edit_event.php
session_start();
require_once '../koneksi.php'; // Koneksi ke database

// Asumsi: Pastikan admin sudah login
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     header("Location: ../login.php");
//     exit;
// }

$event_data = [];
$error_message = "";
$success_message = "";

// 1. Cek apakah ada ID event dari URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $event_id = $_GET['id'];

    // --- Ambil Data Lama (SELECT) untuk ditampilkan di formulir ---
    $stmt = $koneksi->prepare("SELECT * FROM event WHERE id = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $event_data = $result->fetch_assoc();
    } else {
        $error_message = "Event tidak ditemukan.";
    }
    $stmt->close();
} else if ($_SERVER["REQUEST_METHOD"] != "POST") {
    // Jika tidak ada ID dan bukan submit form, redirect
    header("Location: dashboard.php");
    exit;
}

// 2. Proses saat Formulir disubmit (UPDATE)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil semua data dari POST
    $id_post = $_POST['id'];
    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $lokasi = $_POST['lokasi'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $deadline = $_POST['deadline'];
    $deskripsi = $_POST['deskripsi'];
    $link_daftar = $_POST['link_daftar'];
    $gambar = $_POST['gambar']; // Nama file gambar

    // --- JALANKAN PERINTAH SQL UPDATE ---
    $stmt_update = $koneksi->prepare("UPDATE event SET 
        judul=?, kategori=?, lokasi=?, tanggal=?, waktu=?, deadline=?, deskripsi=?, link_daftar=?, gambar=?
        WHERE id=?");
    
    // Pastikan urutan dan tipe data (s=string, i=integer) sesuai
    $stmt_update->bind_param("sssssssssi", 
        $judul, $kategori, $lokasi, $tanggal, $waktu, $deadline, $deskripsi, $link_daftar, $gambar, $id_post);

    if ($stmt_update->execute()) {
        $success_message = "Event dengan ID " . $id_post . " berhasil diubah!";
        // Setelah sukses update, ambil data terbaru untuk ditampilkan
        $event_data = [
            'id' => $id_post, 
            'judul' => $judul, 
            'kategori' => $kategori, 
            'lokasi' => $lokasi,
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'deadline' => $deadline,
            'deskripsi' => $deskripsi,
            'link_daftar' => $link_daftar,
            'gambar' => $gambar
        ];
    } else {
        $error_message = "Gagal mengubah event: " . $koneksi->error;
    }
    $stmt_update->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event | Admin FindEvent</title>
    <link rel="stylesheet" href="../style.css"> 
    <style>
        .form-container { max-width: 600px; margin: 30px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .form-container h2 { text-align: center; color: #2563eb; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .alert-success { background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; border-radius: 4px; margin-bottom: 15px; }
        .alert-error { background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; border-radius: 4px; margin-bottom: 15px; }
        .btn-update { background-color: #2563eb; color: white; padding: 12px 20px; border: none; border-radius: 6px; cursor: pointer; width: 100%; font-weight: 700; }
        .btn-update:hover { background-color: #1e40af; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Edit Event (ID: <?php echo $event_data['id'] ?? 'N/A'; ?>)</h2>
    
    <?php if ($success_message): ?>
        <p class="alert-success"><?php echo $success_message; ?></p>
        <p style="text-align: center;"><a href="dashboard.php">← Kembali ke Dashboard</a></p>
    <?php endif; ?>

    <?php if ($error_message): ?>
        <p class="alert-error"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <?php if (!empty($event_data)): ?>
    <form method="POST" action="edit_event.php?id=<?php echo $event_data['id']; ?>">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($event_data['id']); ?>">
        
        <div class="form-group">
            <label for="judul">Judul Event:</label>
            <input type="text" id="judul" name="judul" value="<?php echo htmlspecialchars($event_data['judul']); ?>" required>
        </div>

        <div class="form-group">
            <label for="kategori">Kategori:</label>
            <select id="kategori" name="kategori" required>
                <option value="Lomba" <?php echo ($event_data['kategori'] == 'Lomba') ? 'selected' : ''; ?>>Lomba</option>
                <option value="Seminar" <?php echo ($event_data['kategori'] == 'Seminar') ? 'selected' : ''; ?>>Seminar</option>
                <option value="Workshop" <?php echo ($event_data['kategori'] == 'Workshop') ? 'selected' : ''; ?>>Workshop</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="lokasi">Lokasi:</label>
            <input type="text" id="lokasi" name="lokasi" value="<?php echo htmlspecialchars($event_data['lokasi']); ?>">
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal Event (YYYY-MM-DD):</label>
            <input type="date" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($event_data['tanggal']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="waktu">Waktu Event (Contoh: 08.00 - Selesai):</label>
            <input type="text" id="waktu" name="waktu" value="<?php echo htmlspecialchars($event_data['waktu']); ?>">
        </div>

        <div class="form-group">
            <label for="deadline">Deadline Pendaftaran (YYYY-MM-DD):</label>
            <input type="date" id="deadline" name="deadline" value="<?php echo htmlspecialchars($event_data['deadline']); ?>" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" rows="5" required><?php echo htmlspecialchars($event_data['deskripsi']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="link_daftar">Link Pendaftaran (URL):</label>
            <input type="url" id="link_daftar" name="link_daftar" value="<?php echo htmlspecialchars($event_data['link_daftar']); ?>">
        </div>

        <div class="form-group">
            <label for="gambar">Nama File Gambar di Folder assets/ (Contoh: seminar_baru.jpg):</label>
            <input type="text" id="gambar" name="gambar" value="<?php echo htmlspecialchars($event_data['gambar']); ?>" required>
        </div>

        <button type="submit" class="btn-update">Simpan Perubahan Event</button>
    </form>
    <?php endif; ?>
    
    <p style="text-align: center; margin-top: 20px;"><a href="dashboard.php">← Kembali ke Dashboard</a></p>
</div>

</body>
</html>