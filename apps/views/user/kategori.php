<?php
require_once '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori — Secondify</title>
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/user/kategori.css">
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
        <a href="#">Kategori</a>
        <span class="sep">›</span>
        <span class="current" id="breadcrumbCurrent">Elektronik</span>
    </div>


    <!-- PAGE HEADER -->
    <div class="page-header">
        <h2 id="pageTitle">Elektronik</h2>
        <p id="pageSubtitle">Temukan berbagai barang elektronik preloved berkualitas</p>
    </div>


    <!-- LAYOUT -->
    <div class="layout">

        <!-- FILTER SIDEBAR -->
        <aside class="filter-sidebar">
            <div class="filter-top">
                <h4>Filter</h4>
                <button class="filter-reset" id="filterReset">Reset</button>
            </div>

            <!-- Kondisi -->
            <div class="filter-group">
                <div class="filter-group-title">Kondisi Barang</div>
                <label>
                    <input type="checkbox" value="baru" class="cb-kondisi"> Baru
                    <span class="count-badge" id="cnt-baru">(0)</span>
                </label>
                <label>
                    <input type="checkbox" value="seperti-baru" class="cb-kondisi"> Seperti Baru
                    <span class="count-badge" id="cnt-seperti-baru">(0)</span>
                </label>
                <label>
                    <input type="checkbox" value="bekas" class="cb-kondisi"> Bekas
                    <span class="count-badge" id="cnt-bekas">(0)</span>
                </label>
            </div>

            <div class="filter-divider"></div>

            <!-- Harga -->
            <div class="filter-group">
                <div class="filter-group-title">Rentang Harga</div>
                <input type="range" class="price-slider" id="priceRange" min="0" max="20000000" value="20000000" step="50000">
                <div class="price-inputs">
                    <input type="text" id="priceMin" placeholder="Rp 0" readonly>
                    <span>–</span>
                    <input type="text" id="priceMax" placeholder="Rp 20.000.000" readonly>
                </div>
            </div>

            <div class="filter-divider"></div>

            <!-- Lokasi -->
            <div class="filter-group">
                <div class="filter-group-title">Lokasi (Kecamatan)</div>
                <div class="select-wrapper">
                    <select class="filter-select" id="lokasiFilter">
                        <option value="">Semua Kecamatan</option>
                        <option>Kedaton</option>
                        <option>Rajabasa</option>
                        <option>Sukarame</option>
                        <option>Langkapura</option>
                        <option>Tanjung Karang Barat</option>
                        <option>Tanjung Karang Timur</option>
                        <option>Labuhan Ratu</option>
                        <option>Way Halim</option>
                    </select>
                    <svg class="select-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </div>
            </div>

            <div class="filter-divider"></div>

            <!-- Merek (dinamis) -->
            <div class="filter-group" id="merekGroup">
                <div class="filter-group-title">Merek</div>
                <div id="merekList">
                    <!-- injected by JS based on available brands in category -->
                </div>
            </div>

            <button class="filter-apply-btn" id="filterApply">Terapkan Filter</button>
        </aside>


        <!-- MAIN CONTENT -->
        <main class="main-content">

            <div class="content-top">
                <div class="search-bar-inline">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <input type="text" id="inlineSearch" placeholder="Cari di Elektronik...">
                </div>

                <div class="content-right-controls">
                    <span class="result-count"><strong id="resultCount">0</strong> barang ditemukan</span>

                    <div class="sort-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="3" y1="6" x2="21" y2="6"/>
                            <line x1="6" y1="12" x2="18" y2="12"/>
                            <line x1="9" y1="18" x2="15" y2="18"/>
                        </svg>
                        <select id="sortSelect">
                            <option>Terbaru</option>
                            <option>Harga Termurah</option>
                            <option>Harga Termahal</option>
                        </select>
                        <svg class="sort-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- PRODUCT GRID -->
            <div class="product-grid" id="productGrid">
                <!-- Cards will be injected by JS -->
            </div>

            <!-- PAGINATION -->
            <div class="pagination" id="pagination"></div>

        </main>
    </div>

    <footer class="footer">
        © 2026 Secondify — Marketplace barang bekas Bandar Lampung.
    </footer>

    <script src="<?= SECONDIFY; ?>/assets/js/user/kategori.js?v=20260511-3"></script>
</body>
</html>
