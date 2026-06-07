<?php
require_once '../../config/config.php';
require_once '../../controllers/admin/dashboardController.php';
$pageTitle = 'Dashboard Admin';


// Jalankan fungsi logic backend-nya buat dapet data
$stats = getDashboardStats($conn); 
$pageTitle = 'Dashboard Admin';

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — Secondify</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/style.css">
</head>
<body class="adminPage">

<?php include 'sidebar.php'; ?>

<div class="main-wrap">

    <!-- TOPBAR -->
    <div class="topbar">
        <div>
            <div class="topbar-title">Dashboard Admin</div>
            <div class="topbar-breadcrumb">Admin / <span>Dashboard</span></div>
        </div>

    </div>

    <!-- KONTEN -->
    <section class="page-content">

        <div class="section-header">
            <div>
                <div class="section-title">Selamat datang, Yusuf 👋</div>
                <div class="section-sub">Berikut ringkasan aktivitas Secondify hari ini.</div>
            </div>

        </div>

        <!-- STAT CARDS -->
        <div class="stats-grid">
            <div class="stat-card purple">
                <div class="stat-icon purple">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="stat-value"><?= number_format($stats['totalUser']); ?></div>
                <div class="stat-label">Total Pengguna</div>
                <!-- <div class="stat-trend up">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                    +12% dari bulan lalu
                </div> -->

            </div>

            <div class="stat-card green">
                <div class="stat-icon green">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                </div>
                <div class="stat-value"><?= number_format($stats['totalBarang']); ?></div>
                <div class="stat-label">Barang Aktif</div>                
                <!-- <div class="stat-trend up">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                    +8% dari bulan lalu
                </div> -->
            </div>

            <div class="stat-card orange">
                <div class="stat-icon orange">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 12l2 2 4-4"/><path d="M20.618 5.984A11.955 11.955 0 0 1 12 2.944a11.955 11.955 0 0 1-8.618 3.04A12.02 12.02 0 0 0 3 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9a12.02 12.02 0 0 0-.382-3.016z"/></svg>
                </div>
                <div class="stat-value"><?= number_format($stats['totalPendingSeller']); ?></div>
                <div class="stat-label">Pengajuan Penjual</div>
                <!-- <div class="stat-trend down">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/><polyline points="17 18 23 18 23 12"/></svg>
                    Menunggu review
                </div> -->
            </div>

            <div class="stat-card red">
                <div class="stat-icon red">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <div class="stat-value"><?= number_format($stats['totalPendingLaporan']); ?></div>
                <div class="stat-label">Laporan Aktif</div>
                <!-- <div class="stat-trend down">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/><polyline points="17 18 23 18 23 12"/></svg>
                    Perlu ditangani
                </div> -->
            </div>
        </div>
        <!-- STAT CARD end disini -->

        <!-- CHARTS ROW -->
       <div class="charts-row">
        <!-- disini data user -->
            <div class="card">
                <div class="card-head">
                    <div>
                        <h3>Distribusi Pengguna</h3>
                        <p>Berdasarkan peran akun</p>
                    </div>
                </div>
                <div class="chart-wrap">
                    <div class="donut">
                        <svg width="120" height="120" viewBox="0 0 120 120" style="transform: rotate(-90deg); filter: drop-shadow(0px 4px 8px rgba(0,0,0,0.05));">
                            <circle cx="60" cy="60" r="46" fill="none" stroke="#f0f0f5" stroke-width="16"/>
                            
                            <circle cx="60" cy="60" r="46" fill="none" stroke="#886BC6" stroke-width="16" 
                                    stroke-dasharray="<?= $stats['donut']['strokePembeli']; ?> <?= $stats['donut']['kelilingTotal'] - $stats['donut']['strokePembeli']; ?>" 
                                    stroke-dashoffset="0"
                                    style="transition: stroke-dasharray 0.5s ease;"/>
                            
                            <circle cx="60" cy="60" r="46" fill="none" stroke="#D3C3FB" stroke-width="16" 
                                    stroke-dasharray="<?= $stats['donut']['strokePenjual']; ?> <?= $stats['donut']['kelilingTotal'] - $stats['donut']['strokePenjual']; ?>" 
                                    stroke-dashoffset="<?= $stats['donut']['offsetPenjual']; ?>"
                                    style="transition: stroke-dasharray 0.5s ease, stroke-dashoffset 0.5s ease;"/>
                                    
                            <?php if ($stats['donut']['strokeLainnya'] > 0): ?>
                            <circle cx="60" cy="60" r="46" fill="none" stroke="#e2e8f0" stroke-width="16" 
                                    stroke-dasharray="<?= $stats['donut']['strokeLainnya']; ?> <?= $stats['donut']['kelilingTotal'] - $stats['donut']['strokeLainnya']; ?>" 
                                    stroke-dashoffset="<?= $stats['donut']['offsetLainnya']; ?>"
                                    style="transition: stroke-dasharray 0.5s ease, stroke-dashoffset 0.5s ease;"/>
                            <?php endif; ?>
                        </svg>
                        
                        <div class="donut-center">
                            <div class="donut-val"><?= number_format($stats['totalUser']); ?></div>
                            <div class="donut-lbl">Total</div>
                        </div>
                    </div>
                    
                    <div class="legend">
                        <div class="legend-item">
                            <div class="legend-dot" style="background:#886BC6"></div>
                            <span class="legend-label">Pembeli</span>
                            <span class="legend-val"><?= number_format($stats['totalPembeli']); ?></span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-dot" style="background:#D3C3FB"></div>
                            <span class="legend-label">Penjual</span>
                            <span class="legend-val"><?= number_format($stats['totalPenjual']); ?></span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-dot" style="background:#e2e8f0"></div>
                            <span class="legend-label">Lainnya/Admin</span>
                            <span class="legend-val"><?= number_format($stats['totalLainnya']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <!--disini barang per kategori-->
            <div class="card">
                <div class="card-head">
                    <div>
                        <h3>Barang per Kategori</h3>
                        <p>Top 5 kategori terpopuler</p>
                    </div>
                </div>
                <div class="bar-chart">
                    <?php 
                    if (!empty($stats['kategori_terpopuler'])) {
                        $colors = [
                            'linear-gradient(to right,#886BC6,#D3C3FB)',
                            'linear-gradient(to right,#27ae60,#2ecc71)',
                            'linear-gradient(to right,#3b82f6,#60a5fa)',
                            'linear-gradient(to right,#e67e22,#f39c12)',
                            'linear-gradient(to right,#e74c3c,#ff6b6b)'
                        ];

                        foreach ($stats['kategori_terpopuler'] as $index => $kat) {
                            $barColor = $colors[$index] ?? 'linear-gradient(to right,#886BC6,#D3C3FB)';
                    ?>
                            <div class="bar-group">
                                <div class="bar-head">
                                    <span><?= htmlspecialchars($kat['nama_kategori']); ?></span>
                                    <span><?= number_format($kat['jumlah']); ?> barang</span>
                                </div>
                                <div class="bar-track">
                                    <div class="bar-fill" style="width: <?= $kat['persen_bar']; ?>%; background: <?= $barColor; ?>;"></div>
                                </div>
                            </div>
                    <?php 
                        }
                    } else {
                        echo "<p style='padding: 20px; text-align: center; color: #888;'>Tidak ada data kategori barang.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="toast" id="toast"></div>
<script src="<?= SECONDIFY; ?>/assets/js/admin/adminDashboard.js"></script>
</body>
</html>