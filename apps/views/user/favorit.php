<?php
require_once '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Favorit — Secondify</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/user/favorit.css">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">
    <a href="<?= SECONDIFY; ?>/apps/views/user/dashboard.php" style="text-decoration: none;">
        <img src="<?= SECONDIFY; ?>/assets/images/logo/logo.png" alt="" class="logo">
    </a>

    <div class="search-box">
        <input type="text" placeholder="Mau cari barang apa hari ini?" id="searchInput">
    </div>

    <div class="nav-right">
        <a href="<?= SECONDIFY; ?>/apps/views/user/favorit.php" class="nav-icon-btn" title="Wishlist" style="text-decoration: none; color: inherit;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
        </a>
        <a href="<?= SECONDIFY; ?>/apps/views/user/chat.php" class="nav-icon-btn" title="Notifikasi" style="text-decoration: none; color: inherit;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
        </a>
        <div class="nav-divider"></div>
        <a href="<?= SECONDIFY; ?>/apps/views/user/profile.php" class="user" title="Profil">
            <div class="avatar">A</div>
            <div class="user-info">
                <span class="user-name">alyssa</span>
                <span class="user-role">Member</span>
            </div>
        </a>
        <a href="<?= SECONDIFY; ?>/index.php" class="logout-btn" title="Keluar" style="text-decoration: none; color: inherit;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Keluar
        </a>
    </div>
</nav>

<div class="container">
    <h2>Barang Favorit ❤️</h2>

    <div class="grid">

        <div class="card">
            <img src="https://via.placeholder.com/200">
            <h3>Sepatu Nike Bekas</h3>
            <p>Rp 350.000</p>
            <button onclick="removeItem(this)">Hapus</button>
        </div>

        <div class="card">
            <img src="https://via.placeholder.com/200">
            <h3>iPhone 11</h3>
            <p>Rp 4.000.000</p>
            <button onclick="removeItem(this)">Hapus</button>
        </div>

        <div class="card">
            <img src="https://via.placeholder.com/200">
            <h3>Tas Wanita</h3>
            <p>Rp 120.000</p>
            <button onclick="removeItem(this)">Hapus</button>
        </div>

    </div>
</div>

<script src="<?= SECONDIFY; ?>/assets/js/user/favorit.js"></script>
</body>
</html>
