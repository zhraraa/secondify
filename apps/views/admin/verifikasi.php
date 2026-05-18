<?php
require_once '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Penjual — Secondify</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/admin/adminDashboard.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main-wrap">

    <div class="topbar">
        <div>
            <div class="topbar-title">Verifikasi Penjual</div>
            <div class="topbar-breadcrumb">Admin / <span>Verifikasi Penjual</span></div>
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
                <div class="section-title">Verifikasi Penjual</div>
                <div class="section-sub">Review dan setujui pengajuan penjual baru</div>
            </div>
            <span class="badge orange" style="font-size:13px;padding:6px 14px;">3 Menunggu Review</span>
        </div>

        <!-- TABS -->
        <div class="tab-nav" id="verif-tabs">
            <button class="tab-btn active" onclick="switchVerifTab(this,'menunggu')">Menunggu (3)</button>
            <button class="tab-btn" onclick="switchVerifTab(this,'disetujui')">Disetujui (28)</button>
            <button class="tab-btn" onclick="switchVerifTab(this,'ditolak')">Ditolak (4)</button>
        </div>

        <!-- TAB: MENUNGGU -->
        <div id="verif-menunggu">
            <div class="card mb-20">
                <div class="card-head">
                    <div><h3>Pengajuan Menunggu Review</h3><p>Klik "Review" untuk melihat detail KTP dan memutuskan</p></div>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Pemohon</th><th>Nama Toko</th><th>Tanggal Daftar</th>
                            <th>Kategori Barang</th><th>Status</th><th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><div class="user-cell"><div class="user-avatar-sm">F</div><div><div class="user-name-sm">Fatimah Zahra</div><div class="user-email-sm">fatimah@gmail.com</div></div></div></td>
                            <td><strong>Toko Fati Preloved</strong></td>
                            <td>3 Mei 2026</td>
                            <td>Pakaian, Tas</td>
                            <td><span class="badge orange"><span class="badge-dot"></span>Menunggu</span></td>
                            <td><button class="btn-action view" onclick="openVerifModal('Fatimah Zahra','fatimah@gmail.com','Toko Fati Preloved','Pakaian, Tas','3 Mei 2026')">Review</button></td>
                        </tr>
                        <tr>
                            <td><div class="user-cell"><div class="user-avatar-sm" style="background:linear-gradient(135deg,#27ae60,#2ecc71);">B</div><div><div class="user-name-sm">Bagas Pratama</div><div class="user-email-sm">bagas@gmail.com</div></div></div></td>
                            <td><strong>Bagas Tech Store</strong></td>
                            <td>2 Mei 2026</td>
                            <td>Elektronik, Handphone</td>
                            <td><span class="badge orange"><span class="badge-dot"></span>Menunggu</span></td>
                            <td><button class="btn-action view" onclick="openVerifModal('Bagas Pratama','bagas@gmail.com','Bagas Tech Store','Elektronik, Handphone','2 Mei 2026')">Review</button></td>
                        </tr>
                        <tr>
                            <td><div class="user-cell"><div class="user-avatar-sm" style="background:linear-gradient(135deg,#e67e22,#f39c12);">N</div><div><div class="user-name-sm">Nadia Cantika</div><div class="user-email-sm">nadia@gmail.com</div></div></div></td>
                            <td><strong>Nadia's Wardrobe</strong></td>
                            <td>1 Mei 2026</td>
                            <td>Pakaian, Aksesoris</td>
                            <td><span class="badge orange"><span class="badge-dot"></span>Menunggu</span></td>
                            <td><button class="btn-action view" onclick="openVerifModal('Nadia Cantika','nadia@gmail.com','Nadia\'s Wardrobe','Pakaian, Aksesoris','1 Mei 2026')">Review</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB: DISETUJUI -->
        <div id="verif-disetujui" style="display:none;">
            <div class="card mb-20">
                <div class="card-head"><div><h3>Penjual Terverifikasi</h3><p>28 penjual aktif di Secondify</p></div></div>
                <table class="data-table">
                    <thead><tr><th>Penjual</th><th>Nama Toko</th><th>Disetujui</th><th>Total Barang</th><th>Rating</th><th>Status</th></tr></thead>
                    <tbody>
                        <tr>
                            <td><div class="user-cell"><div class="user-avatar-sm">R</div><div><div class="user-name-sm">Rara Cantik</div><div class="user-email-sm">@raracantik123</div></div></div></td>
                            <td><strong>Toko Rara</strong></td><td>Jan 2026</td><td>12 barang</td><td>⭐ 4.8</td>
                            <td><span class="badge green"><span class="badge-dot"></span>Aktif</span></td>
                        </tr>
                        <tr>
                            <td><div class="user-cell"><div class="user-avatar-sm" style="background:linear-gradient(135deg,#3b82f6,#60a5fa);">R</div><div><div class="user-name-sm">Rizky Fadillah</div><div class="user-email-sm">@rizky.store</div></div></div></td>
                            <td><strong>Toko Rizky</strong></td><td>Mar 2026</td><td>8 barang</td><td>⭐ 4.9</td>
                            <td><span class="badge green"><span class="badge-dot"></span>Aktif</span></td>
                        </tr>
                        <tr>
                            <td><div class="user-cell"><div class="user-avatar-sm" style="background:linear-gradient(135deg,#27ae60,#2ecc71);">A</div><div><div class="user-name-sm">Andi Wijaya</div><div class="user-email-sm">@andi.sneakers</div></div></div></td>
                            <td><strong>Sneakers Andi</strong></td><td>Feb 2026</td><td>24 barang</td><td>⭐ 4.7</td>
                            <td><span class="badge green"><span class="badge-dot"></span>Aktif</span></td>
                        </tr>
                    </tbody>
                </table>
                <div class="pagination">
                    <span>Menampilkan 3 dari 28 penjual</span>
                    <div class="page-btns">
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">›</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB: DITOLAK -->
        <div id="verif-ditolak" style="display:none;">
            <div class="card mb-20">
                <div class="card-head"><div><h3>Pengajuan Ditolak</h3><p>4 pengajuan tidak memenuhi syarat</p></div></div>
                <table class="data-table">
                    <thead><tr><th>Pemohon</th><th>Nama Toko</th><th>Tanggal</th><th>Alasan Penolakan</th><th>Status</th></tr></thead>
                    <tbody>
                        <tr>
                            <td><div class="user-cell"><div class="user-avatar-sm" style="background:#ddd;color:#888;">D</div><div><div class="user-name-sm">Dodi Santoso</div><div class="user-email-sm">dodi@gmail.com</div></div></div></td>
                            <td>Toko Dodi</td><td>15 Apr 2026</td><td>KTP tidak terbaca / blur</td>
                            <td><span class="badge red"><span class="badge-dot"></span>Ditolak</span></td>
                        </tr>
                        <tr>
                            <td><div class="user-cell"><div class="user-avatar-sm" style="background:#ddd;color:#888;">S</div><div><div class="user-name-sm">Sinta Dewi</div><div class="user-email-sm">sinta@gmail.com</div></div></div></td>
                            <td>Sinta Shop</td><td>10 Apr 2026</td><td>Data tidak sesuai / mencurigakan</td>
                            <td><span class="badge red"><span class="badge-dot"></span>Ditolak</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

