<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'koneksi/koneksi.php';
require_once 'apps/config/config.php';

if (isset($_SESSION['status']) && $_SESSION['status'] === 'login') {
    if($_SESSION['role'] == 'admin'){
        header("Location: " . SECONDIFY . "/apps/views/admin/adminDashboard.php");
        exit();
    } else {
        header("Location: " . SECONDIFY . "/apps/controllers/user/dashboardController.php");            
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secondify - Login</title>
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/style.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="loginPage">
    <div class="card">
        <div class="left-area">
            <img src="<?= SECONDIFY; ?>/assets/images/logo/logo3.png" alt="">
            <div class="textTengah">
                <h1>Jual Beli Barang Bekas, dekat & mudah.</h1>
                <p>Marketplace barang bekas Bandar Lampung, temukan barang berkualitas dengan harga ramah.</p>
            </div>
            <p>@2026 Secondify All rights reserved.</p>
        </div>
        <div class="right-area">
            <div class="header-login">
                <h1>Selamat Datang Kembali</h1>
                <p>Masuk untuk melihat update belanja terbaru di Bandar Lampung</p>
            </div>
            <form action="<?= SECONDIFY; ?>/apps/controllers/auth/login.php" method="POST">
                <div class="input-email">
                    <label>Email</label>
                    <div class="input-wrapper">
                        <i data-lucide="mail"></i> 
                        <input name="email" type="email" class="input-form" placeholder="nama@gmail.com" required>
                    </div>
                </div>
                <div class="input-password">
                    <label for="">Password</label>
                    <div class="input-wrapper">
                        <i data-lucide="lock"></i> 
                        <input name="password" type="password" class="input-form" placeholder="Masukkan password" required>
                        <i data-lucide="eye"></i> 
                    </div>
                </div>
                
                <?php if (isset($_GET['error']) && $_GET['error'] == "loginError") : ?>
                    <div class="loginSalah login-error">
                        <i data-lucide="alert-circle"></i>
                        <span>Email atau Password salah</span>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['error']) && $_GET['error'] == "accountSuspended") : ?>
                    <div class="loginSalah account-suspended">
                        <i data-lucide="alert-triangle"></i>
                        <span>Maaf, akun Anda telah ditangguhkan/dibekukan oleh Admin.</span>
                    </div>
                <?php endif; ?>


                <div class="bwahForm">
                    <div class="ingatSaya">
                        <input type="checkbox" class="remember">
                        <label for="remember">Ingat saya</label>
                    </div>
                    <a href="#" class="lupaPw">Lupa password?</a>
                </div>
                <button class="buttonMasuk" type="submit" name="masuk">Masuk</button>
                
            </form>

            <div class="to-regist">
                <p>Belum punya akun?</p>
                <a href="<?= SECONDIFY; ?>/apps/views/auth/register.php">Daftar sekarang</a>
            </div>
        </div>

        </div>
    
    <script src="<?= SECONDIFY; ?>/assets/js/global.js">
        
    </script>
</body>

</html>
