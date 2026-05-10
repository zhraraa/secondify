<?php
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda — Secondify</title>
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/user/dashboard.css">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        
        <img src="<?= SECONDIFY ?>/assets/images/logo/logo.png" alt="" class="logo">

        <div class="search-box">
            <input type="text" placeholder="Mau cari barang apa hari ini?" id="searchInput">
        </div>

        <div class="nav-right">
            <!-- Wishlist -->
            <button class="nav-icon-btn" title="Wishlist">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
            </button>

            <!-- Notification -->
            <button class="nav-icon-btn" title="Notifikasi">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
            </button>

            <div class="nav-divider"></div>

            <a href="<?= SECONDIFY; ?>/apps/views/user/profile.php" class="user" title="Profil">
                <div class="avatar">A</div>
                <div class="user-info">
                    <span class="user-name">alyssa</span>
                    <span class="user-role">Member</span>
                </div>
            </a>

            <button class="logout-btn" title="Keluar">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Keluar
            </button>
        </div>
    </nav>


    <!-- HERO -->
    <section class="hero">
        <div class="hero-left">
            <p class="badge">✨ Best Seller Minggu Ini</p>
            <h1>Temukan barang bekas berkualitas di sekitarmu!</h1>
            <p>Belanja hemat, jual cepat — semua ada di Secondify, marketplace warga Bandar Lampung.</p>
            <div class="hero-btn">
                <button class="btn-primary">Mulai Belanja</button>
                <button class="btn-secondary">Pelajari →</button>
            </div>
        </div>
        <div class="hero-right">
            <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?w=400&h=400&fit=crop&crop=faces" alt="Shopping">
        </div>
    </section>


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
            <!-- Semua -->
            <div class="kategori-item active" data-kategori="semua">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                </div>
                Semua
            </div>

            <!-- Elektronik -->
            <div class="kategori-item" data-kategori="elektronik">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="8" y1="19" x2="8" y2="21"/><line x1="16" y1="19" x2="16" y2="21"/><line x1="5" y1="21" x2="19" y2="21"/></svg>
                </div>
                Elektronik
            </div>

            <!-- Pakaian -->
            <div class="kategori-item" data-kategori="pakaian">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><path d="M20.38 3.46L16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.57a1 1 0 0 0 .99.84H6v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.57a2 2 0 0 0-1.34-2.23z"/></svg>
                </div>
                Pakaian
            </div>

            <!-- Buku -->
            <div class="kategori-item" data-kategori="buku">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                </div>
                Buku
            </div>

            <!-- Perabot -->
            <div class="kategori-item" data-kategori="perabot">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 9V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v3"/><path d="M2 11a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v3H2v-3z"/><path d="M4 14v5M20 14v5"/><line x1="6" y1="19" x2="18" y2="19"/></svg>
                </div>
                Perabot
            </div>

            <!-- Olahraga -->
            <div class="kategori-item" data-kategori="olahraga">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M4.93 4.93l4.24 4.24"/><path d="M14.83 9.17l4.24-4.24"/><path d="M14.83 14.83l4.24 4.24"/><path d="M9.17 14.83l-4.24 4.24"/><circle cx="12" cy="12" r="4"/></svg>
                </div>
                Olahraga
            </div>

            <!-- Mainan -->
            <div class="kategori-item" data-kategori="mainan">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="3"/><line x1="6" y1="5" x2="6" y2="19"/><line x1="18" y1="5" x2="18" y2="19"/><line x1="2" y1="12" x2="22" y2="12"/></svg>
                </div>
                Mainan
            </div>

            <!-- Anak -->
            <div class="kategori-item" data-kategori="anak">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 21c0-3.5 3-6 6.5-6s6.5 2.5 6.5 6"/></svg>
                </div>
                Anak
            </div>

            <!-- Handphone -->
            <div class="kategori-item" data-kategori="handphone">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                </div>
                Handphone
            </div>

            <!-- Kendaraan -->
            <div class="kategori-item" data-kategori="kendaraan">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4l3 5v3h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                </div>
                Kendaraan
            </div>

            <!-- Dapur -->
            <div class="kategori-item" data-kategori="dapur">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
                </div>
                Dapur
            </div>

            <!-- Tas -->
            <div class="kategori-item" data-kategori="tas">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                </div>
                Tas
            </div>

            <!-- Sepatu -->
            <div class="kategori-item" data-kategori="sepatu">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><path d="M3 10h11a4 4 0 0 1 4 4v2H3v-6z"/><path d="M3 16v2a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-2"/><path d="M9 10V6a3 3 0 0 1 6 0v4"/></svg>
                </div>
                Sepatu
            </div>

            <!-- Kamera -->
            <div class="kategori-item" data-kategori="kamera">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                </div>
                Kamera
            </div>

            <!-- Alat Tulis -->
            <div class="kategori-item" data-kategori="alat-tulis">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><line x1="12" y1="20" x2="12" y2="4"/><path d="M8 8l4-4 4 4"/><rect x="4" y="20" width="16" height="2" rx="1"/></svg>
                </div>
                Alat Tulis
            </div>

            <!-- Koleksi -->
            <div class="kategori-item" data-kategori="koleksi">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                </div>
                Koleksi
            </div>

            <!-- Kesehatan -->
            <div class="kategori-item" data-kategori="kesehatan">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                </div>
                Kesehatan
            </div>

            <!-- Lainnya -->
            <div class="kategori-item" data-kategori="lainnya">
                <div class="kat-icon">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
                </div>
                Lainnya
            </div>
        </div>
    </section>


    <!-- REKOMENDASI -->
    <section class="rekomendasi">
        <div class="rek-header">
            <h3 class="rek-title">
                🔥 Rekomendasi Untukmu
                <span class="rek-count">0 barang</span>
            </h3>

            <div class="sort-wrapper">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="6" y1="12" x2="18" y2="12"/>
                    <line x1="9" y1="18" x2="15" y2="18"/>
                </svg>
                <select>
                    <option>Terbaru</option>
                    <option>Harga Termurah</option>
                    <option>Harga Termahal</option>
                </select>
                <svg class="sort-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </div>
        </div>

        <div class="empty-state">
            <div class="empty-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <path d="M16 10a4 4 0 0 1-8 0"/>
                </svg>
            </div>
            <h4>Belum ada barang ditemukan</h4>
            <p>Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
        </div>
    </section>

    <footer class="footer">
        © 2026 Secondify — Marketplace barang bekas Bandar Lampung.
    </footer>

    <script src="<?= SECONDIFY ?>/assets/js/user/dashboard.js"></script>
</body>
</html>