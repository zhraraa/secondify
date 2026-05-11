<?php
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
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
        <div class="header">
            <div class="title">
                <span>Barang Saya</span>
                <span>Kelola daftar barang dagang saya</span>
            </div>

            <a href="<?= SECONDIFY ?>/apps/views/penjual/formJualBarang.php" class="btn-tambah">
                <i data-lucide="plus" class="icon"></i>
                Tambah Barang
            </a>
        </div>

        <div class="kelola-barang">
            <div class="opsi">
                <button class="active">Aktif (2)</button>
                <button>Tejual (1)</button>
            </div>

            <div class="list-barang">
                <div class="barang-item">
                    <div class="detail-barang">
                        <img src="<?= SECONDIFY; ?>/assets/images/barang/produk.png" alt="barang">
                        
                        <div class="info-barang">
                            <span>Sunscreen OMG</span>
                            <span class="harga">Rp 100.000.000</span>
                            
                            <div class="lokasi">
                                <i data-lucide="map-pin" class="icon"></i>
                                <span>Seputih Raman</span>
                            </div>
                        </div>
                    </div>
                    
                    <i data-lucide="ellipsis-vertical" class="opsi-menu"></i>
                </div>
                
                <div class="barang-item">
                    <div class="detail-barang">
                        <img src="<?= SECONDIFY; ?>/assets/images/barang/produk.png" alt="barang">
                        
                        <div class="info-barang">
                            <span>Sunscreen OMG</span>
                            <span class="harga">Rp 100.000.000</span>
                            
                            <div class="lokasi">
                                <i data-lucide="map-pin" class="icon"></i>
                                <span>Seputih Raman</span>
                            </div>
                        </div>
                    </div>
                    
                    <i data-lucide="ellipsis-vertical" class="opsi-menu"></i>
                </div>
            </div>
        </div>
    </section>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>