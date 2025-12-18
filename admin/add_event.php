<?php
// admin/add_event.php: Halaman Input Data Event Baru

session_start();
require_once '../koneksi.php'; // Kembali ke root folder untuk koneksi

// Cek apakah admin sudah login (LOGIKA KEAMANAN DASAR)
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../login.php');
    exit;
}

$message = "";

// LOGIKA PEMROSESAN FORM JIKA DIKIRIM (Metode POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Ambil data dari form (Filter input: mysqli_real_escape_string)
    $judul = $koneksi->real_escape_string($_POST['judul']);
    $kategori = $koneksi->real_escape_string($_POST['kategori']);
    $lokasi = $koneksi->real_escape_string($_POST['lokasi']);
    $tanggal = $koneksi->real_escape_string($_POST['tanggal']);
    $waktu = $koneksi->real_escape_string($_POST['waktu']);
    $deadline = $koneksi->real_escape_string($_POST['deadline']);
    $deskripsi = $koneksi->real_escape_string($_POST['deskripsi']);
    $link_daftar = $koneksi->real_escape_string($_POST['link_daftar']);
    
    // Asumsi: Gambar selalu diletakkan manual di folder assets
    $gambar = $koneksi->real_escape_string("assets/" . $_POST['gambar_nama']); // Simpan path: assets/nama_file.jpg
    
    // 2. Query SQL untuk menyisipkan data (CREATE)
    $query = "INSERT INTO event (judul, kategori, lokasi, tanggal, waktu, gambar, deadline, deskripsi, link_daftar) 
              VALUES ('$judul', '$kategori', '$lokasi', '$tanggal', '$waktu', '$gambar', '$deadline', '$deskripsi', '$link_daftar')";
    
    if ($koneksi->query($query) === TRUE) {
        $message = "Event baru berhasil ditambahkan ke database!";
    } else {
        $message = "Error: " . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Event</title>
    <link rel="stylesheet" href="../style.css"> <style>
        /* Gaya dasar untuk form admin */
        .admin-form-container {
            max-width: 700px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .admin-form-container h2 {
            color: #2563eb;
            border-bottom: 2px solid #e0f2fe;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .admin-form-container label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
        }
        .admin-form-container input[type="text"], 
        .admin-form-container input[type="date"],
        .admin-form-container textarea,
        .admin-form-container select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .admin-form-container textarea {
            resize: vertical;
            min-height: 100px;
        }
        .admin-form-container button {
            background-color: #10b981;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 25px;
            font-weight: 700;
        }
        .admin-form-container .message {
            margin-top: 15px;
            padding: 10px;
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="admin-form-container">
    <h2>Tambah Event Baru</h2>
    <?php if ($message): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>
    
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="judul">Judul Event:</label>
        <input type="text" id="judul" name="judul" required>

        <label for="kategori">Kategori:</label>
        <select id="kategori" name="kategori" required>
            <option value="Lomba">Lomba</option>
            <option value="Seminar">Seminar</option>
            <option value="Workshop">Workshop</option>
        </select>

        <label for="lokasi">Lokasi:</label>
        <input type="text" id="lokasi" name="lokasi" required>

        <div style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label for="tanggal">Tanggal Event:</label>
                <input type="text" id="tanggal" name="tanggal" placeholder="Contoh: 27 Desember 2025" required>
            </div>
            <div style="flex: 1;">
                <label for="waktu">Waktu Event:</label>
                <input type="text" id="waktu" name="waktu" placeholder="Contoh: 08.00 WIB s.d. Selesai" required>
            </div>
        </div>
        
        <label for="deadline">Deadline Pendaftaran (Format YYYY-MM-DD):</label>
        <input type="date" id="deadline" name="deadline" required>

        <label for="deskripsi">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi" required></textarea>

        <label for="link_daftar">Link Pendaftaran (URL):</label>
        <input type="text" id="link_daftar" name="link_daftar" placeholder="https://bit.ly/link-pendaftaran-anda" required>
        
        <label for="gambar_nama">Nama File Gambar di Folder assets/ (Contoh: mediaphoria.jpg):</label>
        <input type="text" id="gambar_nama" name="gambar_nama" placeholder="Contoh: seminar_baru.jpg" required>

        <button type="submit">Tambah Event</button>
        
        <a href="../index.php" style="display: block; text-align: center; margin-top: 15px;">Kembali ke Beranda</a>
    </form>
</div>

</body>
</html>