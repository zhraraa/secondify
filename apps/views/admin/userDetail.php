<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';

// Ambil ID dari URL
$id_user = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query ambil data user
$query = "SELECT * FROM users WHERE id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Kalau user gak ketemu
if (!$user) {
    echo "<script>alert('User tidak ditemukan!'); window.location='manajemenUser.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail User - <?= $user['nama_lengkap']; ?></title>
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/style.css">
    <style>
        .detail-card { background: #fff; padding: 30px; border-radius: 12px; max-width: 600px; margin: 50px auto; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .detail-item { margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .detail-item label { font-weight: bold; color: #555; display: block; font-size: 13px; }
        .detail-item span { font-size: 16px; color: #333; }
        .btn-back { display: inline-block; padding: 10px 20px; background: #6c757d; color: #fff; text-decoration: none; border-radius: 8px; margin-top: 20px; }
    </style>
</head>
<body class="adminPage">
    <div class="detail-card">
        <h2>Detail Informasi Pengguna</h2>
        <hr>
        
        <div class="detail-item">
            <label>ID User</label>
            <span>#<?= $user['id_user']; ?></span>
        </div>
        <div class="detail-item">
            <label>Nama Lengkap</label>
            <span><?= $user['nama_lengkap']; ?></span>
        </div>
        <div class="detail-item">
            <label>Username</label>
            <span>@<?= $user['username']; ?></span>
        </div>
        <div class="detail-item">
            <label>Email</label>
            <span><?= $user['email']; ?></span>
        </div>
        <div class="detail-item">
            <label>Role</label>
            <span><?= $user['is_penjual'] == 1 ? 'Penjual' : 'Pembeli'; ?></span>
        </div>
        <div class="detail-item">
            <label>Status Akun</label>
            <span style="color: <?= $user['is_active'] == 1 ? 'green' : 'red'; ?>; font-weight: bold;">
                <?= $user['is_active'] == 1 ? 'Aktif' : 'Dibekukan'; ?>
            </span>
        </div>
        <div class="detail-item">
            <label>Lokasi</label>
            <span><?= $user['lokasi'] ?? '-'; ?></span>
        </div>

        <a href="manajemenUser.php" class="btn-back">← Kembali</a>
    </div>
</body>
</html>