<?php
session_start();

session_destroy();

echo "<script>alert('logout berhasil, sampai jumpa lagi...');</script>";
echo "<script>location='login.php';</script>";
