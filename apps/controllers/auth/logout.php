<?php
session_start(); 
// 1. Hapus semua isi variabel session
session_unset(); 

// 2. Hancurkan session-nya (Bakar tiketnya)
session_destroy();

// 3. Balikin user ke halaman utama atau login
header("Location: /secondify/index.php"); 
exit();
?>