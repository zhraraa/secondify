<?php
require_once '../../config/config.php';
// Panggil controller user
require_once '../../controllers/admin/UserController.php';

$allUsers = getAllUsersData();
$totalTampil = count($allUsers);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User — Secondify</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/style.css">
</head>
<body class="adminPage">

<?php include 'sidebar.php'; ?>

<div class="main-wrap">

    <div class="topbar">
        <div>
            <div class="topbar-title">Manajemen User</div>
            <div class="topbar-breadcrumb">Admin / <span>Manajemen User</span></div>
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
                <div style="margin-left:auto;font-size:12px;color:#aaa;" id="user-count">Menampilkan <?= $totalTampil; ?> pengguna</div>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Pengguna</th><th>Username</th><th>Peran</th>
                        <th>Transaksi</th><th>Status</th><th>Aksi</th> </tr>
                </thead>
                <tbody id="userTbody">
                    <?php if(!empty($allUsers)): ?>
                        <?php foreach($allUsers as $user): 
                            $isPenjual = ($user['is_penjual'] == 1);
                            $roleText = $isPenjual ? 'Penjual' : 'Pembeli';
                            $roleClass = $isPenjual ? 'purple' : 'blue';
                            
                            $isAktif = (strtolower($user['status_akun']) !== 'dibekukan');
                            $statusText = $isAktif ? 'Aktif' : 'Dibekukan';
                            $statusClass = $isAktif ? 'green' : 'red';
                        ?>
                            <tr data-role="<?= $roleText; ?>" data-status="<?= $statusText; ?>">
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-sm" style="background: linear-gradient(135deg, #886BC6, #a892e3);">
                                            <?= strtoupper(substr($user['nama_lengkap'], 0, 1)); ?>
                                        </div>
                                        <div>
                                            <div class="user-name-sm"><?= htmlspecialchars($user['nama_lengkap']); ?></div>
                                            <div class="user-email-sm"><?= htmlspecialchars($user['email']); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>@<?= htmlspecialchars($user['username']); ?></td>
                                <td><span class="badge <?= $roleClass; ?>"><?= $roleText; ?></span></td>
                                <td><?= $user['total_transaksi']; ?> transaksi</td>
                                <td><span class="badge <?= $statusClass; ?>"><span class="badge-dot"></span><?= $statusText; ?></span></td>
                                <td>
                                    <div class="action-row">
                                        <a href="userDetail.php?id=<?= $user['id_user']; ?>" class="btn-action view" style="text-decoration: none; display: inline-block;">
                                            Detail
                                        </a>
                                        <?php if($isAktif): ?>
                                            <button class="btn-action danger" onclick="toggleUserStatus(<?= $user['id_user']; ?>, 'freeze')">Bekukan</button>
                                        <?php else: ?>
                                            <button class="btn-action approve" onclick="toggleUserStatus(<?= $user['id_user']; ?>, 'activate')">Aktifkan</button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align:center;color:#888;padding:20px;">Tidak ada data pengguna.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </section>
</div>

<div class="toast" id="toast"></div>
<script src="<?= SECONDIFY; ?>/assets/js/admin/userManagement.js"></script>
</body>
</html>