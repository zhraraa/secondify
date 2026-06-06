<?php
if (!defined('SECONDIFY')) {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $redirectUrl = str_replace('/apps/views/user/kategori.php', '/apps/controllers/user/kategoriController.php', $path);
    if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING']) {
        $redirectUrl .= '?' . $_SERVER['QUERY_STRING'];
    }
    header('Location: ' . $redirectUrl);
    exit;
}

/** @var array $dataUser */
/** @var array $dataProdukMarketplace */
$currentKategori = $currentKategori ?? 'semua';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori — Secondify</title>
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/user/kategori.css">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/layouts/navbar.css">
    <script src="<?= SECONDIFY; ?>/assets/js/layouts/navbar.js?v=20260529-1" defer></script>
<body>

    <!-- NAVBAR -->
    <?php include __DIR__ . '/../../controllers/layout/navbarController.php'; ?>


    <?php $categoryTitle = htmlspecialchars($currentKategoriName ?? 'Semua'); ?>

    <!-- BREADCRUMB -->
    <div class="breadcrumb">
        <a href="<?= SECONDIFY; ?>/apps/controllers/user/dashboardController.php">Beranda</a>
        <span class="sep">›</span>
        <a href="#">Kategori</a>
        <span class="sep">›</span>
        <span class="current" id="breadcrumbCurrent"><?= $categoryTitle ?></span>
    </div>


    <!-- PAGE HEADER -->
    <div class="page-header">
        <h2 id="pageTitle"><?= $categoryTitle ?></h2>
        <p id="pageSubtitle"><?= $currentKategori === 'semua' ? 'Jelajahi semua barang preloved yang tersedia' : "Temukan berbagai barang {$categoryTitle} preloved berkualitas" ?></p>
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

    <script>
        window.SECONDIFY_PRODUCTS = <?= json_encode($dataProdukMarketplace ?? [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
    </script>
    <script src="<?= SECONDIFY; ?>/assets/js/user/kategori.js?v=20260529-1"></script>
</body>
</html>
