<?php
// logout.php: Menghancurkan Session dan Logout Admin

session_start();
// Hapus semua variabel sesi
$_SESSION = array();
// Hancurkan sesi
session_destroy();
// Arahkan kembali ke halaman login
header("Location: login.php");
exit;
?>