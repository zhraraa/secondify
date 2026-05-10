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

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/auth/register.css">
</head>

<body>

<div class="register-container">

    <div class="register-box">
        <h2>Daftar ke Secondify</h2>

    

        <form action="<?= SECONDIFY; ?>/apps/controllers/auth/register.php" method="POST">
            <label for="">Nama</label>
            <input type="text" id="name" name="nama" placeholder="Masukkan Nama Lengkap">
            
            <label for="">Username</label>
            <input type="text" name="username" placeholder="username"> <label for="">Email</label>
            <input type="email" id="email" name="email" placeholder="nama@gmail.com">
            
            <label for="">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan Password">
            
            <label for="">Konfirmasi Password</label>
            <input type="password" id="confirm" name="confirm" placeholder="Masukkan Konfirmasi Password">
            <label for="">Lokasi</label>
            <select class="dropdown-lokasi" name="lokasi" id="lokasi">
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
            <button onclick="register()" name="daftar" type="submit">Daftar</button>
        </form>

        <p id="message"></p>
    </div>

</div>

<script src="../js/register.js"></script>
</body>
</html>