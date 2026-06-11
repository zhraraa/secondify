<?php
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Secondify</title>
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/style.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="registPage">
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
                <h1>Buat Akun Baru</h1>
                <p>Daftar sekarang dan mulai berjualan atau berbelanja di Secondify</p>
            </div>
            
            <form action="<?= SECONDIFY; ?>/apps/controllers/auth/register.php" method="POST">
                
                
                <div class="row-group">
                    <div class="input-group">
                        <label>Nama Lengkap</label>
                        <div>
                            <i data-lucide="user" style="width: 14px; color:rgba(0, 0, 0, 0.7); position: absolute; margin-left: 10px;"></i>
                            <input type="text" id="name" name="nama" class="input-form" placeholder="Nama Lengkap" style="padding-left: 32px;" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Username</label>
                        <div>
                            <i data-lucide="at-sign" style="width: 14px; color:rgba(0, 0, 0, 0.7); position: absolute; margin-left: 10px;"></i>
                            <input type="text" name="username" class="input-form" placeholder="Username" style="padding-left: 32px;" required>
                        </div>
                    </div>
                </div>

                <div class="input-group">
                    <label>Email</label>
                    <div>
                        <i data-lucide="mail" style="width: 14px; color:rgba(0, 0, 0, 0.7); position: absolute; margin-left: 10px;"></i>
                        <input type="email" id="email" name="email" class="input-form" placeholder="nama@gmail.com" style="padding-left: 32px;" required>
                    </div>
                </div>

                
                <div class="row-group input-password">
                    <div class="input-group">
                        <label>Password</label>
                        <div>
                            <i data-lucide="lock" style="width: 14px; color:rgba(0, 0, 0, 0.7); position: absolute; margin-left: 10px;"></i>
                            <input type="password" id="password" name="password" class="input-form" placeholder="Password" style="padding-left: 32px;" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="konfirm">Konfirmasi Password</label>
                        <div>
                            <i data-lucide="lock" style="width: 14px; color:rgba(0, 0, 0, 0.7); position: absolute; margin-left: 10px;"></i>
                            <input type="password" id="confirm" name="konfirmasi_password" class="input-form" placeholder="Ulangi Password" style="padding-left: 32px;" required>
                        </div>
                    </div>
                </div>

                <div class="input-group">
                    <label>Lokasi</label>
                    <div>
                        <i data-lucide="map-pin" style="width: 14px; color:rgba(0, 0, 0, 0.7); position: absolute; margin-left: 10px;"></i>
                        <select name="lokasi" id="lokasi" class="input-form dropdown-lokasi" style="padding-left: 32px;" required>
                            <option value="">Pilih Lokasi</option>
                            <option value="Bumi Waras">Bumi Waras</option>
                            <option value="Enggal">Enggal</option>
                            <option value="Kedamaian">Kedamaian</option>
                            <option value="Kedaton">Kedaton</option>
                            <option value="Kemiling">Kemiling</option>
                            <option value="Labuhan Ratu">Labuhan Ratu</option>
                            <option value="Langkapura">Langkapura</option>
                            <option value="Panjang">Panjang</option>
                            <option value="Rajabasa">Rajabasa</option>
                            <option value="Sukabumi">Sukabumi</option>
                            <option value="Sukarame">Sukarame</option>
                            <option value="Tanjung Senang">Tanjung Senang</option>
                            <option value="Tanjung Karang Barat">Tanjung Karang Barat</option>
                            <option value="Tanjung Karang Pusat">Tanjung Karang Pusat</option>
                            <option value="Tanjung Karang Timur">Tanjung Karang Timur</option>
                            <option value="Teluk Betung Barat">Teluk Betung Barat</option>
                            <option value="Teluk Betung Selatan">Teluk Betung Selatan</option>
                            <option value="Teluk Betung Timur">Teluk Betung Timur</option>
                            <option value="Teluk Betung Utara">Teluk Betung Utara</option>
                            <option value="Way Halim">Way Halim</option>
                        </select>
                    </div>
                </div>

                <p id="message"></p>

                <button class="buttonMasuk" onclick="register()" name="daftar" type="submit">Daftar</button>
            </form>

            <div class="to-regist">
                <p>Sudah punya akun?</p>
                <a href="<?= SECONDIFY; ?>/index.php">Masuk di sini</a>
            </div>
        </div>
    </div>
    

    <script src="<?= SECONDIFY; ?>/assets/js/user/register.js"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>