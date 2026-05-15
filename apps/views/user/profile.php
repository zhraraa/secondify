<?php
session_start();
require_once '../../controllers/auth/auth_check.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';

$id_user = $_SESSION['id_user'];
$data = mysqli_query($conn, "SELECT * FROM users WHERE id_user = $id_user");
$row = mysqli_fetch_assoc($data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Secondify</title>
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/user/profile.css">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/layouts/navbar.css">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/style.css">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="<?= SECONDIFY; ?>/assets/js/layouts/navbar.js" defer></script>
</head>
<body>
    <!-- NAVBAR -->
    <?php include __DIR__ . '/../layout/navbar.php'; ?>

    <section>
        <div class="main">
            <!-- card profile atas -->
            <div class="cardProfile">
                <div class="bgProfile">
                </div>
                    <div class="isiProfile">
                        <?php 
                        $profile = $row['profile_pict'];
                        if($profile == NULL || $profile == ""){
                            $tampilkanProfile = "default.png";
                        } else {
                            $tampilkanProfile = $profile;
                        }
                        ?>
                        <img src="<?= SECONDIFY; ?>/assets/images/<?= $profile ?>" alt="" class="profilePic">
                        <div class="buttonArea">
                            <a href="<?= SECONDIFY ?>/apps/controllers/user/daftarPenjualController.php" class="btnToko">
                                <div  class="profile-button">
                                    <i data-lucide="store" class="icon"></i>
                                    <p>Buka Toko</p>
                                </div>
                            </a>
                            <a href="<?= SECONDIFY ?>/apps/views/user/setting.php" class="btnEdit">
                                <div class="profile-button">
                                    <i data-lucide="pencil" class="icon"></i>
                                    <p>Edit Profile</p>
                                </div>
                            </a>
                        </div>
                        <div class="dataProfile">
                            <div class="usn">
                                <h4 class="nama-profile">
                                    <?= $row['nama_lengkap'] ?>
                                </h4>
                                <p class="username">
                                    <?= "@" . $row['username'] ?>
                                </p>
                            </div>
                            <div class="infoToko">
                                <div class="ratingToko">
                                    <i data-lucide="star" class="icon" style="fill: #886BC6; stroke-width: 0; width: 18px;"></i>
                                    <span>4.8</span>
                                    <span>(2 ulasan)</span>
                                </div>
                                <span>|</span>
                                <div class="barangAktif">
                                    <span>2 </span>
                                    <span>barang aktif</span>
                                </div>
                                <span>|</span>
                                <div class="totalJual">
                                    <span>2 </span>
                                    <span>Terjual</span>
                                </div>
                            </div>
                            <div class="dataLokasi">
                                <i data-lucide="map-pin" class="icon"></i>
                                <p>
                                    <?=$row['lokasi'] . ", Bandar Lampung"?>
                                </p>
                            </div>
                            <p class="bio">
                                <?= $row['bio'] ?>
                            </p>
                        </div>
                    </div>
            </div>


            <!-- bagian bawah tempat produk sama ulasan toko -->
            <div class="cardToko">
                <div class="navJualan"> 

                    <div class="backgroundGeser" id="bg-geser"></div>

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
                <div class="cardJualan" id="wadahProduk">
                    <div class="cardBarang">
                        <img src="<?= SECONDIFY; ?>/assets/images/barang/produk.png" alt="">
                        <div class="detailBarang">
                            <p>Sunscreen OMG</p>
                            <p class="harga">Rp 50.000</p>
                        </div>
                    </div>
                    <div class="cardBarang">
                        <img src="<?= SECONDIFY; ?>/assets/images/barang/produk.png" alt="">
                        <div class="detailBarang">
                            <p>Sunscreen OMG</p>
                            <p class="harga">Rp 50.000</p>
                        </div>
                    </div>
                    <div class="cardBarang">
                        <img src="<?= SECONDIFY; ?>/assets/images/barang/produk.png" alt="">
                        <div class="detailBarang">
                            <p>Sunscreen OMG</p>
                            <p class="harga">Rp 50.000</p>
                        </div>
                    </div>
                    <div class="cardBarang">
                        <img src="<?= SECONDIFY; ?>/assets/images/barang/produk.png" alt="">
                        <div class="detailBarang">
                            <p>Sunscreen OMG</p>
                            <p class="harga">Rp 50.000</p>
                        </div>
                    </div>
                </div>
                <!-- ULASAN YA--------------------^^ -->
                <div class="hidden" id="wadahUlasan">
                    <div class="cardUlasan">
                        <div class="rowUlasan">
                            <img src="<?= SECONDIFY; ?>/assets/images/profile.jpg" alt="" class="ppUlasan">
                            <div class="namaUlasan">
                                <span>Rara</span>
                                <span>12 April 2026</span>
                            </div>
                        </div>
                        <div class="bintang">
                            <i data-lucide="star" class="icon" style="fill: #886BC6; stroke-width: 0; width: 18px;"></i>
                            <i data-lucide="star" class="icon" style="fill: #886BC6; stroke-width: 0; width: 18px;"></i>
                            <i data-lucide="star" class="icon" style="fill: #886BC6; stroke-width: 0; width: 18px;"></i>
                            <i data-lucide="star" class="icon" style="fill: #886BC6; stroke-width: 0; width: 18px;"></i>
                            <i data-lucide="star" class="icon" style="fill: #886BC6; stroke-width: 0; width: 18px;"></i>
                        </div>
                        <div class="produkUlasan">
                            <span>Produk dibeli:</span>
                            <div class="rowProduk">
                                <img src="<?= SECONDIFY; ?>/assets/images/barang/produk.png" alt="">
                                <span>Vaseline Gluta-Hya</span>
                            </div>
                        </div>
                        <span class="teksUlasan">
                            Bagusss, penjualnya ramahh banget + dapet freebies, thank uu kakk
                        </span>
                    </div>
                    <div class="cardUlasan">
                        <div class="rowUlasan">
                            <img src="<?= SECONDIFY; ?>/assets/images/barang/produk.png" alt="" class="ppUlasan">
                            <div class="namaUlasan">
                                <span>Rara</span>
                                <span>12 April 2026</span>
                            </div>
                        </div>
                        <div class="bintang">
                            <i data-lucide="star" class="icon" style="fill: #886BC6; stroke-width: 0; width: 18px;"></i>
                            <i data-lucide="star" class="icon" style="fill: #886BC6; stroke-width: 0; width: 18px;"></i>
                            <i data-lucide="star" class="icon" style="fill: #886BC6; stroke-width: 0; width: 18px;"></i>
                            <i data-lucide="star" class="icon" style="fill: #886BC6; stroke-width: 0; width: 18px;"></i>
                            <i data-lucide="star" class="icon" style="fill: #886BC6; stroke-width: 0; width: 18px;"></i>
                        </div>
                        <div class="produkUlasan">
                            <span>Produk dibeli:</span>
                            <div class="rowProduk">
                                <img src="<?= SECONDIFY; ?>/assets/images/barang/produk.png" alt="">
                                <span>Vaseline Gluta-Hya</span>
                            </div>
                        </div>
                        <span class="teksUlasan">
                            Bagusss, penjualnya ramahh banget + dapet freebies, thank uu kakk
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <script src="<?= SECONDIFY; ?>/assets/js/global.js"></script>
    <script src="<?= SECONDIFY; ?>/assets/js/user/profile.js"></script>
</body>
</html>
