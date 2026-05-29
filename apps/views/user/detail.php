<?php
/** @var array $dataUser */
/** @var array $dataProdukMarketplace */
/** @var array|null $dataProdukDetail */
/** @var int $idProduk */
/** @var array|null $product */
/** @var bool $notFound */
/** @var string $fotoProduk */
/** @var string $kategoriSlug */
/** @var string $kategoriLabel */
/** @var string $kondisi */
/** @var string $kondisiLabel */
/** @var string $sellerName */
/** @var string $sellerInitial */
/** @var string $terjualLabel */
/** @var string $chatUrl */
/** @var string $title */
/** @var string $bcSubKategori */
/** @var bool $hasSubKategori */
/** @var string $detailsKategori */
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/user/detail.css?v=20260528-4">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/layouts/navbar.css">
    <script src="<?= SECONDIFY; ?>/assets/js/layouts/navbar.js" defer></script>
<body>

    <!-- NAVBAR -->
    <?php include __DIR__ . '/../layout/navbar.php'; ?>

    <?php if ($notFound): ?>
        <div class="breadcrumb">
            <a href="<?= SECONDIFY; ?>/apps/controllers/user/dashboardController.php">Beranda</a>
            <span class="sep">›</span>
            <span class="current">Produk Tidak Ditemukan</span>
        </div>

        <main class="detail-layout" style="padding: 80px 24px; text-align:center;">
            <h2>Produk tidak ditemukan</h2>
            <p>Produk yang kamu cari tidak ada atau sudah dihapus.</p>
            <a href="<?= SECONDIFY; ?>/apps/controllers/user/dashboardController.php" class="btn-primary" style="margin-top:24px; display:inline-block;">Kembali ke Beranda</a>
        </main>
    <?php else: ?>
        <div class="breadcrumb">
            <a href="<?= SECONDIFY; ?>/apps/controllers/user/dashboardController.php">Beranda</a>
            <span class="sep">›</span>
            <a href="<?= SECONDIFY; ?>/apps/controllers/user/kategoriController.php?kat=<?= $kategoriSlug ?>" id="bcKategori"><?= htmlspecialchars($kategoriLabel) ?></a>
            <span class="sep">›</span>
            <?php if ($hasSubKategori): ?>
                <a href="#" id="bcSubKategori"><?= $bcSubKategori ?></a>
                <span class="sep">›</span>
            <?php else: ?>
                <a href="#" id="bcSubKategori" style="display:none;"></a>
            <?php endif; ?>
            <span class="current" id="bcNama"><?= htmlspecialchars($product['nama']) ?></span>
        </div>

        <div class="detail-layout">

            <!-- LEFT: Gallery -->
            <div class="gallery-section">
                <div class="main-image-wrap">
                    <img src="<?= SECONDIFY; ?>/assets/images/<?= $fotoProduk ?>" alt="<?= htmlspecialchars($product['nama']) ?>" id="mainImage" class="main-image">
                    <span class="kondisi-badge" id="kondisiBadge"><?= htmlspecialchars($kondisiLabel) ?></span>
                    <button class="wishlist-fab" id="wishlistFab" title="Simpan ke Wishlist">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                        </svg>
                    </button>
                </div>
                <div class="thumbs" id="thumbs"></div>
            </div>

            <!-- RIGHT: Info -->
            <div class="info-section">
                <div class="info-top">
                    <div class="info-top-header">
                        <div class="product-name" id="productName"><?= htmlspecialchars($product['nama']) ?></div>
                        <span class="kondisi-pill <?= $kondisi === 'baru' ? 'pill-baru' : ($kondisi === 'seperti-baru' ? 'pill-seperti-baru' : 'pill-bekas') ?>" id="kondisiPill"><?= htmlspecialchars($kondisiLabel) ?></span>
                    </div>
                    <div class="product-price" id="productPrice">Rp <?= number_format((int)$product['harga'], 0, ',', '.') ?></div>
                    <div class="product-location-row">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        <span id="productLocation"><?= htmlspecialchars($product['lokasi']) ?></span>
                        <span class="dot">·</span>
                        <span class="tanggal-listed" id="tanggalListed">Bandar Lampung</span>
                    </div>
                </div>

                <div class="detail-box">
                    <div class="detail-box-title">Detail Barang</div>
                    <div class="detail-grid">
                        <div class="detail-row">
                            <span class="detail-key">Kategori</span>
                            <span class="detail-val" id="dKategori"><?= htmlspecialchars($detailsKategori) ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-key">Merek</span>
                            <span class="detail-val" id="dMerek"><?= htmlspecialchars($product['merek'] ?? 'Lainnya') ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-key">Kondisi</span>
                            <span class="detail-val" id="dKondisi"><?= htmlspecialchars($kondisiLabel) ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-key">Lokasi</span>
                            <span class="detail-val" id="dLokasi"><?= htmlspecialchars($product['lokasi']) ?>, Bandar Lampung</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-key">Status</span>
                            <span class="detail-val" id="dTerjual"><?= htmlspecialchars($terjualLabel) ?></span>
                        </div>
                    </div>
                    <div class="detail-desc-label">Deskripsi</div>
                    <div class="detail-desc" id="productDesc"><?= nl2br(htmlspecialchars($product['deskripsi'])) ?></div>
                </div>

                <div class="seller-box">
                    <div class="detail-box-title">Penjual</div>
                    <div class="seller-row">
                        <div class="seller-avatar"><?= htmlspecialchars($sellerInitial) ?></div>
                        <div class="seller-info">
                            <div class="seller-name"><?= htmlspecialchars($sellerName) ?></div>
                            <div class="seller-meta"><?= htmlspecialchars($product['nama_toko'] ? 'Toko Terverifikasi' : 'Penjual Secondify') ?></div>
                        </div>
                        <a href="<?= SECONDIFY; ?>/apps/controllers/user/profileController.php?id=<?= $product['id_user'] ?>" class="seller-chat-btn">Profil Penjual</a>
                    </div>
                </div>

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

        <div class="related-section">
            <div class="related-header">
                <h3>Barang Serupa</h3>
                <a href="#" id="lihatSemua" class="lihat-semua">Lihat Semua →</a>
            </div>
            <div class="related-grid" id="relatedGrid"></div>
        </div>
    <?php endif; ?>

    <footer class="footer">
        © 2026 Secondify — Marketplace barang bekas Bandar Lampung.
    </footer>

    <div class="toast" id="toast"></div>

    <div class="report-overlay" id="reportOverlay" aria-hidden="true">
        <div class="report-modal" role="dialog" aria-modal="true" aria-labelledby="reportTitle">
            <button class="report-close" id="reportClose" type="button" aria-label="Tutup laporan">&times;</button>
            <div class="report-modal-title" id="reportTitle">Laporkan Barang</div>
            <div class="report-product-name" id="reportProductName">Produk</div>
            <div class="report-form">
                <div class="report-field">
                    <label for="reportReason">Alasan laporan</label>
                    <div class="report-input-wrap report-select-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 8v4M12 16h.01"/>
                        </svg>
                        <select id="reportReason">
                            <option value="Barang tidak sesuai deskripsi">Barang tidak sesuai deskripsi</option>
                            <option value="Barang mencurigakan / palsu">Barang mencurigakan / palsu</option>
                            <option value="Penjual tidak responsif">Penjual tidak responsif</option>
                            <option value="Konten tidak pantas">Konten tidak pantas</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>
                <div class="report-field">
                    <label for="reportDetail">Detail laporan</label>
                    <div class="report-input-wrap report-textarea-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                        <textarea id="reportDetail" rows="4" placeholder="Tulis detail laporan barang ini..."></textarea>
                    </div>
                </div>
                <div class="report-actions">
                    <button class="report-cancel" id="reportCancel" type="button">Batal</button>
                    <button class="report-submit" id="reportSubmit" type="button">Kirim Laporan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.SECONDIFY_PRODUCTS = <?= json_encode($dataProdukMarketplace ?? [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
        window.SECONDIFY_PRODUCT_ID = <?= (int) ($idProduk ?? 0); ?>;
        window.SECONDIFY_CURRENT_USER_ID = <?= (int) ($dataUser['id_user'] ?? 0); ?>;
    </script>
    <script src="<?= SECONDIFY; ?>/assets/js/user/detail.js?v=20260528-4"></script>
</body>
</html>
