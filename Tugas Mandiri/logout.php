<?php
session_start();
session_destroy(); // hapus session login
header("Location: index.php");
exit;
