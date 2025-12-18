<?php
// FILE: admin/logout.php

session_start();
session_unset(); // Hapus semua variabel sesi
session_destroy(); // Hancurkan sesi

// Redirect ke halaman login, yang berada satu level di luar folder admin
header("Location: ../login.php"); 
exit();
?>