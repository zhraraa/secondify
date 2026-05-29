<?php
// sidebar.php
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

// Pastikan koneksi ke database sudah tersedia
// Karena sidebar ini di-include ke dalam file view admin, kita buat fallback aman untuk $conn
if (isset($conn)) {
    // Hitung jumlah pengajuan penjual yang statusnya masih 'pending'
    $queryPendingSeller = mysqli_query($conn, "SELECT COUNT(*) as total FROM seller_application WHERE status = 'pending'");
    $rowPendingSeller = mysqli_fetch_assoc($queryPendingSeller);
    $totalPendingSeller = $rowPendingSeller['total'];

    // Hitung juga jumlah laporan moderasi barang yang aktif (untuk menu Moderasi & Laporan)
    // Di sini kita set default 5 dulu atau disesuaikan dengan query tabel laporan lu nanti
    // FIX: hitung laporan_barang pending + bantuan yang belum selesai
    $queryPendingReport = mysqli_query($conn, "
        SELECT (
            (SELECT COUNT(*) FROM laporan_barang WHERE status = 'pending') +
            (SELECT COUNT(*) FROM bantuan WHERE status != 'selesai')
        ) AS total
    ");
    $totalPendingReport = $queryPendingReport ? (int)mysqli_fetch_assoc($queryPendingReport)['total'] : 0;
} else {
    // Fallback jika variabel $conn belum terdefinisi agar tidak memicu error
    $totalPendingSeller = 3;
    $totalPendingReport = 0; // fallback jika $conn belum tersedia
}
?>

<aside class="sidebar">
    <a href="<?= SECONDIFY; ?>/apps/views/admin/adminDashboard.php" class="sidebar-brand">
        <div class="brand-icon">
            <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1=\"3\" y1=\"6\" x2=\"21\" y2=\"6\"/><path d=\"M16 10a4 4 0 0 1-8 0\"/></svg>
        </div>
        <div>
            <div class="brand-text">Secondify</div>
        </div>
        <span class="brand-badge">ADMIN</span>
    </a>

    <div class="sidebar-label">Menu Utama</div>

    <nav class="sidebar-nav">
        <a href="<?= SECONDIFY; ?>/apps/views/admin/adminDashboard.php"
           class="nav-item <?= $currentPage === 'adminDashboard' ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <rect x="3" y="3" width="7" height="7" rx="1.5"/>
                <rect x="14" y="3" width="7" height="7" rx="1.5"/>
                <rect x="3" y="14" width="7" height="7" rx="1.5"/>
                <rect x="14" y="14" width="7" height="7" rx="1.5"/>
            </svg>
            Dashboard
        </a>

        <a href="<?= SECONDIFY; ?>/apps/views/admin/verifikasi.php"
           class="nav-item <?= $currentPage === 'verifikasi' ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M9 12l2 2 4-4"/>
                <path d="M20.618 5.984A11.955 11.955 0 0 1 12 2.944a11.955 11.955 0 0 1-8.618 3.04A12.02 12.02 0 0 0 3 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9a12.02 12.02 0 0 0-.382-3.016z"/>
            </svg>
            Verifikasi Penjual
            <?php if ($totalPendingSeller > 0): ?>
                <span class="badge-count"><?= $totalPendingSeller; ?></span>
            <?php endif; ?>
        </a>

        <a href="<?= SECONDIFY; ?>/apps/views/admin/manajemenUser.php"
           class="nav-item <?= $currentPage === 'manajemenUser' ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
            Manajemen User
        </a>

        <a href="<?= SECONDIFY; ?>/apps/views/admin/moderasi.php"
           class="nav-item <?= $currentPage === 'moderasi' ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            </svg>
            Moderasi & Laporan
            <?php if ($totalPendingReport > 0): ?>
                <span class="badge-count"><?= $totalPendingReport; ?></span>
            <?php endif; ?>
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-avatar">Y</div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">Yusuf</div>
                <div class="sidebar-user-role">Super Admin</div>
            </div>
        </div>
        <a href="../../controllers/auth/logout.php" class="sidebar-logout">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Log-Out
        </a>
    </div>
</aside>