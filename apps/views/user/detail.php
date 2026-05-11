<?php
require_once '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk — Secondify</title>
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/user/detail.css">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <a href="<?= SECONDIFY; ?>/apps/views/user/dashboard.php" style="text-decoration: none;">
            <img src="<?= SECONDIFY; ?>/assets/images/logo/logo.png" alt="Secondify" class="logo">
        </a>

        <div class="search-box">
            <input type="text" placeholder="Mau cari barang apa hari ini?" id="searchInput">
        </div>

        <div class="nav-right">
            <a href="<?= SECONDIFY; ?>/apps/views/user/favorit.php" class="nav-icon-btn" title="Wishlist" style="text-decoration: none; color: inherit;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
            </a>
            <a href="<?= SECONDIFY; ?>/apps/views/user/chat.php" class="nav-icon-btn" title="Notifikasi" style="text-decoration: none; color: inherit;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
            </a>
            <div class="nav-divider"></div>
            <a href="<?= SECONDIFY; ?>/apps/views/user/profile.php" class="user" title="Profil">
                <div class="avatar">A</div>
                <div class="user-info">
                    <span class="user-name">alyssa</span>
                    <span class="user-role">Member</span>
                </div>
            </a>
            <a href="<?= SECONDIFY; ?>/index.php" class="logout-btn" title="Keluar" style="text-decoration: none; color: inherit;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Keluar
            </a>
        </div>
    </nav>

    <!-- BREADCRUMB -->
    <div class="breadcrumb">
        <a href="<?= SECONDIFY; ?>/apps/views/user/dashboard.php">Beranda</a>
        <span class="sep">›</span>
        <a href="#" id="bcKategori">Kategori</a>
        <span class="sep">›</span>
        <a href="#" id="bcSubKategori">Sub Kategori</a>
        <span class="sep">›</span>
        <span class="current" id="bcNama">Produk</span>
    </div>

    <!-- MAIN DETAIL LAYOUT -->
    <div class="detail-layout">

        <!-- LEFT: Gallery -->
        <div class="gallery-section">
            <div class="main-image-wrap">
                <img src="<?= SECONDIFY; ?>/assets/images/barang/produk.png" alt="" id="mainImage" class="main-image">
                <span class="kondisi-badge" id="kondisiBadge"></span>
                <button class="wishlist-fab" id="wishlistFab" title="Simpan ke Wishlist">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                </button>
            </div>
            <!-- Thumbnails -->
            <div class="thumbs" id="thumbs"></div>
        </div>

        <!-- RIGHT: Info -->
        <div class="info-section">
            <!-- Top: name, price, location -->
            <div class="info-top">
                <div class="info-top-header">
                    <div class="product-name" id="productName">Memuat...</div>
                    <span class="kondisi-pill" id="kondisiPill"></span>
                </div>
                <div class="product-price" id="productPrice">Rp —</div>
                <div class="product-location-row">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                    <span id="productLocation">—</span>
                    <span class="dot">·</span>
                    <span class="tanggal-listed" id="tanggalListed">Bandar Lampung</span>
                </div>
            </div>

            <!-- Detail Barang -->
            <div class="detail-box">
                <div class="detail-box-title">Detail Barang</div>
                <div class="detail-grid">
                    <div class="detail-row">
                        <span class="detail-key">Kategori</span>
                        <span class="detail-val" id="dKategori">—</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-key">Merek</span>
                        <span class="detail-val" id="dMerek">—</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-key">Kondisi</span>
                        <span class="detail-val" id="dKondisi">—</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-key">Lokasi</span>
                        <span class="detail-val" id="dLokasi">—</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-key">Status</span>
                        <span class="detail-val" id="dTerjual">—</span>
                    </div>
                </div>
                <div class="detail-desc-label">Deskripsi</div>
                <div class="detail-desc" id="productDesc">—</div>
            </div>

            <!-- Penjual -->
            <div class="seller-box">
                <div class="detail-box-title">Penjual</div>
                <div class="seller-row">
                    <div class="seller-avatar">R</div>
                    <div class="seller-info">
                        <div class="seller-name">rafi.collections</div>
                        <div class="seller-meta">Bergabung Jan 2024</div>
                    </div>
                    <button class="seller-chat-btn">Chat Penjual</button>
                </div>
            </div>

            <!-- Keamanan Bertransaksi -->
            <div class="safety-box">
                <div class="safety-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                    Keamanan Bertransaksi di Secondify
                </div>
                <ul class="safety-list">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        Selalu lakukan COD atau Transfer lewat rekening terpercaya
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        Barang, lengkap &amp; layak sesuai deskripsi
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        Jangan transfer sebelum barang dicek langsung
                    </li>
                </ul>
            </div>

            <!-- CTA Buttons -->
            <div class="cta-row">
                <button class="btn-chat-now" id="btnChat">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                    Ajukan COD
                </button>
                <button class="btn-report" id="btnReport">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    Laporkan Barang
                </button>
            </div>
        </div>
    </div>

    <!-- PRODUK TERKAIT -->
    <div class="related-section">
        <div class="related-header">
            <h3>Barang Serupa</h3>
            <a href="#" id="lihatSemua" class="lihat-semua">Lihat Semua →</a>
        </div>
        <div class="related-grid" id="relatedGrid">
            <!-- injected by JS -->
        </div>
    </div>

    <footer class="footer">
        © 2026 Secondify — Marketplace barang bekas Bandar Lampung.
    </footer>

    <!-- Toast notification -->
    <div class="toast" id="toast"></div>

    <script src="<?= SECONDIFY; ?>/assets/js/user/detail.js?v=20260511-3"></script>
</body>
</html>
