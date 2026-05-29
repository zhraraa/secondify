<?php
require_once '../../config/config.php';
// Panggil file controller barunya di sini, bre
require_once '../../controllers/admin/SellerVerificationController.php';

// Ambil array data matang dari controller
$verifData = getVerificationData();
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
            <span class="badge orange" style="font-size:13px;padding:6px 14px;"><?= $verifData['count_menunggu']; ?> Menunggu Review</span>
        </div>

        <div class="tab-nav" id="verif-tabs">
            <button class="tab-btn active" onclick="switchVerifTab(this,'menunggu')">Menunggu (<?= $verifData['count_menunggu']; ?>)</button>
            <button class="tab-btn" onclick="switchVerifTab(this,'disetujui')">Disetujui (<?= $verifData['count_disetujui']; ?>)</button>
            <button class="tab-btn" onclick="switchVerifTab(this,'ditolak')">Ditolak (<?= $verifData['count_ditolak']; ?>)</button>
        </div>

        <div id="verif-menunggu">
            <div class="card mb-20">
                <div class="card-head">
                    <div><h3>Pengajuan Menunggu Review</h3><p>Klik "Review" untuk melihat detail berkas pengajuan toko</p></div>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Pemohon</th><th>Nama Toko</th><th>Tanggal Daftar</th>
                            <th>Catatan User</th><th>Status</th><th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($verifData['menunggu'])): ?>
                            <?php foreach ($verifData['menunggu'] as $row): ?>
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <div class="user-avatar-sm" style="background: linear-gradient(135deg, #886BC6, #a892e3);">
                                                <?= strtoupper(substr($row['nama_lengkap'], 0, 1)); ?>
                                            </div>
                                            <div>
                                                <div class="user-name-sm"><?= htmlspecialchars($row['nama_lengkap']); ?></div>
                                                <div class="user-email-sm"><?= htmlspecialchars($row['email']); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><strong><?= htmlspecialchars($row['nama_toko']); ?></strong></td>
                                    <td><?= $row['tgl_format']; ?></td>
                                    <td><span style="font-size: 13px; color:#555;"><?= htmlspecialchars($row['catatan']); ?></span></td>
                                    <td><span class="badge orange"><span class="badge-dot"></span>Menunggu</span></td>
                                    <td>
                                        <button class="btn-action view" onclick="openVerifModal('<?= addslashes($row['nama_lengkap']); ?>','<?= addslashes($row['email']); ?>','<?= addslashes($row['nama_toko']); ?>','<?= addslashes($row['catatan']); ?>','<?= $row['tgl_format']; ?>','<?= $row['foto_data_diri']; ?>', '<?= $row['id_pengajuan']; ?>')">Review</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6" style="text-align:center;color:#888;padding:20px;">Tidak ada pengajuan toko baru yang pending.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="verif-disetujui" style="display:none;">
            <div class="card mb-20">
                <div class="card-head"><div><h3>Penjual Terverifikasi</h3><p><?= $verifData['count_disetujui']; ?> penjual aktif di Secondify</p></div></div>
                <table class="data-table">
                    <thead><tr><th>Penjual</th><th>Nama Toko</th><th>Disetujui Pada</th><th>Username</th><th>Status</th></tr></thead>
                    <tbody>
                        <?php if (!empty($verifData['disetujui'])): ?>
                            <?php foreach ($verifData['disetujui'] as $row): ?>
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <div class="user-avatar-sm" style="background:linear-gradient(135deg,#27ae60,#2ecc71);">
                                                <?= strtoupper(substr($row['nama_lengkap'], 0, 1)); ?>
                                            </div>
                                            <div>
                                                <div class="user-name-sm"><?= htmlspecialchars($row['nama_lengkap']); ?></div>
                                                <div class="user-email-sm"><?= htmlspecialchars($row['email']); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><strong><?= htmlspecialchars($row['nama_toko']); ?></strong></td>
                                    <td><?= $row['tgl_format']; ?></td>
                                    <td><span style="color:#886BC6; font-weight:500;">@<?= htmlspecialchars($row['username']); ?></span></td>
                                    <td><span class="badge green"><span class="badge-dot"></span>Aktif</span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" style="text-align:center;color:#888;padding:20px;">Belum ada penjual yang disetujui.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="verif-ditolak" style="display:none;">
            <div class="card mb-20">
                <div class="card-head"><div><h3>Pengajuan Ditolak</h3><p>Daftar berkas pengajuan toko yang tidak memenuhi syarat</p></div></div>
                <table class="data-table">
                    <thead><tr><th>Pemohon</th><th>Nama Toko</th><th>Tanggal Evaluasi</th><th>Alasan Penolakan</th><th>Status</th></tr></thead>
                    <tbody>
                        <?php if (!empty($verifData['ditolak'])): ?>
                            <?php foreach ($verifData['ditolak'] as $row): ?>
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <div class="user-avatar-sm" style="background:#ddd;color:#888;">
                                                <?= strtoupper(substr($row['nama_lengkap'], 0, 1)); ?>
                                            </div>
                                            <div>
                                                <div class="user-name-sm"><?= htmlspecialchars($row['nama_lengkap']); ?></div>
                                                <div class="user-email-sm"><?= htmlspecialchars($row['email']); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($row['nama_toko']); ?></td>
                                    <td><?= $row['tgl_format']; ?></td>
                                    <td style="color:#e74c3c; font-size:13px; font-weight:500;"><?= htmlspecialchars($row['alasan_penolakan']); ?></td>
                                    <td><span class="badge red"><span class="badge-dot"></span>Ditolak</span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" style="text-align:center;color:#888;padding:20px;">Tidak ada riwayat pengajuan yang ditolak.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

