<?php
require_once '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderasi & Laporan — Secondify</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/admin/adminDashboard.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main-wrap">

    <div class="topbar">
        <div>
            <div class="topbar-title">Moderasi & Laporan</div>
            <div class="topbar-breadcrumb">Admin / <span>Moderasi & Laporan</span></div>
        </div>
        <div class="topbar-right">
            <button class="topbar-notif" onclick="showToast('Tidak ada notifikasi baru')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                <div class="notif-dot"></div>
            </button>
            <div class="sidebar-user" style="padding:6px 10px;margin:0;">
                <div class="sidebar-avatar" style="width:30px;height:30px;font-size:11px;">Y</div>
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name">Yusuf</div>
                    <div class="sidebar-user-role">Super Admin</div>
                </div>
            </div>
        </div>
    </div>

    <section class="page-content">

        <div class="section-header">
            <div>
                <div class="section-title">Moderasi & Laporan</div>
                <div class="section-sub">Tinjau barang yang dilaporkan dan kelola konten platform</div>
            </div>
            <span class="badge red" style="font-size:13px;padding:6px 14px;">5 Laporan Aktif</span>
        </div>

        <!-- TABS -->
        <div class="tab-nav" id="mod-tabs">
            <button class="tab-btn active" onclick="switchModTab(this,'laporan')">Laporan Masuk (5)</button>
            <button class="tab-btn" onclick="switchModTab(this,'barang')">Kelola Barang</button>
            <button class="tab-btn" onclick="switchModTab(this,'selesai')">Selesai (12)</button>
        </div>

        <!-- LAPORAN MASUK -->
        <div id="mod-laporan">

            <div class="report-card">
                <div class="report-head">
                    <div>
                        <div class="report-id">#RPT-001 · 04 Mei 2026, 09:14</div>
                        <div class="report-title">Barang tidak sesuai deskripsi</div>
                        <div class="report-meta">Dilaporkan oleh: <strong>dinda.belanja</strong> · Terlapor: <strong>rizky.store</strong></div>
                    </div>
                    <span class="badge red"><span class="badge-dot"></span>Baru</span>
                </div>
                <div class="report-product">
                    <div style="width:36px;height:36px;background:#f0eeff;border-radius:6px;display:flex;align-items:center;justify-content:center;">📦</div>
                    <div>
                        <div class="report-product-name">iPhone 14 128GB Bekas</div>
                        <div class="report-product-by">Oleh: Toko Rizky · Rp 5.200.000</div>
                    </div>
                </div>
                <div class="report-body">"Barang yang diterima kondisinya beda banget sama foto. Layarnya ada garis dan baterai cepet habis. Penjual bilang kondisi bagus tapi kenyataannya ngga."</div>
                <div class="action-row">
                    <button class="btn-action view" onclick="showToast('Membuka detail laporan #RPT-001')">Lihat Detail</button>
                    <button class="btn-action warn" onclick="showToast('Peringatan dikirim ke rizky.store')">Beri Peringatan</button>
                    <button class="btn-action danger" onclick="showToast('Barang iPhone 14 diturunkan!')">Turunkan Barang</button>
                    <button class="btn-action approve" onclick="showToast('Laporan #RPT-001 ditandai selesai')">Tandai Selesai</button>
                </div>
            </div>

            <div class="report-card">
                <div class="report-head">
                    <div>
                        <div class="report-id">#RPT-002 · 03 Mei 2026, 14:30</div>
                        <div class="report-title">Penjual tidak responsif / ghosting</div>
                        <div class="report-meta">Dilaporkan oleh: <strong>maya.preloved</strong> · Terlapor: <strong>toko.elektronik99</strong></div>
                    </div>
                    <span class="badge orange"><span class="badge-dot"></span>Proses</span>
                </div>
                <div class="report-product">
                    <div style="width:36px;height:36px;background:#fff3e6;border-radius:6px;display:flex;align-items:center;justify-content:center;">💻</div>
                    <div>
                        <div class="report-product-name">Laptop Asus VivoBook 15</div>
                        <div class="report-product-by">Oleh: toko.elektronik99 · Rp 4.500.000</div>
                    </div>
                </div>
                <div class="report-body">"Udah deal COD, tapi penjual tiba-tiba ga bisa dihubungi. Chat dibaca tapi ga dibalas. Minta tolong admin untuk bantu."</div>
                <div class="action-row">
                    <button class="btn-action view" onclick="showToast('Membuka detail laporan #RPT-002')">Lihat Detail</button>
                    <button class="btn-action warn" onclick="showToast('Peringatan dikirim ke toko.elektronik99')">Beri Peringatan</button>
                    <button class="btn-action danger" onclick="showToast('Akun toko.elektronik99 dibekukan sementara!')">Bekukan Akun</button>
                    <button class="btn-action approve" onclick="showToast('Laporan #RPT-002 ditandai selesai')">Tandai Selesai</button>
                </div>
            </div>

            <div class="report-card">
                <div class="report-head">
                    <div>
                        <div class="report-id">#RPT-003 · 02 Mei 2026, 08:55</div>
                        <div class="report-title">Barang diduga palsu / replika</div>
                        <div class="report-meta">Dilaporkan oleh: <strong>andi.sneakers</strong> · Terlapor: <strong>barang.murah.bdl</strong></div>
                    </div>
                    <span class="badge red"><span class="badge-dot"></span>Baru</span>
                </div>
                <div class="report-product">
                    <div style="width:36px;height:36px;background:#ffeaea;border-radius:6px;display:flex;align-items:center;justify-content:center;">👟</div>
                    <div>
                        <div class="report-product-name">Nike Air Jordan 1 Retro High</div>
                        <div class="report-product-by">Oleh: barang.murah.bdl · Rp 350.000</div>
                    </div>
                </div>
                <div class="report-body">"Harganya tidak masuk akal untuk sepatu original. Fotonya juga terlihat seperti barang KW. Perlu dicek keasliannya."</div>
                <div class="action-row">
                    <button class="btn-action view" onclick="showToast('Membuka detail laporan #RPT-003')">Lihat Detail</button>
                    <button class="btn-action danger" onclick="showToast('Barang Nike Air Jordan diturunkan!')">Turunkan Barang</button>
                    <button class="btn-action approve" onclick="showToast('Laporan #RPT-003 ditandai selesai')">Tandai Selesai</button>
                </div>
            </div>

        </div>

        <!-- KELOLA BARANG -->
        <div id="mod-barang" style="display:none;">
            <div class="card">
                <div class="table-toolbar">
                    <div class="search-input-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <input type="text" placeholder="Cari nama barang atau penjual...">
                    </div>
                    <select class="filter-select">
                        <option>Semua Status</option><option>Aktif</option><option>Diturunkan</option><option>Terjual</option>
                    </select>
                    <select class="filter-select">
                        <option>Semua Kategori</option><option>Elektronik</option><option>Pakaian</option><option>Sepatu</option>
                    </select>
                </div>
                <table class="data-table">
                    <thead>
                        <tr><th>Barang</th><th>Penjual</th><th>Kategori</th><th>Harga</th><th>Tgl Upload</th><th>Status</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>iPhone 14 128GB Bekas</strong></td><td>Toko Rizky</td><td>Handphone</td><td>Rp 5.200.000</td><td>1 Mei 2026</td>
                            <td><span class="badge orange"><span class="badge-dot"></span>Dilaporkan</span></td>
                            <td><div class="action-row"><button class="btn-action view" onclick="showToast('Membuka detail barang')">Detail</button><button class="btn-action danger" onclick="showToast('Barang diturunkan!')">Turunkan</button></div></td>
                        </tr>
                        <tr>
                            <td><strong>Sunscreen OMG 30ml</strong></td><td>Toko Rara</td><td>Kesehatan</td><td>Rp 50.000</td><td>20 Apr 2026</td>
                            <td><span class="badge green"><span class="badge-dot"></span>Aktif</span></td>
                            <td><div class="action-row"><button class="btn-action view" onclick="showToast('Membuka detail barang')">Detail</button><button class="btn-action warn" onclick="showToast('Barang ditandai untuk review')">Review</button></div></td>
                        </tr>
                        <tr>
                            <td><strong>Nike Air Jordan 1 Retro</strong></td><td>barang.murah.bdl</td><td>Sepatu</td><td>Rp 350.000</td><td>2 Mei 2026</td>
                            <td><span class="badge red"><span class="badge-dot"></span>Diturunkan</span></td>
                            <td><div class="action-row"><button class="btn-action view" onclick="showToast('Membuka detail barang')">Detail</button><button class="btn-action approve" onclick="showToast('Barang diaktifkan kembali!')">Aktifkan</button></div></td>
                        </tr>
                        <tr>
                            <td><strong>Laptop Asus VivoBook 15</strong></td><td>toko.elektronik99</td><td>Elektronik</td><td>Rp 4.500.000</td><td>28 Apr 2026</td>
                            <td><span class="badge orange"><span class="badge-dot"></span>Dilaporkan</span></td>
                            <td><div class="action-row"><button class="btn-action view" onclick="showToast('Membuka detail barang')">Detail</button><button class="btn-action danger" onclick="showToast('Barang diturunkan!')">Turunkan</button></div></td>
                        </tr>
                    </tbody>
                </table>
                <div class="pagination">
                    <span>Menampilkan 4 dari 348 barang</span>
                    <div class="page-btns"><button class="page-btn active">1</button><button class="page-btn">2</button><button class="page-btn">3</button><button class="page-btn">›</button></div>
                </div>
            </div>
        </div>

        <!-- SELESAI -->
        <div id="mod-selesai" style="display:none;">
            <div class="card">
                <div class="card-head"><div><h3>Laporan Selesai</h3><p>12 laporan telah ditangani</p></div></div>
                <table class="data-table">
                    <thead><tr><th>ID</th><th>Judul</th><th>Pelapor</th><th>Terlapor</th><th>Ditangani</th><th>Hasil</th></tr></thead>
                    <tbody>
                        <tr><td>#RPT-000</td><td>Barang tidak dikirim</td><td>sari.belanja</td><td>toko.abal</td><td>28 Apr 2026</td><td><span class="badge green">Akun Dibekukan</span></td></tr>
                        <tr><td>#RPT-098</td><td>Foto produk menyesatkan</td><td>user.lama</td><td>foto.palsu</td><td>25 Apr 2026</td><td><span class="badge orange">Peringatan</span></td></tr>
                        <tr><td>#RPT-097</td><td>Spam iklan duplikat</td><td>pembeli.aktif</td><td>spammer.bdl</td><td>20 Apr 2026</td><td><span class="badge red">Barang Diturunkan</span></td></tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

<div class="toast" id="toast"></div>
<script src="<?= SECONDIFY; ?>/assets/js/admin/adminDashboard.js"></script>
</body>
</html>
