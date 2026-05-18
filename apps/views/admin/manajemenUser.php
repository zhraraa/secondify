<?php
require_once '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User — Secondify</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/admin/adminDashboard.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main-wrap">

    <div class="topbar">
        <div>
            <div class="topbar-title">Manajemen User</div>
            <div class="topbar-breadcrumb">Admin / <span>Manajemen User</span></div>
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
                <div class="section-title">Manajemen User</div>
                <div class="section-sub">Kelola akun pembeli dan penjual di platform</div>
            </div>
        </div>

        <div class="card">
            <div class="table-toolbar">
                <div class="search-input-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" placeholder="Cari nama, email, atau username..." id="userSearch" oninput="filterUsers()">
                </div>
                <select class="filter-select" id="roleFilter" onchange="filterUsers()">
                    <option value="">Semua Peran</option>
                    <option value="Pembeli">Pembeli</option>
                    <option value="Penjual">Penjual</option>
                </select>
                <select class="filter-select" id="statusFilter" onchange="filterUsers()">
                    <option value="">Semua Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Dibekukan">Dibekukan</option>
                </select>
                <div style="margin-left:auto;font-size:12px;color:#aaa;" id="user-count">Menampilkan 7 pengguna</div>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Pengguna</th><th>Username</th><th>Peran</th>
                        <th>Bergabung</th><th>Transaksi</th><th>Status</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="userTbody">
                    <tr data-role="Penjual" data-status="Aktif">
                        <td><div class="user-cell"><div class="user-avatar-sm">R</div><div><div class="user-name-sm">Rara Cantik</div><div class="user-email-sm">rara@gmail.com</div></div></div></td>
                        <td>@raracantik123</td><td><span class="badge purple">Penjual</span></td>
                        <td>Jan 2026</td><td>18 transaksi</td>
                        <td><span class="badge green"><span class="badge-dot"></span>Aktif</span></td>
                        <td><div class="action-row"><button class="btn-action view" onclick="showToast('Melihat profil Rara Cantik')">Detail</button><button class="btn-action warn" onclick="showToast('Peringatan dikirim ke Rara Cantik')">Peringatkan</button></div></td>
                    </tr>
                    <tr data-role="Pembeli" data-status="Aktif">
                        <td><div class="user-cell"><div class="user-avatar-sm" style="background:linear-gradient(135deg,#3b82f6,#60a5fa);">A</div><div><div class="user-name-sm">Alyssa Putri</div><div class="user-email-sm">alyssa@gmail.com</div></div></div></td>
                        <td>@alyssa.putri</td><td><span class="badge blue">Pembeli</span></td>
                        <td>Jan 2026</td><td>12 transaksi</td>
                        <td><span class="badge green"><span class="badge-dot"></span>Aktif</span></td>
                        <td><div class="action-row"><button class="btn-action view" onclick="showToast('Melihat profil Alyssa Putri')">Detail</button><button class="btn-action warn" onclick="showToast('Peringatan dikirim ke Alyssa Putri')">Peringatkan</button></div></td>
                    </tr>
                    <tr data-role="Penjual" data-status="Aktif">
                        <td><div class="user-cell"><div class="user-avatar-sm" style="background:linear-gradient(135deg,#27ae60,#2ecc71);">A</div><div><div class="user-name-sm">Andi Wijaya</div><div class="user-email-sm">andi@gmail.com</div></div></div></td>
                        <td>@andi.sneakers</td><td><span class="badge purple">Penjual</span></td>
                        <td>Feb 2026</td><td>34 transaksi</td>
                        <td><span class="badge green"><span class="badge-dot"></span>Aktif</span></td>
                        <td><div class="action-row"><button class="btn-action view" onclick="showToast('Melihat profil Andi Wijaya')">Detail</button><button class="btn-action warn" onclick="showToast('Peringatan dikirim ke Andi Wijaya')">Peringatkan</button></div></td>
                    </tr>
                    <tr data-role="Pembeli" data-status="Dibekukan">
                        <td><div class="user-cell"><div class="user-avatar-sm" style="background:#ccc;color:#888;">D</div><div><div class="user-name-sm">Dodi Santoso</div><div class="user-email-sm">dodi@gmail.com</div></div></div></td>
                        <td>@dodi.s</td><td><span class="badge blue">Pembeli</span></td>
                        <td>Mar 2026</td><td>2 transaksi</td>
                        <td><span class="badge red"><span class="badge-dot"></span>Dibekukan</span></td>
                        <td><div class="action-row"><button class="btn-action view" onclick="showToast('Melihat profil Dodi Santoso')">Detail</button><button class="btn-action approve" onclick="showToast('Akun Dodi Santoso diaktifkan kembali!')">Aktifkan</button></div></td>
                    </tr>
                    <tr data-role="Pembeli" data-status="Aktif">
                        <td><div class="user-cell"><div class="user-avatar-sm" style="background:linear-gradient(135deg,#e74c3c,#ff6b6b);">M</div><div><div class="user-name-sm">Maya Sari</div><div class="user-email-sm">maya@gmail.com</div></div></div></td>
                        <td>@maya.preloved</td><td><span class="badge blue">Pembeli</span></td>
                        <td>Mei 2026</td><td>1 transaksi</td>
                        <td><span class="badge green"><span class="badge-dot"></span>Aktif</span></td>
                        <td><div class="action-row"><button class="btn-action view" onclick="showToast('Melihat profil Maya Sari')">Detail</button><button class="btn-action warn" onclick="showToast('Peringatan dikirim ke Maya Sari')">Peringatkan</button></div></td>
                    </tr>
                    <tr data-role="Penjual" data-status="Aktif">
                        <td><div class="user-cell"><div class="user-avatar-sm" style="background:linear-gradient(135deg,#886BC6,#D3C3FB);">R</div><div><div class="user-name-sm">Rizky Fadillah</div><div class="user-email-sm">rizky@gmail.com</div></div></div></td>
                        <td>@rizky.store</td><td><span class="badge purple">Penjual</span></td>
                        <td>Mar 2026</td><td>22 transaksi</td>
                        <td><span class="badge green"><span class="badge-dot"></span>Aktif</span></td>
                        <td><div class="action-row"><button class="btn-action view" onclick="showToast('Melihat profil Rizky Fadillah')">Detail</button><button class="btn-action danger" onclick="showToast('Akun Rizky Fadillah dibekukan!')">Bekukan</button></div></td>
                    </tr>
                    <tr data-role="Pembeli" data-status="Aktif">
                        <td><div class="user-cell"><div class="user-avatar-sm" style="background:linear-gradient(135deg,#f39c12,#f1c40f);">D</div><div><div class="user-name-sm">Dinda Belanja</div><div class="user-email-sm">dinda@gmail.com</div></div></div></td>
                        <td>@dinda.belanja</td><td><span class="badge blue">Pembeli</span></td>
                        <td>Apr 2026</td><td>7 transaksi</td>
                        <td><span class="badge green"><span class="badge-dot"></span>Aktif</span></td>
                        <td><div class="action-row"><button class="btn-action view" onclick="showToast('Melihat profil Dinda Belanja')">Detail</button><button class="btn-action warn" onclick="showToast('Peringatan dikirim ke Dinda Belanja')">Peringatkan</button></div></td>
                    </tr>
                </tbody>
            </table>

            <div class="pagination">
                <span>Menampilkan 7 dari 1,284 pengguna</span>
                <div class="page-btns">
                    <button class="page-btn">‹</button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">...</button>
                    <button class="page-btn">128</button>
                    <button class="page-btn">›</button>
                </div>
            </div>
        </div>

    </section>
</div>

<div class="toast" id="toast"></div>
<script src="<?= SECONDIFY; ?>/assets/js/admin/adminDashboard.js"></script>
</body>
</html>
