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
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/user/profile.css">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/style.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar">
        
        <a href="<?= SECONDIFY; ?>/apps/views/user/dashboard.php" style="text-decoration: none;">
            <img src="<?= SECONDIFY; ?>/assets/images/logo/logo.png" alt="" class="logo">
        </a>

        <div class="search-box">
            <input type="text" placeholder="Mau cari barang apa hari ini?" id="searchInput">
        </div>

        <div class="nav-right">
            <!-- Wishlist -->
            <a href="<?= SECONDIFY ?>/apps/views/user/favorit.php" class="nav-icon-btn" title="Wishlist" style="text-decoration: none; color: inherit;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
            </a>

            <!-- Notification -->
            <a href="<?= SECONDIFY ?>/apps/views/user/chat.php" class="nav-icon-btn" title="Notifikasi" style="text-decoration: none; color: inherit;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
            </a>

            <a href="<?= SECONDIFY ?>/apps/views/user/chat.php" class="msgButton" style="text-decoration: none; color: inherit;">
                <i data-lucide="message-square" class="icon" style="width: 16px;"></i>  
            </a>

            <div class="nav-divider"></div>

            <a href="<?= SECONDIFY ?>/apps/views/user/profile.php" class="user" title="Profil">
                <div class="avatar">A</div>
                <div class="user-info">
                    <span class="user-name">Annisa</span>
                    <span class="user-role">Member</span>
                </div>
            </a>

            <a href="<?= SECONDIFY ?>/index.php" class="logout-btn" title="Keluar" style="text-decoration: none; color: inherit;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Keluar
            </a>
        </div>
    </nav>

    <section>
        <div class="main">
            <!-- card profile atas -->
            <div class="cardProfile">
                <div class="bgProfile">
                </div>
                    <div class="isiProfile">
                        <img src="<?= SECONDIFY; ?>/assets/images/profile.jpg" alt="" class="profilePic">
                        <div class="buttonArea">
                            <a href="<?= SECONDIFY ?>/apps/views/user/formDaftarPenjual.php" class="btnToko">
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
                                <h4 class="nama-profile">Rara Cantik</h4>
                                <p class="username">@raracantik123</p>
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
                                <p>Kedaton, Bandar Lampung</p>
                            </div>
                            <p class="bio">Menjual berbagai barang imup dan kiyowo. Yang ga kiyowo ga dijual hehehehe. Btw wanna be moots??</p>
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
