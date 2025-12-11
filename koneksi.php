<?php
// FILE: koneksi.php

// Konfigurasi Database (Ganti jika kamu menggunakan password)
$host = "localhost";    // Nama host server database
$user = "root";         // Username default XAMPP/Laragon
$password = "";         // Password default (kosong jika di XAMPP/Laragon)
$database = "db_findevent"; // Nama database yang baru kamu buat

// Membuat koneksi ke database menggunakan MySQLi Object Oriented
$koneksi = new mysqli($host, $user, $password, $database);

// Cek koneksi: jika gagal, hentikan program dan tampilkan error
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Opsional: Tetapkan set karakter ke utf8
$koneksi->set_charset("utf8");

// Catatan: Variabel $koneksi sekarang siap digunakan di seluruh file
// yang meng-include koneksi.php
?>