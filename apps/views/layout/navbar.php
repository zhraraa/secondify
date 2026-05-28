<?php
/** @var array $dataUser */


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../../koneksi/koneksi.php';

?>


<!-- NAVBAR -->
<nav class="navbar">
    
    <a href="<?= SECONDIFY; ?>/apps/controllers/user/dashboardController.php" class="sidebar-logo" style="text-decoration: none;">
        <img src="<?= SECONDIFY; ?>/assets/images/logo/logo.png" alt="" class="logo">
    </a>

    <div class="search-box">
        <input type="text" placeholder="Mau cari barang apa hari ini?" id="searchInput">
    </div>

    <div class="nav-right">
        <!-- Wishlist -->
        <a href="<?= SECONDIFY ?>/apps/views/user/favorit.php" class="nav-icon-btn" title="Wishlist" style="text-decoration: none; color: inherit;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
        </a>

        <!-- Notification -->
        <a href="<?= SECONDIFY ?>/apps/views/user/chat.php" class="nav-icon-btn" title="Notifikasi" style="text-decoration: none; color: inherit;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
        </a>

        <!-- Chat -->
        <a href="<?= SECONDIFY ?>/apps/views/user/chat.php" class="msgButton" style="text-decoration: none; color: inherit;">
            <i data-lucide="message-square" class="chatIcon"></i>    
        </a>

        <div class="nav-divider"></div>

        <a href="<?= SECONDIFY ?>/apps/controllers/user/profileController.php" class="user" title="Profil">
            <div class="avatar">
                <?php 
                    // Tampilkan inisial huruf pertama nama lengkap
                    $inisial = "U";
                    if (isset($row['nama_lengkap'])) {
                        $inisial = strtoupper(substr($row['nama_lengkap'], 0, 1));
                    } elseif (isset($_SESSION['nama_lengkap'])) {
                        $inisial = strtoupper(substr($_SESSION['nama_lengkap'], 0, 1));
                    }
                    echo $inisial;
                ?>
            </div>
            <div class="user-info">
                <span class="user-name">
                    <?php if($dataUser['is_penjual'] == 1):?>
                        <span class="user-name">
                            <?= $dataUser['nama_toko'] ?>
                        </span>
                    <?php else: ?>
                        <span class="user-name">
                            <?= $dataUser['nama_lengkap'] ?>
                        </span>
                    <?php endif; ?>
                </span>
                <?php 
                if(isset($dataUser['is_penjual']) && $dataUser['is_penjual'] == 1){
                    echo "<span class=\"user-role\">Penjual</span>";
                } else {
                    echo "<span class=\"user-role\">Member</span>";
                }
                ?>
            </div>
        </a>

        <a href="<?= SECONDIFY ?>/apps/controllers/auth/logout.php" class="logout-btn" title="Keluar" style="text-decoration: none; color: inherit;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Keluar
        </a>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
</nav>
