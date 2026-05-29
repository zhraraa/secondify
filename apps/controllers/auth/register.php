<?php
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';

if(isset($_POST['daftar'])){

    $nama       = trim($_POST['nama']);
    $username   = trim($_POST['username']);
    $email      = trim($_POST['email']);
    $password   = trim($_POST['password']);
    $konfirmasi = trim($_POST['konfirmasi_password']);
    $lokasi     = trim($_POST['lokasi']);

    if($password != $konfirmasi){
        $error = "Password dan konfirmasi password tidak sama!";
    }else{

        $cek_email = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $cek_email->bind_param("s",$email);
        $cek_email->execute();
        $cek_email->store_result();

        $cek_username = $conn->prepare("SELECT username FROM users WHERE username = ?");
        $cek_username->bind_param("s",$username);
        $cek_username->execute();
        $cek_username->store_result();

        if($cek_email->num_rows > 0){
            $error = "Email sudah digunakan!";
        }elseif($cek_username->num_rows > 0){
            $error = "Username sudah digunakan!";
        }else{

            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $query = $conn->prepare("
                INSERT INTO users
                (nama_lengkap,password,email,username,lokasi)
                VALUES (?,?,?,?,?)
            ");

            $query->bind_param(
                "sssss",
                $nama,
                $passwordHash,
                $email,
                $username,
                $lokasi
            );

            if($query->execute()){
                header("Location: ".SECONDIFY."/index.php");
                exit();
            }else{
                $error = "Gagal mendaftar!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secondify - Register</title>

    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/login.css">

    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

<div>
    <div class="card">

        <!-- KIRI -->
        <div class="left-area">
            <img src="<?= SECONDIFY; ?>/assets/images/logo/logo3.png" alt="">

            <div class="textTengah">
                <h1>Jual Beli Barang Bekas, dekat & mudah.</h1>
                <p>
                    Marketplace barang bekas Bandar Lampung,
                    temukan barang berkualitas dengan harga ramah.
                </p>
            </div>

            <p>@2026 Secondify All rights reserved.</p>
        </div>

        <!-- KANAN -->
        <div class="right-area">

            <div class="header-login">
                <h1>Buat Akun Baru</h1>
                <p>Daftar untuk mulai jual beli barang bekas di Bandar Lampung</p>
            </div>

            <form method="POST">

                <div class="input-email">
                    <label>Nama Lengkap</label>
                    <input
                        type="text"
                        name="nama"
                        class="input-form"
                        placeholder="Masukkan nama lengkap"
                        required>
                </div>

                <div class="input-email">
                    <label>Username</label>
                    <input
                        type="text"
                        name="username"
                        class="input-form"
                        placeholder="Masukkan username"
                        required>
                </div>

                <div class="input-email">
                    <label>Email</label>
                    <div>
                        <i data-lucide="mail"
                           style="width:14px;color:rgba(0,0,0,.7);position:absolute;margin-left:8px;align-self:center;">
                        </i>

                        <input
                            type="email"
                            name="email"
                            class="input-form"
                            placeholder="nama@gmail.com"
                            style="padding-left:30px;"
                            required>
                    </div>
                </div>

                <div class="input-password">
                    <label>Password</label>

                    <div style="display:flex;align-items:center;">
                        <i data-lucide="lock"
                           style="width:14px;color:rgba(0,0,0,.7);position:absolute;margin-left:8px;">
                        </i>

                        <input
                            type="password"
                            name="password"
                            class="input-form"
                            placeholder="Masukkan password"
                            style="padding-left:30px;"
                            required>
                    </div>
                </div>

                <div class="input-password">
                    <label>Konfirmasi Password</label>

                    <div style="display:flex;align-items:center;">
                        <i data-lucide="lock"
                           style="width:14px;color:rgba(0,0,0,.7);position:absolute;margin-left:8px;">
                        </i>

                        <input
                            type="password"
                            name="konfirmasi_password"
                            class="input-form"
                            placeholder="Masukkan ulang password"
                            style="padding-left:30px;"
                            required>
                    </div>
                </div>

                <div class="input-email">
                    <label>Lokasi</label>

                    <select
                        name="lokasi"
                        class="input-form"
                        required>

                        <option value="">Pilih Lokasi</option>
                        <option value="Bandar Lampung">Bandar Lampung</option>
                        <option value="Lampung Selatan">Lampung Selatan</option>
                        <option value="Metro">Metro</option>

                    </select>
                </div>

                <?php if(isset($error)) : ?>
                <div class="loginSalah" style="width:100%;">
                    <i data-lucide="alert-circle"
                       style="width:1.25rem;height:1.25rem;color:red;">
                    </i>

                    <span class="pesanError">
                        <?= $error ?>
                    </span>
                </div>
                <?php endif; ?>

                <button
                    class="buttonMasuk"
                    type="submit"
                    name="daftar">

                    Daftar

                </button>

            </form>

            <div class="to-regist">
                <p>Sudah punya akun?</p>

                <a href="<?= SECONDIFY; ?>/index.php">
                    Masuk sekarang
                </a>
            </div>

        </div>

    </div>
</div>

<script>
    lucide.createIcons();
</script>

<script src="<?= SECONDIFY; ?>/assets/js/global.js"></script>

</body>
</html>