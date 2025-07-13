<?php
$host = "sql212.infinityfree.com";       // MySQL Hostname
$username = "if0_39447499";              // MySQL Username
$password = "perpustaka2025";            // MySQL Password
$dbname = "if0_39447499_perpustakaandigital";            // MySQL Database Name

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// echo "Koneksi berhasil"; // aktifkan jika ingin uji koneksi
?>
