<?php
/** @var array $dataUser */


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../../koneksi/koneksi.php';
require_once __DIR__ . '/../../models/userModel.php';

$loggedInUserId = $_SESSION['id_user'] ?? null;
$navUser = null;
if ($loggedInUserId) {
    $navUser = getDataUSer($conn, $loggedInUserId);
}
?>


<!-- NAVBAR -->
<nav class="navbar">
    
    <a href="<?= SECONDIFY; ?>/apps/controllers/user/dashboardController.php" class="sidebar-logo" style="text-decoration: none;">
        <img src="<?= SECONDIFY; ?>/assets/images/logo/logo.png" alt="" class="logo">
    </a>

    <div class="search-box">
        <input type="text" placeholder="Mau cari barang apa hari ini?" id="searchInput" value="<?= htmlspecialchars($_GET['q'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="nav-right">
        <!-- Wishlist -->
        <a href="<?= SECONDIFY ?>/apps/views/user/favorit.php" class="nav-icon-btn" title="Wishlist" style="text-decoration: none; color: inherit;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
        </a>

        <!-- Chat -->
        <a href="<?= SECONDIFY ?>/apps/views/user/chat.php" class="msgButton" style="text-decoration: none; color: inherit;">
            <i data-lucide="message-square" class="chatIcon"></i>    
        </a>

        <?php if ($penjual): ?>
        <a href="<?= SECONDIFY ?>/apps/controllers/penjual/jualBarangController.php" class="navbar-btnTambah">
                <i data-lucide="plus" class="icon"></i>
                Tambah Barang
        </a>
        <?php endif; ?>
        <div class="nav-divider"></div>

        <a href="<?= SECONDIFY ?>/apps/controllers/user/profileController.php" class="user" title="Profil">
            <div class="avatar" style="padding: 0; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                <?php 
                    $profilePict = $navUser['profile_pict'] ?? '';
                    if (!empty($profilePict) && $profilePict !== 'default.png'): 
                ?>
                    <img src="<?= SECONDIFY; ?>/assets/images/<?= htmlspecialchars($profilePict) ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="avatar">
                <?php else: ?>
                    <?php 
                        $inisial = "U";
                        if (!empty($navUser['nama_lengkap'])) {
                            $inisial = strtoupper(substr($navUser['nama_lengkap'], 0, 1));
                        }
                        echo $inisial;
                    ?>
                <?php endif; ?>
            </div>
            <div class="user-info">
                <span class="user-name">
                    <?php if(isset($navUser['is_penjual']) && $navUser['is_penjual'] == 1):?>
                        <?= htmlspecialchars($navUser['nama_toko']) ?>
                    <?php else: ?>
                        <?= htmlspecialchars($navUser['nama_lengkap'] ?? '') ?>
                    <?php endif; ?>
                </span>
                <?php 
                if(isset($navUser['is_penjual']) && $navUser['is_penjual'] == 1){
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

<script>const SECONDIFY = "<?= SECONDIFY; ?>" </script>
<script src="<?= SECONDIFY; ?>/assets/js/auto-logout.js"></script>