<div class="modal-overlay" id="verifModal">
    <div class="modal">
        <div class="modal-head">
            <h3>Review Pengajuan Penjual</h3>
            <button class="modal-close" onclick="closeVerifModal()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="m-id-pengajuan">
            <div class="info-row-modal"><span class="lbl">Nama Pemohon</span><span class="val" id="m-nama">—</span></div>
            <div class="info-row-modal"><span class="lbl">Email</span><span class="val" id="m-email">—</span></div>
            <div class="info-row-modal"><span class="lbl">Nama Toko</span><span class="val" id="m-toko">—</span></div>
            <div class="info-row-modal"><span class="lbl">Catatan User</span><span class="val" id="m-kategori">—</span></div>
            <div class="info-row-modal"><span class="lbl">Tanggal Daftar</span><span class="val" id="m-tgl">—</span></div>
            <div class="section-divider"></div>
            <div style="font-size:12px;font-weight:700;color:#888;margin-bottom:8px;">FOTO KTP / KTM</div>
            <div class="ktp-img" style="display:flex; flex-direction:column; align-items:center; justify-content:center; gap:8px; padding:15px; border:1.5px dashed #ccc; border-radius:8px;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="width:24px;height:24px;color:#888;"><rect x="3" y="5" width="18" height="14" rx="2"/><line x1="7" y1="10" x2="9" y2="10"/><line x1="11" y1="10" x2="17" y2="10"/><line x1="7" y1="14" x2="17" y2="14"/></svg>
                <span id="m-foto-nama" style="font-size:13px; font-weight:600; color:#333;">—</span>
            </div>
            <div class="section-divider"></div>
            <div style="font-size:12px;font-weight:700;color:#888;margin-bottom:8px;">ALASAN PENOLAKAN (WAJIB JIKA DITOLAK)</div>
            <textarea id="m-alasan" placeholder="Tulis alasan jika menolak pengajuan..." style="width:100%;padding:10px;border:1.5px solid #e8e8f0;border-radius:8px;font-size:13px;font-family:'Plus Jakarta Sans',sans-serif;resize:none;height:70px;outline:none;color:#333;"></textarea>
        </div>
        <div class="modal-footer">
            <button class="btn-action reject" onclick="rejectApplicant()">Tolak Pengajuan</button>
            <button class="btn-action approve" onclick="approveApplicant()">Setujui & Verifikasi</button>
        </div>
    </div>
</div>

<div class="toast" id="toast"></div>

<script src="<?= SECONDIFY; ?>/assets/js/admin/SellerVerification.js"></script>
</body>
</html>