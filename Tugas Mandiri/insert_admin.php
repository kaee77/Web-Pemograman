<?php
include "koneksi.php";

$username = "kurniawan";
$passwordPlain = "12345";
$passwordHashed = password_hash($passwordPlain, PASSWORD_DEFAULT);

// Cek apakah username sudah ada
$cek = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
if (mysqli_num_rows($cek) > 0) {
  echo "Username 'admin' sudah ada di database.";
} else {
  $sql = "INSERT INTO users (username, password) VALUES ('$username', '$passwordHashed')";
  if (mysqli_query($conn, $sql)) {
    echo "✅ User admin berhasil ditambahkan. Login dengan username: admin dan password: 12345";
  } else {
    echo "❌ Gagal menambahkan user: " . mysqli_error($conn);
  }
}
?>
