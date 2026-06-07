<?php
/** @var array $dataUser */
/** @var array $dataProduk */
/** @var array $totalProduk */
/** @var array $is_own_profile */
/** @var array $daftarUlasan */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Secondify</title>
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/layouts/navbar.css">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/style.css">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="<?= SECONDIFY; ?>/assets/js/layouts/navbar.js" defer></script>
</head>
<body class="profilPage">
    <!-- NAVBAR -->
    <?php include __DIR__ . '/../../controllers/layout/navbarController.php'; ?>

    <section>
        <div class="main">
            <!-- card profile atas -->
            <div class="cardProfile">
                <div class="bgProfile">
                </div>
                    <div class="isiProfile">
                        <?php 
                        $profile = $dataUser['profile_pict'];
                        
                        if($profile == NULL || $profile == ""){
                            $tampilkanProfile = "default.png";
                        } else {
                            $tampilkanProfile = $profile;
                        }
                        ?>
                        <img src="<?= SECONDIFY; ?>/assets/images/<?= $tampilkanProfile ?>" alt="" class="profilePic">
                        <?php if($is_own_profile): ?>
                        <div class="buttonArea">
                            <a href="<?= SECONDIFY ?>/apps/controllers/user/daftarPenjualController.php" class="btnToko">
                                <div  class="profile-button">
                                    <i data-lucide="store" class="icon"></i>
                                    <p>Buka Toko</p>
                                </div>
                            </a>
                            <a href="<?= SECONDIFY ?>/apps/controllers/user/settingController.php" class="btnEdit">
                                <div class="profile-button">
                                    <i data-lucide="pencil" class="icon"></i>
                                    <p>Edit Profile</p>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                        <div class="dataProfile">
                            <div class="usn">
                                <?php if($dataUser['is_penjual'] == 1):?>
                                    <h4 class="nama-profile">
                                        <?= $dataUser['nama_toko'] ?>
                                    </h4>
                                <?php else: ?>
                                    <h4 class="nama-profile">
                                        <?= $dataUser['nama_lengkap'] ?>
                                    </h4>
                                <?php endif; ?>
                                
                                <p class="username">
                                    <?= "@" . $dataUser['username'] ?>
                                </p>
                            </div>

                            <div class="dataLokasi">
                                <i data-lucide="map-pin" class="icon"></i>
                                <p>
                                    <?=$dataUser['lokasi'] . ", Bandar Lampung"?>
                                </p>
                            </div>
                            <p><?= $dataUser['bio'] ?></p>

                        </div>
                    </div>
            </div>


            <!-- bagian bawah tempat produk sama ulasan toko -->
            <div class="cardToko">
                <div class="navJualan"> 

                    <div class="backgroundGeser" id="profile-bg-geser"></div>

                    <button id="btnProduk" class="buttonJualan active" onclick="gantiHalaman('produk', this)">
                        <div class="rowButton">
                            <i data-lucide="shopping-bag" class="icon"></i>
                            <p>Produk Saya</p>
                        </div>
                    </button>
                    <button id="btnUlasan" class="buttonUlasan" onclick="gantiHalaman('ulasan', this)">
                        <div class="rowButton">
                            <i data-lucide="star" class="icon"></i>
                            <p>Ulasan</p>
                        </div>
                    </button>
                </div>
                <!-- daftar produk -->
                <div class="wadahProduk" id="wadahProduk"> 
                    <?php foreach ($dataProduk as $data): ?>
                        <a href="<?= SECONDIFY; ?>/apps/controllers/user/detailController.php?id=<?= $data['id_produk'] ?>" class="cardBarang cardBarangLink">
                            <img src="<?= SECONDIFY; ?>/assets/images/produk/<?= htmlspecialchars($data['foto_barang']) ?>" alt="barang">
                            <div class="detailBarang">
                                <span class="profile-namaBarang"><?= htmlspecialchars($data['nama_barang']) ?></span>
                                <p class="harga">Rp <?= number_format($data['harga'], 0, ',', '.') ?></p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
                <!-- ULASAN YA--------------------^^ -->
                <div class="hidden" id="wadahUlasan">
                    <?php foreach($daftarUlasan as $ulasan): ?>
                    <div class="cardUlasan">
                        <div class="rowUlasan">
                            <img src="<?= SECONDIFY; ?>/assets/images/profile.jpg" alt="" class="ppUlasan">
                            <div class="namaUlasan">
                                <span><?= $ulasan['nama_pembeli'] ?></span>
                                <span><?= $ulasan['tgl_ulasan'] ?></span>
                            </div>
                        </div>
                        <div class="bintang">
                            <?php for ($i = 1; $i <= $ulasan['rating']; $i++):  ?>
                            <i data-lucide="star" class="icon" style="fill: #886BC6; stroke-width: 0; width: 18px;"></i>
                            <?php endfor; ?>
                        </div>
                        <div class="produkUlasan">
                            <span>Produk dibeli:</span>
                            <div class="rowProduk">
                            <img src="<?= SECONDIFY; ?>/assets/images/produk/<?= $ulasan['foto_barang'] ?>" alt="">
                                <span><?= $ulasan['nama_barang'] ?></span>
                            </div>
                        </div>
                        <span class="teksUlasan">
                            <?= $ulasan['komentar'] ?>
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </section>
    <script src="<?= SECONDIFY; ?>/assets/js/global.js"></script>
    <script src="<?= SECONDIFY; ?>/assets/js/user/profile.js"></script>
</body>
</html>
