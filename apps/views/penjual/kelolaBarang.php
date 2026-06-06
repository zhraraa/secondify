<?php

/** @var array $dataProduk */
/** @var array $barangAktif */
/** @var array $barangTerjual*/
/** @var array $pembeli*/
/** @var array $dropdownValue*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Barang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/penjual/kelolaBarang.css">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/layouts/navbar.css">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/style.css">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="<?= SECONDIFY; ?>/assets/js/layouts/navbar.js" defer></script>
</head>

<body>
    <!-- NAVBAR -->
    <?php include __DIR__ . '/../../controllers/layout/navbarController.php'; ?>

    <section>
        <div class="header">
            <div class="title">
                <span>Barang Saya</span>
                <span>Kelola daftar barang yang dijual</span>
            </div>

            <a href="<?= SECONDIFY ?>/apps/controllers/penjual/jualBarangController.php" class="btn-tambah">
                <i data-lucide="plus" class="icon"></i>
                Tambah Barang
            </a>
        </div>

        <div class="kelola-barang">
            <div class="opsi">
                <div class="backgroundGeser" id="kelola-bg-geser"></div>
                <button id="btnAktif" class="btnAktif active" onclick="gantiHalamanKelola('barangAktif', this)">Aktif (<?= count($barangAktif) ?>)</button>
                <button id="btnTerjual" class="btnTerjual" onclick="gantiHalamanKelola('barangTerjual', this)">Terjual (<?= count($barangTerjual) ?>)</button>
            </div>

            <div class="list-barangAktif" id="wadahBarangAktif">
                <?php if (empty($barangAktif)): ?>
                    <div class="barangAktif-data-kosong">
                        <p>Belum ada barang yang aktif dijual nih.</p>
                    </div>
                <?php else : ?>
                    <?php foreach ($barangAktif as $data) : ?>
                        <div class="barang-item">
                            <a href="<?= SECONDIFY; ?>/apps/controllers/user/detailController.php?id=<?= $data['id_produk'] ?>" class="barang-item-link">
                                <div class="detail-barang">
                                    <img src="<?= SECONDIFY; ?>/assets/images/produk/<?= htmlspecialchars($data['foto_barang']) ?>" alt="barang">

                                    <div class="info-barang">
                                        <span class="kelolaBarang-status"><?= htmlspecialchars($data['status']) ?></span>
                                        <span class="kelolaBarang-nama"><?= htmlspecialchars($data['nama_barang']) ?></span>
                                        <span class="harga">Rp <?= number_format($data['harga'], 0, ',', '.') ?></span>

                                        <div class="lokasi">
                                            <i data-lucide="map-pin" class="icon"></i>
                                            <span><?= htmlspecialchars($data['lokasi']) ?>, Bandar Lampung</span>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <div class="kelolaBarang-wadahDropdown">
                                <button onclick="bukaTutup('<?= $data['id_produk'] ?>')" class="opsi-menu">
                                    <i data-lucide="ellipsis-vertical"></i>
                                </button>
                                <div id="dropdown-<?= $data['id_produk'] ?>" class="kelolaBarang-dropdown hidden">
                                    <button
                                        onclick="bukaModalUbah(this)"
                                        data-id="<?= $data['id_produk'] ?>"
                                        data-nama="<?= $data['nama_barang'] ?>"
                                        data-harga="<?= $data['harga'] ?>"
                                        data-deskripsi="<?= $data['deskripsi'] ?>"
                                        data-kondisi="<?= $data['kondisi'] ?>"
                                        data-kategori="<?= $data['id_kategori'] ?>"
                                        data-kecamatan="<?= $data['lokasi'] ?>">
                                        Ubah Barang
                                    </button>
                                    <button
                                        onclick="bukaModalTandaiTerjual(this)"
                                        data-id="<?= $data['id_produk'] ?>">
                                        Tandai Terjual
                                    </button>
                                    <button onclick="bukaModalHapus(this)"
                                        data-id="<?= $data['id_produk'] ?>">
                                        Hapus Barang
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="list-barangTerjual hidden" id="wadahBarangTerjual">
                <?php if (empty($barangTerjual)): ?>
                    <div class="barangAktif-data-kosong">
                        <p>Belum ada barang yang terjual nih.</p>
                    </div>
                <?php else : ?>
                    <?php foreach ($barangTerjual as $data) : ?>
                        <div class="barang-item">
                            <a href="<?= SECONDIFY; ?>/apps/controllers/user/detailController.php?id=<?= $data['id_produk'] ?>" class="barang-item-link">
                                <div class="detail-barang">
                                    <img src="<?= SECONDIFY; ?>/assets/images/produk/<?= htmlspecialchars($data['foto_barang']) ?>" alt="barang">

                                    <div class="info-barang">
                                        <span class="kelolaBarang-status"><?= htmlspecialchars($data['status']) ?></span>
                                        <span><?= htmlspecialchars($data['nama_barang']) ?></span>
                                        <span class="harga">Rp <?= number_format($data['harga'], 0, ',', '.') ?></span>
                                        <div class="lokasi">
                                            <i data-lucide="map-pin" class="icon"></i>
                                            <span><?= htmlspecialchars($data['lokasi']) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <div class="kelolaBarang-wadahDropdown">
                                <button onclick="bukaTutup('<?= $data['id_produk'] ?>')" class="opsi-menu">
                                    <i data-lucide="ellipsis-vertical"></i>
                                </button>

                                <div id="dropdown-<?= $data['id_produk'] ?>" class="kelolaBarang-dropdown hidden">
                                    <button onclick="bukaModalHapus(this)"
                                        data-id="<?= $data['id_produk'] ?>">
                                        Hapus Barang
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif; ?>
            </div>

            <div id="modalUbah" class="kelolaBarang-modalUbah hidden">
                <div class="kelolaBarang-isiModalUbah">
                    <h2>Ubah Data Produk</h2>
                    <form action="<?= SECONDIFY ?>/apps/controllers/penjual/ubahBarangController.php" method="POST">
                        <input type="hidden" name="id_produk" id="kelolaBarang-editId">

                        <div class="namaBarang">
                            <label for="editNamaBarang">Nama Barang</label>
                            <input type="text" name="namaBarang" id="kelolaBarang-NamaBarang" placeholder="Masukkan nama barang" maxlength="50" required>
                        </div>
                        <div class="rowInput">
                            <div class="hargaBarang">
                                <label for="editHargaBarang">Harga</label>
                                <input type="number" name="hargaBarang" id="kelolaBarang-HargaBarang" placeholder="Masukkan harga barang" required>
                            </div>

                            <div class="kondisiBarang">
                                <label for="editKondisiBarang">Kondisi</label>
                                <select name="kondisiBarang" id="kelolaBarang-KondisiBarang" required>
                                    <option value="">Pilih kondisi</option>
                                    <option value="bekas">Bekas</option>
                                    <option value="baru">Baru</option>
                                    <option value="seperti baru">Seperti Baru</option>
                                </select>
                            </div>
                        </div>
                        <div class="rowInput2">
                            <div class="kategoriBarang">
                                <label for="editKategoriBarang">Kategori</label>
                                <select name="kategoriBarang" id="kelolaBarang-kategoriBarang" required>
                                    <option value="">Pilih kategori</option>
                                    <option value="1">Elektronik</option>
                                    <option value="2">Pakaian</option>
                                    <option value="3">Buku</option>
                                    <option value="4">Perabot</option>
                                    <option value="5">Olahraga</option>
                                    <option value="6">Mainan</option>
                                    <option value="7">Anak</option>
                                    <option value="8">Handphone</option>
                                    <option value="9">Kendaraan</option>
                                    <option value="10">Dapur</option>
                                    <option value="11">Tas</option>
                                    <option value="12">Sepatu</option>
                                    <option value="13">Kamera</option>
                                    <option value="14">Alat Tulis</option>
                                    <option value="15">Koleksi</option>
                                    <option value="16">Kesehatan</option>
                                    <option value="17">Lainnya</option>
                                </select>
                            </div>
                            <div class="kecamatanBarang">
                                <label for="editKecamatanBarang">Kecamatan</label>
                                <select name="kecamatanBarang" id="kelolaBarang-kecamatanBarang" required>
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
                            <label for="editDeskripsiBarang">Deskripsi</label>
                            <textarea name="deskripsiBarang" id="kelolaBarang-DeskripsiBarang" placeholder="Masukkan deskripsi barang" required></textarea>
                        </div>

                        <div class="rowButton">
                            <button type="button" class="buttonBatal" onclick="tutupModal('modalUbah')">Batal</button>
                            <button type="submit" name="ubah" class="buttonPosting">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div id="modalStatus" class="kelolaBarang-modal <?= isset($_GET['tandaiTerjual']) ? '' : 'hidden' ?>">
        <div class="kelolaBarang-modalStatus">
            <h2>Status Produk</h2>
            <span>Produk telah terjual? ubah status menjadi terjual agar pembeli bisa memberikan ulasan untuk toko mu.</span>
            <form method="POST">
                <div class="inputGrup">
                    <label for="usnPembeli">Masukkan Username Pembeli</label>
                    <div class=opsiPembeli>
                        <input list="daftarPembeli" name="usnPembeli" id="usnPembeli" placeholder="Ketik username pembeli..." required>
                        <datalist id="daftarPembeli">
                            <option value="luarAplikasi">Luar Sistem Secondify</option>
                            <?php foreach ($dropdownValue as $data) : ?>
                                <option value="<?= $data['usename_pembeli'] ?>"><?= $data['pembeli'] ?></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                </div>
                <div class="rowButton" style="margin-top: 20px;">
                    <button type="button" class="buttonBatal" onclick="history.replaceState({}, '', location.pathname); tutupModal('modalStatus')">Batal</button>
                    <button type="submit" name="tandaiTerjual" class="buttonPosting">Simpan Status</button>
                </div>
            </form>
        </div>
    </div>

    <div class="kelolaBarang-modalHapus hidden" id="modalHapus">
        <div class="kelolaBarang-isiModalHapus">
            <h2>Hapus Produk</h2>
            <p style="margin-bottom: 20px;">Apakah anda yakin akan menghapus produk ini?</p>

            <form method="POST">
                <input type="hidden" name="id_produk" id="hapusIdProduk">

                <div class="rowButton">
                    <button type="button" class="buttonBatal" onclick="tutupModal('modalHapus')">Tidak, jangan hapus</button>
                    <button type="submit" name="hapusProduk" class="buttonPosting" style="background-color: #d93025;">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>



    <script src="<?= SECONDIFY; ?>/assets/js/global.js"></script>
    <script src="<?= SECONDIFY; ?>/assets/js/penjual/kelolaBarang.js"></script>
</body>

</html>