<!-- MODAL VERIFIKASI -->
<div class="modal-overlay" id="verifModal">
    <div class="modal">
        <div class="modal-head">
            <h3>Review Pengajuan Penjual</h3>
            <button class="modal-close" onclick="closeVerifModal()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="modal-body">
            <div class="info-row-modal"><span class="lbl">Nama Pemohon</span><span class="val" id="m-nama">—</span></div>
            <div class="info-row-modal"><span class="lbl">Email</span><span class="val" id="m-email">—</span></div>
            <div class="info-row-modal"><span class="lbl">Nama Toko</span><span class="val" id="m-toko">—</span></div>
            <div class="info-row-modal"><span class="lbl">Kategori Barang</span><span class="val" id="m-kategori">—</span></div>
            <div class="info-row-modal"><span class="lbl">Tanggal Daftar</span><span class="val" id="m-tgl">—</span></div>
            <div class="section-divider"></div>
            <div style="font-size:12px;font-weight:700;color:#888;margin-bottom:8px;">FOTO KTP / KTM</div>
            <div class="ktp-img" style="display:flex;align-items:center;justify-content:center;gap:8px;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="width:24px;height:24px;"><rect x="3" y="5" width="18" height="14" rx="2"/><line x1="7" y1="10" x2="9" y2="10"/><line x1="11" y1="10" x2="17" y2="10"/><line x1="7" y1="14" x2="17" y2="14"/></svg>
                <span style="font-size:13px;">Preview KTP tersedia di sistem</span>
            </div>
            <div class="section-divider"></div>
            <div style="font-size:12px;font-weight:700;color:#888;margin-bottom:8px;">CATATAN ADMIN</div>
            <textarea placeholder="Tulis catatan untuk keputusan ini (opsional)..." style="width:100%;padding:10px;border:1.5px solid #e8e8f0;border-radius:8px;font-size:13px;font-family:'Plus Jakarta Sans',sans-serif;resize:none;height:70px;outline:none;color:#333;"></textarea>
        </div>
        <div class="modal-footer">
            <button class="btn-action reject" onclick="rejectApplicant()">Tolak Pengajuan</button>
            <button class="btn-action approve" onclick="approveApplicant()">Setujui & Verifikasi</button>
        </div>
    </div>
</div>

<div class="toast" id="toast"></div>
<script src="<?= SECONDIFY; ?>/assets/js/admin/adminDashboard.js"></script>
</body>
</html>
