<?php
// Tampilkan error saat debugging (hilangkan saat produksi)
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// Koneksi ke database InfinityFree
$host = "sql212.infinityfree.com";
$user = "if0_39447499";               // Ganti dengan username InfinityFree kamu
$pass = "perpustaka2025";              // Ganti dengan password database
$db   = "if0_39447499_perpustakaandigital";           // Ganti dengan nama database

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$username    = trim($_POST['username']);
$password    = $_POST['password'];
$konfirmasi  = $_POST['konfirmasi_password'];

// Validasi input
if (empty($username) || empty($password) || empty($konfirmasi)) {
    $_SESSION['register_error'] = "Semua field harus diisi.";
    header("Location: register.php");
    exit();
}

if ($password !== $konfirmasi) {
    $_SESSION['register_error'] = "Password dan konfirmasi tidak sama.";
    header("Location: register.php");
    exit();
}

// Cek apakah username sudah ada
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $_SESSION['register_error'] = "Username sudah digunakan. Silakan pilih yang lain.";
    $stmt->close();
    header("Location: register.php");
    exit();
}
$stmt->close();

// Hash password dan simpan ke database
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hash);

if ($stmt->execute()) {
    $_SESSION['username'] = $username;
    header("Location: login.html");
    exit();
} else {
    $_SESSION['register_error'] = "Terjadi kesalahan saat mendaftar.";
    header("Location: register.php");
    exit();
}

$stmt->close();
$conn->close();
?>
