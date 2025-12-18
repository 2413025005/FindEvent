<?php
// login.php: Halaman Login Admin

session_start();
require_once 'koneksi.php'; // Koneksi ke database

$login_error = "";

// Cek jika form sudah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 1. Ambil data admin dari database
    $stmt = $koneksi->prepare("SELECT id, username, password FROM user_admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password); // "ss" = dua string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Login Berhasil!
        
        // Atur session untuk mengingat status login
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        
        // Arahkan ke halaman admin/dashboard (Langkah 4)
        header('Location: admin/dashboard.php');
        exit;
    } else {
        // Login Gagal
        $login_error = "Username atau password salah.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-container h2 {
            color: #2563eb;
            margin-bottom: 25px;
        }
        .login-container input[type="text"], 
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }
        .login-container button {
            background-color: #2563eb;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-weight: 700;
            transition: background-color 0.3s;
        }
        .login-container button:hover {
            background-color: #1e40af;
        }
        .error {
            color: #dc3545;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login Admin FindEvent</h2>
    <?php if ($login_error): ?>
        <p class="error"><?php echo $login_error; ?></p>
    <?php endif; ?>
    <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">LOGIN</button>
    </form>
    <p style="margin-top: 20px;"><a href="index.php">← Kembali ke Beranda</a></p>
</div>

</body>
</html>