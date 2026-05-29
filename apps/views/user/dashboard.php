<?php
/** @var array $dataUser */
/** @var array $dataProdukMarketplace */
/** @var array $dataKategori */
/** @var string $currentKategori */
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda — Secondify</title>
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/user/dashboard.css">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/layouts/navbar.css">
    <script src="<?= SECONDIFY; ?>/assets/js/layouts/navbar.js" defer></script>
<body>

    <!-- NAVBAR -->
    <?php include __DIR__ . '/../layout/navbar.php'; ?>


    <!-- HERO -->
    <section class="hero">
        <div class="hero-left">
            <p class="badge">✨ Best Seller Minggu Ini</p>
            <h1>Temukan barang bekas berkualitas di sekitarmu!</h1>
            <p>Belanja hemat, jual cepat — semua ada di Secondify, marketplace warga Bandar Lampung.</p>
            <div class="hero-btn">
                <a href="<?= SECONDIFY; ?>/apps/controllers/user/kategoriController.php" class="btn-primary">Pelajari →</a>
            </div>
        </div>
        <div class="hero-right">
            <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?w=400&h=400&fit=crop&crop=faces" alt="Shopping">
        </div>
    </section>

    <?php if (!empty($daftarUlasanBelumDiisi)): ?>

    <section class="dashboard-ulasan">
        <h3>Gimana pengalaman kamu setelah berbelanja?</h3>
        
        <div class="dashboard-wadahUlasan">
            
            <?php foreach ($daftarUlasanBelumDiisi as $tagihan): ?>
                <div class="dashboard-cardUlasan">
                    
                    <div class="card-header">
                        <img src="<?= SECONDIFY ?>/assets/images/produk/<?= $tagihan['foto_barang'] ?>" alt="Foto Produk">
                        <div class="info-singkat">
                            <h4><?= htmlspecialchars($tagihan['nama_barang']) ?></h4>
                            <span>Toko: <?= htmlspecialchars($tagihan['nama_penjual']) ?></span>
                        </div>
                    </div>
                    
                    <div class="card-action">
                        <a href="<?= SECONDIFY ?>/apps/controllers/user/formUlasanController.php?id_review=<?= $tagihan['id_review'] ?>" class="btn-ulasan">
                            Beri Ulasan ⭐
                        </a>
                    </div>
                    
                </div>
            <?php endforeach; ?>
            
        </div>
    </section>

<?php endif; ?>


    <!-- KATEGORI -->
    <section class="kategori">
        <div class="kategori-header">
            <div class="section-title">
                <div class="section-accent"></div>
                <div>
                    <h3>Kategori</h3>
                    <p>Pilih kategori favoritmu</p>
                </div>
            </div>
        </div>

        <div class="kategori-list">
                <a href="<?= SECONDIFY; ?>/apps/controllers/user/kategoriController.php" class="kategori-item <?= ($currentKategori ?? 'semua') === 'semua' ? 'active' : '' ?>" data-kategori="semua" style="text-decoration: none; color: inherit;">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                </div>
                Semua
            </a>

            <?php foreach ($dataKategori as $kategori):
                $slugKategori = htmlspecialchars(slugKategori($kategori['nama_kategori']));
                $namaKategori = htmlspecialchars($kategori['nama_kategori']);
            ?>
                <a href="<?= SECONDIFY; ?>/apps/controllers/user/kategoriController.php?kat=<?= $slugKategori ?>" class="kategori-item <?= ($currentKategori ?? 'semua') === $slugKategori ? 'active' : '' ?>" data-kategori="<?= $slugKategori ?>" style="text-decoration: none; color: inherit;">
                    <div class="kat-icon">
                        <svg viewBox="0 0 24 24"><?= iconKategoriDashboard($slugKategori) ?></svg>
                    </div>
                    <?= $namaKategori ?>
                </a>
            <?php endforeach; ?>
        </div>
    </section>


    <!-- REKOMENDASI -->
    <section class="rekomendasi">
        <div class="rek-header">
            <h3 class="rek-title">
                🔥 Rekomendasi Untukmu
                <span class="rek-count"><?= count($dataProdukMarketplace ?? []) ?> barang</span>
            </h3>

            <div class="sort-wrapper">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="6" y1="12" x2="18" y2="12"/>
                    <line x1="9" y1="18" x2="15" y2="18"/>
                </svg>
                <select id="sortSelect" name="sort">
                    <option value="terbaru" <?= ($selectedSort ?? 'terbaru') === 'terbaru' ? 'selected' : '' ?>>Terbaru</option>
                    <option value="termurah" <?= ($selectedSort ?? 'terbaru') === 'termurah' ? 'selected' : '' ?>>Harga Termurah</option>
                    <option value="termahal" <?= ($selectedSort ?? 'terbaru') === 'termahal' ? 'selected' : '' ?>>Harga Termahal</option>
                </select>
                <svg class="sort-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </div>
        </div>

        <div class="recommendation-grid" id="recommendationGrid"></div>
    </section>

    <footer class="footer">
        © 2026 Secondify — Marketplace barang bekas Bandar Lampung.
    </footer>

    <script>
        window.SECONDIFY_PRODUCTS = <?= json_encode($dataProdukMarketplace ?? [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
    </script>
    <script src="<?= SECONDIFY ?>/assets/js/user/dashboard.js?v=20260528-2"></script>
</body>
</html>
