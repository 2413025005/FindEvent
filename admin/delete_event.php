<?php
// FILE: admin/delete_event.php (Asumsi nama file)

require_once '../koneksi.php'; // Hubungkan ke database

// 1. Cek apakah ada ID Event yang dikirim melalui URL (GET)
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];

    // 2. Ambil Nama Gambar (PENTING: untuk menghapus file di server)
    // Ambil dulu nama gambar dari database sebelum event dihapus
    $stmt_select = $koneksi->prepare("SELECT gambar FROM event WHERE id = ?");
    $stmt_select->bind_param("i", $event_id);
    $stmt_select->execute();
    $result_select = $stmt_select->get_result();
    $row = $result_select->fetch_assoc();
    $gambar_nama = $row['gambar'];
    $stmt_select->close();

    // 3. JALANKAN PERINTAH SQL DELETE (Menghapus data dari tabel)
    $stmt_delete = $koneksi->prepare("DELETE FROM event WHERE id = ?");
    $stmt_delete->bind_param("i", $event_id);

    if ($stmt_delete->execute()) {
        // 4. Hapus File Gambar dari Folder assets/ (Housekeeping)
        if ($gambar_nama && file_exists("../assets/" . $gambar_nama)) {
            unlink("../assets/" . $gambar_nama);
        }

        $stmt_delete->close();
        $koneksi->close();

        // 5. Redirect ke halaman dashboard dengan pesan sukses
        header("Location: dashboard.php?status=delete_success");
        exit();
    } else {
        // Jika gagal menghapus
        $stmt_delete->close();
        $koneksi->close();
        header("Location: dashboard.php?status=delete_error");
        exit();
    }

} else {
    // Jika tidak ada ID dikirim, kembali ke dashboard
    header("Location: dashboard.php");
    exit();
}
?>