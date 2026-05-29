<?php
session_start();
require_once '../../config/config.php';
require_once '../../controllers/admin/moderasiController.php';

$laporanMasuk      = getLaporanByStatus('menunggu');
$laporanSelesai    = getLaporanByStatus('selesai');
$totalLaporanAktif = count($laporanMasuk);

// Ambil flash message dari session (hasil redirect controller)
$flashMsg = $_SESSION['flash'] ?? '';
unset($_SESSION['flash']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderasi & Laporan — Secondify</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/admin/adminDashboard.css">
    <style>
        .tab-content { display: none; }
        .tab-content.active { display: block; }
    </style>
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
                <?php if($totalLaporanAktif > 0): ?><div class="notif-dot"></div><?php endif; ?>
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
            <span class="badge red" style="font-size:13px;padding:6px 14px;"><?= $totalLaporanAktif; ?> Laporan Aktif</span>
        </div>

        <div class="tab-nav" id="mod-tabs">
            <button class="tab-btn active" onclick="switchModTab(this, 'laporan')">Laporan Masuk (<?= $totalLaporanAktif; ?>)</button>
            <button class="tab-btn" onclick="switchModTab(this, 'mod-selesai')">Selesai (<?= count($laporanSelesai); ?>)</button>
        </div>

        <div id="mod-laporan">
            <?php if(!empty($laporanMasuk)): ?>
                <?php foreach($laporanMasuk as $l):
                    $isBarang  = ($l['tipe_laporan'] === 'barang');
                    $typeBadge = $isBarang ? 'red' : 'orange';
                    $typeName  = $isBarang ? 'Laporan Pelanggaran Produk' : 'Tiket CS / Bantuan';
                ?>
                    <div class="report-card" id="card-report-<?= $l['id_utama']; ?>">
                        <div class="report-head">
                            <div>
                                <div class="report-id">#ID-<?= str_pad($l['id_utama'], 3, '0', STR_PAD_LEFT); ?> · <?= date('d M Y, H:i', strtotime($l['tanggal'])); ?></div>
                                <div class="report-title"><?= $typeName; ?></div>
                                <div class="report-meta">Dilaporkan oleh: <strong><?= htmlspecialchars($l['nama_pelapor']); ?></strong>
                                    <?php if($isBarang): ?>
                                        · Terlapor (Penjual): <strong style="color:#e74c3c;"><?= htmlspecialchars($l['nama_terlapor']); ?></strong>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <span class="badge <?= $typeBadge; ?>"><span class="badge-dot"></span>Baru</span>
                        </div>

                        <div class="report-body" style="background:#fdfdfd; padding:15px; border-radius:8px; border-left:4px solid <?= $isBarang ? '#e74c3c' : '#3498db'; ?>; margin:15px 0;">
                            <?= htmlspecialchars($l['deskripsi']); ?>
                        </div>

                        <div class="action-row">
                            <?php if($isBarang): ?>
                                <button class="btn-action danger" onclick="bukaModalBarang(<?= $l['id_utama']; ?>, '<?= addslashes(htmlspecialchars($l['deskripsi'])); ?>')">Tindak Lanjuti</button>
                            <?php else: ?>
                                <button class="btn-action approve" onclick="bukaModalBalas(<?= $l['id_utama']; ?>, '<?= addslashes(htmlspecialchars($l['deskripsi'])); ?>')">Balas Tiket</button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="card" style="text-align:center; padding:40px; color:#aaa;">Belum ada laporan atau bantuan baru yang masuk.</div>
            <?php endif; ?>
        </div>

        <div id="mod-selesai" class="tab-content">
            <div class="card">
                <div class="card-head">
                    <div>
                        <h3>Laporan Ditangani</h3>
                        <p><?= count($laporanSelesai); ?> laporan telah selesai diproses oleh admin</p>
                    </div>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID Laporan</th><th>Alasan Aduan</th><th>Pelapor</th>
                            <th>Terlapor</th><th>Tanggal Selesai</th><th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($laporanSelesai)): ?>
                            <?php foreach($laporanSelesai as $ls):
                                $isBarang = ($ls['tipe_laporan'] === 'barang');
                                $prefix   = $isBarang ? 'RPT' : 'CS';
                            ?>
                                <tr>
                                    <td>#<?= $prefix; ?>-<?= str_pad($ls['id_utama'], 3, '0', STR_PAD_LEFT); ?></td>
                                    <td><?= htmlspecialchars($ls['deskripsi']); ?></td>
                                    <td><?= htmlspecialchars($ls['nama_pelapor']); ?></td>
                                    <td>
                                        <?php if($isBarang): ?>
                                            <strong style="color:#e74c3c;"><?= htmlspecialchars($ls['nama_terlapor']); ?></strong>
                                        <?php else: ?>
                                            <span style="color:#aaa; font-style:italic;"><?= htmlspecialchars($ls['nama_terlapor']); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d M Y', strtotime($ls['tanggal'])); ?></td>
                                    <td>
                                        <?php if($isBarang): ?>
                                            <span class="badge red">Ditindak</span>
                                        <?php else: ?>
                                            <span class="badge green">Tiket Selesai</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6" style="text-align:center;color:#aaa;padding:20px;">Belum ada riwayat penanganan laporan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

