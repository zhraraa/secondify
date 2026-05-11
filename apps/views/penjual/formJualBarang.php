<?php
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/penjual/formJualBarang.css">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/style.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar">
            
    <a href="<?= SECONDIFY ?>/apps/views/user/dashboard.php" class="sidebar-logo">
        <img src="<?= SECONDIFY; ?>/assets/images/logo/logo.png" alt="" class="logo">
    </a>

        <div class="search-box">
            <input type="text" placeholder="Mau cari barang apa hari ini?" id="searchInput">
        </div>

        <div class="nav-right">
            <!-- Wishlist -->
            <button class="nav-icon-btn" title="Wishlist">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
            </button>

            <!-- Notification -->
            <button class="nav-icon-btn" title="Notifikasi">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
            </button>

            <button class="msgButton">
                <i data-lucide="message-square" class="icon" style="width: 16px;"></i>  
            </button>

            <div class="nav-divider"></div>

            <a href="<?= SECONDIFY ?>/apps/views/user/profile.php" class="user" title="Profil">
                <div class="avatar">A</div>
                <div class="user-info">
                    <span class="user-name">Annisa</span>
                    <span class="user-role">Member</span>
                </div>
            </a>

            <button class="logout-btn" title="Keluar">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Keluar
            </button>
        </div>
    </nav>

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
                
                <form action="<?= SECONDIFY ?>/apps/views/user/dashboard.php" method="POST">
                    <div class="inputGambar">
                        <p class="judulUpload">Foto Barang</p>
                        <label class="kotakUpload" for="upload-foto">
                            <input type="file" id="upload-foto" class="hiddenInput" accept="image/*">
                            <i data-lucide="image-plus"></i>
                            <span>Tambah</span>
                        </label>
                    </div>
                    <div class="namaBarang">
                        <label for="">Nama Barang</label>
                        <input type="text" name="namaBarang" id="namaBarang" placeholder="Masukkan nama barang">
                    </div>
                    <div class="rowInput">
                        <div class="hargaBarang">
                            <label for="">Harga</label>
                            <input type="number" name="hargaBarang" id="hargaBarang" placeholder="Masukkan harga barang">
                        </div>
                        <div class="kondisiBarang">
                            <label for="">Kondisi</label>
                            <select name="kondisiBarang" id="kondisiBarang">
                                <option value="">Pilih kondisi</option>
                                <option value="">Bekas</option>
                                <option value="">Baru</option>
                                <option value="">Seperti Baru</option>
                            </select>
                        </div>
                    </div>
                    <div class="rowInput2">
                        <div class="kategoriBarang">
                            <label for="">Kategori</label>
                            <select name="kategoriBarang" id="kategoriBarang">
                                <option value="">Pilih kategori</option>
                                <option value="">Pakaian</option>
                                <option value="">Elektronik</option>
                                <option value="">Sepatu</option>
                                <option value="">Aksesoris</option>
                                <option value="">Lainnya</option>
                            </select>
                        </div>
                        <div class="kecamatanBarang">
                            <label for="">Kecamatan</label>
                            <select name="kecamatanBarang" id="kecamatanBarang">
                                <option value="">Pilih kecamatan</option>
                                <option value="">Kedaton</option>
                                <option value="">Labuhan Ratu</option>
                                <option value="">Bumi Waras</option>
                                <option value="">Enggal</option>
                                <option value="">Kedamaian</option>
                                <option value="">Kemiling</option>
                                <option value="">Langkapura</option>
                                <option value="">Panjang</option>
                                <option value="">Rajabasa</option>
                                <option value="">Sukabumi</option>
                                <option value="">Sukarame</option>
                                <option value="">Tanjung Senang</option>
                                <option value="">Tanjung Karang Barat</option>
                                <option value="">Tanjung Karang Pusat</option>
                                <option value="">Tanjung Karang Timur</option>
                                <option value="">Teluk Betung Barat</option>
                                <option value="">Teluk Betung Selatan</option>
                                <option value="">Teluk Betung Timur</option>
                                <option value="">Teluk Betung Utara</option>
                                <option value="">Way Halim</option>
                            </select>
                        </div>
                    </div>
                    <div class="deskripsiBarang">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsiBarang" id="deskripsiBarang" placeholder="Masukkan deskripsi barang"></textarea>
                    </div>
                    <div class="rowButton">
                        <button class="buttonBatal">Batal</button>
                        <a href="<?= SECONDIFY ?>/apps/views/user/dashboard.php" class="buttonPosting">Posting Barang</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="<?= SECONDIFY; ?>/assets/js/global.js"></script>
</body>
</html>
