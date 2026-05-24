<?php
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secondify - Jual Barang</title>
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/penjual/formJualBarang.css">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/layouts/navbar.css">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/style.css">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="<?= SECONDIFY; ?>/assets/js/layouts/navbar.js" defer></script>
</head>
<body>
    <!-- NAVBAR -->
    <?php include __DIR__ . '/../layout/navbar.php'; ?>

    <section>
        <div class="bungkus">
            <div class="tombol-kembali">
                <i data-lucide="arrow-left" class="icon"></i>
                <span class="text">Kembali ke Profil</span>
            </div>
            <div class="cardForm">
                <div class="judulCard">
                    <h2>Tambah Barang Baru</h2>
                    <span>Isi informasi barang dengan lengkap agar cepat laku.</span>
                </div>
                
                <form method="POST" enctype="multipart/form-data">
                    <div class="inputGambar">
                        <p class="judulUpload">Foto Barang</p>
                        <label class="kotakUpload" for="upload-foto">
                            <input type="file" id="upload-foto" class="hiddenInput" accept="image/*" name="gambarBarang" required >
                            <i data-lucide="image-plus" id="image-plus"></i>
                            <span id="textUploadGambar">Tambah</span>
                        </label>
                    </div>
                    <div class="namaBarang">
                        <label for="">Nama Barang</label>
                        <input type="text" name="namaBarang" id="namaBarang" placeholder="Masukkan nama barang" maxlength="50" required>
                    </div>
                    <div class="rowInput">
                        <div class="hargaBarang">
                            <label for="">Harga</label>
                            <input type="number" name="hargaBarang" id="hargaBarang" placeholder="Masukkan harga barang" required>
                            <?php if(isset($_GET['error']) && $_GET['error'] == 'hargaNegatif') { ?>
                                <p class="pesanError">Harga tidak boleh nol atau negatif.</p>
                            <?php } ?>
                        </div>
                        <div class="kondisiBarang">
                            <label for="">Kondisi</label>
                            <select name="kondisiBarang" id="kondisiBarang" required>
                                <option value="">Pilih kondisi</option>
                                <option value="bekas">Bekas</option>
                                <option value="baru">Baru</option>
                                <option value="seperti baru">Seperti Baru</option>
                            </select>
                        </div>
                    </div>
                    <div class="rowInput2">
                        <div class="kategoriBarang">
                            <label for="">Kategori</label>
                            <select name="kategoriBarang" id="kategoriBarang" required>
                                <option value="">Pilih kategori</option>
                                <option value="1">Pakaian</option>
                                <option value="7">Elektronik</option>
                                <option value="3">Sepatu</option>
                                <option value="9">Aksesoris</option>
                                <option value="2">Lainnya</option>
                            </select>
                        </div>
                        <div class="kecamatanBarang">
                            <label for="">Kecamatan</label>
                            <select name="kecamatanBarang" id="kecamatanBarang" required>
                                <option value="">Pilih kecamatan</option>
                                <option value="Kedaton">Kedaton</option>
                                <option value="Labuhan Ratu">Labuhan Ratu</option>
                                <option value="Bumi Waras">Bumi Waras</option>
                                <option value="Enggal">Enggal</option>
                                <option value="Kedamaian">Kedamaian</option>
                                <option value="Kemiling">Kemiling</option>
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
                    <div class="deskripsiBarang">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsiBarang" id="deskripsiBarang" placeholder="Masukkan deskripsi barang" required></textarea>
                    </div>
                    <div class="rowButton">
                        <button class="buttonBatal">Batal</button>
                        <button type="submit" name="posting" class="buttonPosting">Posting Barang</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="<?= SECONDIFY; ?>/assets/js/global.js"></script>
    <script src="<?= SECONDIFY; ?>/assets/js/user/jualBarang.js"></script>
</body>
</html>
