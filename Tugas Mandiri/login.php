<?php
session_start();
include "koneksi.php";

header("Content-Type: application/json");

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['password'])) {
  $_SESSION['username'] = $username;
  echo json_encode(["success" => true]);
} else {
  echo json_encode(["success" => false, "message" => "Username atau password salah."]);
}
