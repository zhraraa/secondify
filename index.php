<?php
require_once 'koneksi/koneksi.php';
require_once 'apps/config/config.php';

if (isset($_SESSION['status']) && $_SESSION['status'] === 'login') {
    if($_SESSION['role'] == 'admin'){
        header("Location: " . SECONDIFY . "/apps/views/admin/adminDashboard.php");
        exit();
    } else {
        header("Location: " . SECONDIFY . "/apps/views/user/dashboard.php");            
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
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/login.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>
    <div>
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
                        <div>
                            <i data-lucide="mail" style="width: 14px; color:rgba(0, 0, 0, 0.7); position: absolute; margin-left: 8px; align-self: center;"></i> 
                            <input name="email" type="email" class="input-form" placeholder="nama@gmail.com" style="padding-left: 30px;" required>
                        </div>
                    </div>
                    <div class="input-password">
                        <label for="">Password</label>
                        <div style="display: flex; flex-direction: row; align-items: center;">
                            <i data-lucide="lock" style="width: 14px; color:rgba(0, 0, 0, 0.7); position: absolute; margin-left: 8px; align-self: center;"></i> 
                            <input name="password" type="password" class="input-form" placeholder="Masukkan password" style="padding-left: 30px;" required>
                            <i data-lucide="eye" style="width: 16px; height: 16px; color:rgba(0, 0, 0, 0.7); position: absolute; margin-left: 380px; align-self: center; "></i> 
                        </div>
                    </div>
                    
                    <?php if (isset($_GET['error']) && $_GET['error'] == "loginError") : ?>
                        <div class="loginSalah" style="width: 100%;">
                            <i data-lucide="alert-circle" style="width: 1.25rem; height: 1.25rem; color: red;"></i>
                            <span>Email atau Password salah</span>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['error']) && $_GET['error'] == "accountSuspended") : ?>
                        <div class="loginSalah" style="width: 100%; background-color: #fdf2f2; border: 1px solid #f8b4b4; padding: 10px; border-radius: 8px; margin-top: 10px; display: flex; align-items: center; gap: 8px;">
                            <i data-lucide="alert-triangle" style="width: 1.25rem; height: 1.25rem; color: #e02424;"></i>
                            <span style="color: #e02424; font-size: 13px; font-weight: 500;">Maaf, akun Anda telah ditangguhkan/dibekukan oleh Admin.</span>
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
    </div>
    <script src="<?= SECONDIFY; ?>/assets/js/global.js">
        
    </script>
</body>

</html>
