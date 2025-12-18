<?php
// koneksi.php

// KREDENSIAL INFINITYFREE
$host = "sql101.infinityfree.com"; 
$username = "if0_40661951"; 
$password = "7jjYmceQdVS6dRc"; // Ganti dengan password cPanel/VPanel kamu
$database = "if0_40661951_findevent"; 

// JANGAN UBAH BAGIAN INI
$koneksi = new mysqli($host, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>