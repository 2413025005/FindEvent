<?php
// ===============================
// DASHBOARD ADMIN (admin/dashboard.php)
// ===============================

// Pastikan koneksi dan pengecekan sesi login admin ada di sini
require_once '../koneksi.php'; 
// Asumsi kamu punya file yang berisi pengecekan session admin
// require_once 'cek_login.php'; 

// --- 1. Ambil data event dari database ---
$events_from_db = [];
$query = "SELECT id, judul, tanggal, kategori, deadline FROM event ORDER BY id DESC";
$result = $koneksi->query($query);

if ($result && $result->num_rows > 0) {
    $events_from_db = $result->fetch_all(MYSQLI_ASSOC);
} 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | FindEvent</title>
    <link rel="stylesheet" href="../style.css"> 
    <style>
        /* Gaya Sederhana untuk Admin */
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .admin-container { width: 90%; margin: 50px auto; background: white; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .admin-header h2 { margin: 0; }
        .btn { padding: 8px 15px; text-decoration: none; border-radius: 4px; margin-left: 10px; }
        .btn-add { background-color: #007bff; color: white; }
        .btn-logout { background-color: #dc3545; color: white; }
        .btn-edit { background-color: #ffc107; color: #212529; }
        .btn-delete { background-color: #dc3545; color: white; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<div class="admin-container">
    <div class="admin-header">
        <h2>Panel Admin FindEvent</h2>
        <div>
            <a href="add_event.php" class="btn btn-add">➕ Tambah Event Baru</a>
            <a href="logout.php" class="btn btn-logout">🚪 Logout</a>
        </div>
    </div>

    <h3>Daftar Event Tersedia</h3>

    <?php if (empty($events_from_db)): ?>
        <p>Belum ada event yang ditambahkan.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Event</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Deadline</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events_from_db as $event): ?>
                    <tr>
                        <td><?php echo $event['id']; ?></td>
                        <td><?php echo htmlspecialchars($event['judul']); ?></td>
                        <td><?php echo htmlspecialchars($event['kategori']); ?></td>
                        <td><?php echo htmlspecialchars($event['tanggal']); ?></td>
                        <td><?php echo htmlspecialchars($event['deadline']); ?></td>
                        <td>
                            <a href="edit_event.php?id=<?php echo $event['id']; ?>" class="btn btn-edit">Edit</a>
                            
                            <a href="delete_event.php?id=<?php echo $event['id']; ?>" 
                               onclick="return confirm('❗ PERINGATAN: Yakin ingin menghapus event ini? Aksi ini tidak bisa dibatalkan.');" 
                               class="btn btn-delete">
                               Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>