<div class="toast" id="toast"></div>

<!-- Modal: Balas Tiket Bantuan (form POST biasa) -->
<div id="modalBalas" class="modal-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999; align-items:center; justify-content:center;">
    <div class="modal-content" style="background:#fff; padding:25px; border-radius:12px; width:450px; box-shadow:0 5px 15px rgba(0,0,0,0.2);">
        <h3 style="margin-top:0; color:#333;">Balas Tiket Bantuan</h3>
        <p style="font-size:13px; color:#666;" id="textKeluhanUser"></p>

        <form method="POST" action="../../controllers/admin/moderasiController.php">
            <input type="hidden" name="id_utama" id="inputIdBantuan">
            <input type="hidden" name="tipe_laporan" value="bantuan">
            <div style="margin:15px 0;">
                <label style="display:block; font-size:13px; font-weight:600; margin-bottom:5px; color:#555;">Tulis Solusi / Balasan Admin:</label>
                <textarea name="balasan_admin" rows="4" required style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; font-family:inherit; resize:none; box-sizing:border-box;" placeholder="Ketik jawaban atau solusi di sini..."></textarea>
            </div>
            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <button type="button" class="btn-action" style="background:#eee; color:#333;" onclick="tutupModalBalas()">Batal</button>
                <button type="submit" class="btn-action approve" style="background:#3498db; color:#fff;">Kirim & Selesaikan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Tindak Lanjuti Laporan Barang (form POST biasa) -->
<div id="modalAksiBarang" class="modal-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999; align-items:center; justify-content:center;">
    <div class="modal-content" style="background:#fff; padding:25px; border-radius:12px; width:450px; box-shadow:0 5px 15px rgba(0,0,0,0.2);">
        <h3 style="margin-top:0; color:#333;">Tindak Lanjuti Laporan</h3>
        <p style="font-size:13px; color:#666;" id="textDetailBarang"></p>

        <form method="POST" action="../../controllers/admin/moderasiController.php">
            <input type="hidden" name="id_utama" id="inputIdBarang">
            <input type="hidden" name="tipe_laporan" value="barang">

            <div style="margin:15px 0;">
                <label style="display:block; font-size:13px; font-weight:600; margin-bottom:8px; color:#555;">Pilih Tindakan Admin:</label>
                <div style="display:flex; flex-direction:column; gap:10px;">
                    <label style="display:flex; align-items:center; gap:10px; padding:10px; border:1px solid #eee; border-radius:6px; cursor:pointer;">
                        <input type="radio" name="jenis_tindakan" value="turunkan" checked>
                        <div>
                            <strong style="font-size:13px; color:#e67e22;">Turunkan Barang</strong>
                            <div style="font-size:11px; color:#777;">Tandai produk sebagai sold/tidak tersedia.</div>
                        </div>
                    </label>
                    <label style="display:flex; align-items:center; gap:10px; padding:10px; border:1px solid #eee; border-radius:6px; cursor:pointer;">
                        <input type="radio" name="jenis_tindakan" value="peringatan">
                        <div>
                            <strong style="font-size:13px; color:#3498db;">Beri Peringatan</strong>
                            <div style="font-size:11px; color:#777;">Selesaikan laporan tanpa sanksi berat ke penjual.</div>
                        </div>
                    </label>
                    <label style="display:flex; align-items:center; gap:10px; padding:10px; border:1px solid #eee; border-radius:6px; cursor:pointer;">
                        <input type="radio" name="jenis_tindakan" value="bekukan">
                        <div>
                            <strong style="font-size:13px; color:#e74c3c;">Bekukan Akun Penjual</strong>
                            <div style="font-size:11px; color:#777;">Nonaktifkan akun penjual (is_active = 0).</div>
                        </div>
                    </label>
                </div>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:20px;">
                <button type="button" class="btn-action" style="background:#eee; color:#333;" onclick="tutupModalBarang()">Batal</button>
                <button type="submit" class="btn-action danger" style="background:#e74c3c; color:#fff;">Eksekusi Tindakan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Passing flash message dari PHP ke JS
    const flashMsg = <?= json_encode($flashMsg); ?>;
</script>
<script src="<?= SECONDIFY; ?>/assets/js/admin/moderasi.js"></script>
</body>
</html>