<?php
session_start();
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';

if ($_SESSION['status'] != "login") {
    header("Location: " . SECONDIFY . "index.php?error=harusLogin");
    exit();
}

$id_user = $_SESSION['id_user'];

$queryUser = mysqli_query($conn, "
SELECT * FROM users 
WHERE id_user = '$id_user'
");

$queryAlamat = mysqli_query($conn, "
SELECT * FROM alamat
WHERE id_user = '$id_user'
ORDER BY is_utama DESC
");

$user = mysqli_fetch_assoc($queryUser);
$alamats = mysqli_fetch_all($queryAlamat, MYSQLI_ASSOC);

if(isset($_POST['simpan_profil'])){

    $nama = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $bio = $_POST['bio'];

    mysqli_query($conn, "
    UPDATE users SET
    nama_lengkap = '$nama',
    username = '$username',
    email = '$email',
    no_hp = '$no_hp',
    jenis_kelamin = '$jenis_kelamin',
    tanggal_lahir = '$tanggal_lahir',
    bio = '$bio'
    WHERE id_user = '$id_user'
    ");

    header("Location: setting.php?success=editProfil");
    exit();
}
if (isset($_POST['tambah_alamat'])) {
    $id_user        = $_SESSION['id_user'];
    $label          = htmlspecialchars($_POST['label_alamat']);
    $nama_penerima  = htmlspecialchars($_POST['nama_penerima']);
    $no_hp_penerima = htmlspecialchars($_POST['no_hp_penerima']);
    $alamat         = htmlspecialchars($_POST['alamat_lengkap']);
    $kota           = htmlspecialchars($_POST['kota']);
    $provinsi       = htmlspecialchars($_POST['provinsi']);
    $kode_pos       = htmlspecialchars($_POST['kode_pos']);

    $cek = mysqli_query($conn, "SELECT COUNT(*) as total FROM alamat WHERE id_user = '$id_user'");
    $row = mysqli_fetch_assoc($cek);
    $is_utama = ($row['total'] == 0) ? 1 : 0;

    mysqli_query($conn, "
        INSERT INTO alamat (id_user, label_alamat, nama_penerima, no_hp_penerima, alamat_lengkap, kota, provinsi, kode_pos, is_utama)
        VALUES ('$id_user', '$label', '$nama_penerima', '$no_hp_penerima', '$alamat', '$kota', '$provinsi', '$kode_pos', '$is_utama')
    ");

    header("Location: setting.php?success=tambahAlamat#alamat");
    exit();
}

if (isset($_POST['ubah_alamat'])) {
    $id_alamat      = (int) $_POST['id_alamat'];
    $label          = htmlspecialchars($_POST['label_alamat']);
    $nama_penerima  = htmlspecialchars($_POST['nama_penerima']);
    $no_hp_penerima = htmlspecialchars($_POST['no_hp_penerima']);
    $alamat         = htmlspecialchars($_POST['alamat_lengkap']);
    $kota           = htmlspecialchars($_POST['kota']);
    $provinsi       = htmlspecialchars($_POST['provinsi']);
    $kode_pos       = htmlspecialchars($_POST['kode_pos']);

    mysqli_query($conn, "
        UPDATE alamat SET
            label_alamat = '$label',
            nama_penerima = '$nama_penerima',
            no_hp_penerima = '$no_hp_penerima',
            alamat_lengkap = '$alamat',
            kota = '$kota',
            provinsi = '$provinsi',
            kode_pos = '$kode_pos'
        WHERE id_alamat = '$id_alamat'
        AND id_user = '$id_user'
    ");

    header("Location: setting.php?success=ubahAlamat#alamat");
    exit();
}

if (isset($_POST['hapus_alamat'])) {
    $id_alamat = (int) $_POST['id_alamat'];

    $queryTarget = mysqli_query($conn, "
        SELECT is_utama
        FROM alamat
        WHERE id_alamat = '$id_alamat'
        AND id_user = '$id_user'
        LIMIT 1
    ");
    $targetAlamat = mysqli_fetch_assoc($queryTarget);

    mysqli_query($conn, "
        DELETE FROM alamat
        WHERE id_alamat = '$id_alamat'
        AND id_user = '$id_user'
    ");

    if ($targetAlamat && (int) $targetAlamat['is_utama'] === 1) {
        $queryPengganti = mysqli_query($conn, "
            SELECT id_alamat
            FROM alamat
            WHERE id_user = '$id_user'
            ORDER BY created_at ASC, id_alamat ASC
            LIMIT 1
        ");
        $pengganti = mysqli_fetch_assoc($queryPengganti);

        if ($pengganti) {
            $id_pengganti = (int) $pengganti['id_alamat'];
            mysqli_query($conn, "
                UPDATE alamat
                SET is_utama = 1
                WHERE id_alamat = '$id_pengganti'
                AND id_user = '$id_user'
            ");
        }
    }

    header("Location: setting.php?success=hapusAlamat#alamat");
    exit();
}

if (isset($_POST['jadikan_utama'])) {
    $id_alamat = (int) $_POST['id_alamat'];

    mysqli_query($conn, "
        UPDATE alamat
        SET is_utama = 0
        WHERE id_user = '$id_user'
    ");

    mysqli_query($conn, "
        UPDATE alamat
        SET is_utama = 1
        WHERE id_alamat = '$id_alamat'
        AND id_user = '$id_user'
    ");

    header("Location: setting.php?success=utamaAlamat#alamat");
    exit();
}

if(isset($_POST['ubah_password'])){

    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi = $_POST['konfirmasi_password'];

    $queryPassword = mysqli_query($conn, "
    SELECT password
    FROM users
    WHERE id_user = '$id_user'
    ");

    $dataPassword = mysqli_fetch_assoc($queryPassword);

    if(password_verify($password_lama, $dataPassword['password'])){

        if($password_baru == $konfirmasi){

            if(strlen($password_baru) >= 8){
                $hashPassword = password_hash($password_baru, PASSWORD_DEFAULT);
                mysqli_query($conn, "
                UPDATE users SET
                password = '$hashPassword'
                WHERE id_user = '$id_user'
                ");
                echo "
                <script>
                    alert('Password berhasil diubah!');
                    window.location='setting.php#keamanan';
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('Password Harus Minimal 8 Karakter');
                </script>
                ";
            }
        } else {
            echo "
            <script>
                alert('Konfirmasi password tidak cocok!');
            </script>
            ";
        }
    } else {
        echo "
        <script>
            alert('Password lama salah!');
        </script>
        ";
    }
}

if(isset($_POST['save_privacy'])){

    $show_whatsapp = isset($_POST['show_whatsapp']) ? 1 : 0;
    $show_email = isset($_POST['show_email']) ? 1 : 0;
    $show_tanggal_lahir = isset($_POST['show_tanggal_lahir']) ? 1 : 0;
    $show_transaksi = isset($_POST['show_transaksi']) ? 1 : 0;

    $allow_tracking = isset($_POST['allow_tracking']) ? 1 : 0;
    $anonymous_data = isset($_POST['anonymous_data']) ? 1 : 0;

    mysqli_query($conn, "
    UPDATE users SET

    show_whatsapp = '$show_whatsapp',
    show_email = '$show_email',
    show_tanggal_lahir = '$show_tanggal_lahir',
    show_transaksi = '$show_transaksi',

    allow_tracking = '$allow_tracking',
    anonymous_data = '$anonymous_data'

    WHERE id_user = '$id_user'
    ");

    header("Location: setting.php?success=savePrivacy#privasi");
    exit();
}

if(isset($_POST['kirim_bantuan'])){

    $topik = mysqli_real_escape_string(
        $conn,
        $_POST['topik']
    );

    $pesan = mysqli_real_escape_string(
        $conn,
        $_POST['pesan']
    );

    mysqli_query($conn, "
    INSERT INTO bantuan (

        id_user,
        topik,
        pesan

    ) VALUES (

        '$id_user',
        '$topik',
        '$pesan'

    )
    ");

    header("Location: setting.php?success=kirimBantuan#bantuan");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting — Secondify</title>
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/user/setting.css">
</head>
<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <a href="<?= SECONDIFY ?>/apps/views/user/dashboard.php" class="sidebar-logo">
            <img src="<?= SECONDIFY; ?>/assets/images/logo/logo3.png" alt="" class="logo">
        </a>

        <nav class="sidebar-nav">
            <a href="javascript:void(0)" class="nav-item" data-page="edit-profil">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                Edit Profil
            </a>
            <a href="javascript:void(0)" class="nav-item" data-page="alamat">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
                Alamat Saya
            </a>
            <a href="javascript:void(0)" class="nav-item" data-page="keamanan">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
                Keamanan Akun
            </a>
            <a href="javascript:void(0)" class="nav-item" data-page="privasi">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 8v4M12 16h.01"/>
                </svg>
                Privasi
            </a>
            <a href="javascript:void(0)" class="nav-item" data-page="bantuan">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                Bantuan
            </a>
        </nav>

        <a href="<?= SECONDIFY; ?>/index.php" class="sidebar-logout">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Keluar
        </a>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main">

        <!-- ══ EDIT PROFIL ══ -->
        <section class="page active" id="page-edit-profil">
            <div class="page-header">
                <h1>Edit Profil</h1>
                <p>Kelola informasi profil dan akunmu</p>
            </div>

            <div class="page-grid">
                <div class="content-area">
                    <!-- Informasi Profil -->
                    <div class="card">
                        <form action="" method="POST">
                        <h2 class="card-title">Informasi Profil</h2>

                        <div class="avatar-row">
                            <div class="avatar-circle">
                                <?= strtoupper(substr($user['nama_lengkap'], 0, 1)); ?>
                            </div>
                            <div class="avatar-info">
                                <button class="btn-ubah-foto">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="3"/><path d="M6.343 17.657A8 8 0 1 0 17.657 6.343 8 8 0 0 0 6.343 17.657z"/></svg>
                                    Ubah Foto
                                </button>
                                <p class="avatar-hint">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="12" height="12"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    PNG, JPG maks. 2MB
                                </p>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <div class="input-wrap">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    <input 
                                        type="text"
                                        name="nama_lengkap"
                                        value="<?= $user['nama_lengkap']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <div class="input-wrap">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    <input 
                                        type="text"
                                        name="username"
                                        value="<?= $user['username']; ?>"
                                        placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-wrap">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                    <input 
                                        type="email"
                                        name="email"
                                        value="<?= $user['email']; ?>"
                                        placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nomor Telpon</label>
                                <div class="input-wrap">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                    <input 
                                        type="tel"
                                        name="no_hp"
                                        value="<?= $user['no_hp']; ?>"
                                        placeholder="Nomor Telpon">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <div class="input-wrap select-wrap">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
                                    <select name="jenis_kelamin">
                                        <option value="Laki-laki" <?= $user['jenis_kelamin'] === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="Perempuan" <?= $user['jenis_kelamin'] === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                        <option value="Non-biner" <?= $user['jenis_kelamin'] === 'Non-biner' ? 'selected' : '' ?>>Non-biner</option>
                                        <option value="Tidak ingin menyebutkan" <?= $user['jenis_kelamin'] === 'Tidak ingin menyebutkan' ? 'selected' : '' ?>>Tidak ingin menyebutkan</option>
                                    </select>
                                    <svg class="select-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <div class="input-wrap">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    <input 
                                        type="date"
                                        name="tanggal_lahir"
                                        value="<?= $user['tanggal_lahir']; ?>">
                                </div>
                            </div>
                            <div class="form-group full-width">
                                <label>Bio</label>
                                <div class="input-wrap textarea-wrap">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    <textarea 
                                        name="bio"
                                        placeholder="Ceritakan sedikit tentang dirimu..."><?= $user['bio']; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <button 
                            type="submit"
                            name="simpan_profil"
                            class="btn-simpan">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>

                <!-- Sidebar kanan -->
                <div class="side-cards">
                    <div class="card info-akun-card">
                        <h2 class="card-title">Informasi Akun</h2>
                        <div class="info-row">
                            <div class="info-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
                            <span>Member sejak</span>
                            <strong>Januari 2024</strong>
                        </div>
                        <div class="info-row">
                            <div class="info-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
                            <span>Peran</span>
                            <strong>Member</strong>
                        </div>
                        <div class="info-row">
                            <div class="info-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg></div>
                            <span>Total Transaksi</span>
                            <strong>12 transaksi</strong>
                        </div>
                        <div class="info-row">
                            <div class="info-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
                            <span>Rating</span>
                            <strong>4.9 / 5.0</strong>
                        </div>
                    </div>

                    <div class="card tips-card">
                        <h2 class="card-title">Tips</h2>
                        <ul class="tips-list">
                            <li>
                                <div class="tip-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><polyline points="12 8 12 12 14 14"/></svg></div>
                                Gunakan foto profil yang jelas dan ramah
                            </li>
                            <li>
                                <div class="tip-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><polyline points="12 8 12 12 14 14"/></svg></div>
                                Isi bio untuk meningkatkan kepercayaan pembeli
                            </li>
                            <li>
                                <div class="tip-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><polyline points="12 8 12 12 14 14"/></svg></div>
                                Informasi yang lengkap dapat meningkatkan transaksi
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- ══ ALAMAT ══ -->
        <section class="page" id="page-alamat">
            <div class="page-header">
                <h1>Alamat Saya</h1>
                <p>Kelola alamat pengiriman dan penjemputanmu</p>
            </div>

            <div class="content-area-full">
                <div class="card">
                    <div class="alamat-header-row">
                        <h2 class="card-title">Daftar Alamat</h2>
                        <button type="button" class="btn-add" id="btnTambahAlamat">+ Tambah Alamat</button>
                    </div>

                    <div id="daftar-alamat">
                    <?php if(empty($alamats)) : ?>
                        <p style="color:#aaa; font-size:13px; text-align:center; padding:20px 0;">
                            Belum ada alamat tersimpan.
                        </p>
                    <?php else : ?>
                        <?php foreach($alamats as $alamat) : ?>
                        <div class="alamat-item <?= $alamat['is_utama'] ? 'utama' : '' ?>">
                            <div class="alamat-badge <?= !$alamat['is_utama'] ? 'secondary' : '' ?>">
                                <?= $alamat['is_utama'] ? 'Utama' : htmlspecialchars($alamat['label_alamat']); ?>
                            </div>
                            <div class="alamat-detail">
                                <p class="alamat-name">
                                    <?= htmlspecialchars($alamat['nama_penerima']); ?> · <?= htmlspecialchars($alamat['no_hp_penerima']); ?>
                                </p>
                                <p class="alamat-text">
                                    <?= htmlspecialchars($alamat['alamat_lengkap']); ?>,
                                    <?= htmlspecialchars($alamat['kota']); ?>,
                                    <?= htmlspecialchars($alamat['provinsi']); ?>
                                    <?= htmlspecialchars($alamat['kode_pos']); ?>
                                </p>
                            </div>
                            <div class="alamat-actions">
                                <button
                                    type="button"
                                    class="btn-link btn-ubah-alamat"
                                    data-id="<?= $alamat['id_alamat']; ?>"
                                    data-label="<?= htmlspecialchars($alamat['label_alamat'], ENT_QUOTES); ?>"
                                    data-nama="<?= htmlspecialchars($alamat['nama_penerima'], ENT_QUOTES); ?>"
                                    data-no-hp="<?= htmlspecialchars($alamat['no_hp_penerima'], ENT_QUOTES); ?>"
                                    data-alamat="<?= htmlspecialchars($alamat['alamat_lengkap'], ENT_QUOTES); ?>"
                                    data-kota="<?= htmlspecialchars($alamat['kota'], ENT_QUOTES); ?>"
                                    data-provinsi="<?= htmlspecialchars($alamat['provinsi'], ENT_QUOTES); ?>"
                                    data-kode-pos="<?= htmlspecialchars($alamat['kode_pos'], ENT_QUOTES); ?>"
                                >Ubah</button>
                                <form action="setting.php" method="POST" onsubmit="return confirm('Hapus alamat ini?');">
                                    <input type="hidden" name="id_alamat" value="<?= $alamat['id_alamat']; ?>">
                                    <button type="submit" name="hapus_alamat" class="btn-link danger">Hapus</button>
                                </form>
                                <?php if(!$alamat['is_utama']) : ?>
                                    <form action="setting.php" method="POST">
                                        <input type="hidden" name="id_alamat" value="<?= $alamat['id_alamat']; ?>">
                                        <button type="submit" name="jadikan_utama" class="btn-link">Jadikan Utama</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- ══ KEAMANAN AKUN ══ -->
        <section class="page" id="page-keamanan">
            <div class="page-header">
                <h1>Keamanan Akun</h1>
                <p>Jaga keamanan akunmu agar tetap terlindungi</p>
            </div>
            <div class="page-grid">
                <div class="content-area">
                    <div class="card">
                        <form action="" method="POST" id="formUbahPassword">
                        <h2 class="card-title">Ubah Password</h2>
                        <div class="form-grid single">
                            <div class="form-group full-width">
                                <label>Password Saat Ini</label>
                                <div class="input-wrap">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    <input 
                                        type="password"
                                        name="password_lama"
                                        placeholder="Masukkan password lama"
                                        required>
                                </div>
                            </div>
                            <div class="form-group full-width">
                                <label>Password Baru</label>
                                <div class="input-wrap">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    <input 
                                        type="password"
                                        name="password_baru"
                                        id="passwordBaru"
                                        placeholder="Minimal 8 karakter"
                                        required>
                                </div>
                                <p class="form-error" id="passwordBaruError">Password Harus Minimal 8 Karakter</p>
                            </div>
                            <div class="form-group full-width">
                                <label>Konfirmasi Password Baru</label>
                                <div class="input-wrap">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    <input 
                                        type="password"
                                        name="konfirmasi_password"
                                        placeholder="Ulangi password baru"
                                        required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="ubah_password" class="btn-simpan">Ubah Password</button>
                    </div>
                                </form>

                </div>
                <div class="side-cards">
                    <div class="card tips-card">
                        <h2 class="card-title">Tips Keamanan</h2>
                        <ul class="tips-list">
                            <li><div class="tip-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>Gunakan password yang kuat dan unik</li>
                            <li><div class="tip-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>Jangan bagikan password ke siapapun</li>
                            <li><div class="tip-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>Ganti password secara berkala</li>
                        </ul>
                    </div>
                    <div class="card danger-zone-card">
                        <h2 class="card-title danger-title">Zona Bahaya</h2>
                        <p class="danger-desc">Tindakan berikut bersifat permanen dan tidak dapat dibatalkan.</p>
                        <button class="btn-danger">Hapus Akun</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- ══ PRIVASI ══ -->
        <section class="page" id="page-privasi">
            <div class="page-header">
                <h1>Privasi</h1>
                <p>Kontrol siapa yang dapat melihat informasimu</p>
            </div>
            <div class="content-area-full">
                <form method="POST">
                    <div class="card">
                        <h2 class="card-title">Visibilitas Profil</h2>
                        <div class="toggle-row">
                            <div>
                                <p class="toggle-label">Tampilkan nomor WhatsApp</p>
                                <p class="toggle-desc">
                                    Nomor WA bisa dilihat oleh pembeli yang tertarik
                                </p>
                            </div>
                            <label class="toggle">
                                <input 
                                type="checkbox"
                                name="show_whatsapp"
                                <?= $user['show_whatsapp'] ? 'checked' : ''; ?>
                                >
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="toggle-row">
                            <div>
                                <p class="toggle-label">Tampilkan email</p>
                                <p class="toggle-desc">
                                    Email dapat dilihat oleh pengguna lain
                                </p>
                            </div>
                            <label class="toggle">
                                <input 
                                type="checkbox"
                                name="show_email"
                                <?= $user['show_email'] ? 'checked' : ''; ?>
                                >
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="toggle-row">
                            <div>
                                <p class="toggle-label">Tampilkan tanggal lahir</p>
                                <p class="toggle-desc">
                                    Tanggal lahir ditampilkan di profil publikmu
                                </p>
                            </div>
                            <label class="toggle">
                                <input 
                                type="checkbox"
                                name="show_tanggal_lahir"
                                <?= $user['show_tanggal_lahir'] ? 'checked' : ''; ?>
                                >
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="toggle-row">
                            <div>
                                <p class="toggle-label">Tampilkan riwayat transaksi</p>
                                <p class="toggle-desc">
                                    Total transaksi dapat dilihat oleh pengguna lain
                                </p>
                            </div>
                            <label class="toggle">
                                <input 
                                type="checkbox"
                                name="show_transaksi"
                                <?= $user['show_transaksi'] ? 'checked' : ''; ?>
                                >
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="card mt-16">
                        <h2 class="card-title">Data & Aktivitas</h2>
                        <div class="toggle-row">
                            <div>
                                <p class="toggle-label">
                                    Izinkan pelacakan aktivitas
                                </p>
                                <p class="toggle-desc">
                                    Untuk meningkatkan rekomendasi barang bagimu
                                </p>
                            </div>
                            <label class="toggle">
                                <input 
                                type="checkbox"
                                name="allow_tracking"
                                <?= $user['allow_tracking'] ? 'checked' : ''; ?>
                                >
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <div class="toggle-row">
                            <div>
                                <p class="toggle-label">
                                    Berbagi data anonim
                                </p>
                                <p class="toggle-desc">
                                    Membantu Secondify meningkatkan layanan
                                </p>
                            </div>
                            <label class="toggle">
                                <input 
                                type="checkbox"
                                name="anonymous_data"
                                <?= $user['anonymous_data'] ? 'checked' : ''; ?>
                                >
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    <button 
                        type="submit"
                        name="save_privacy"
                        class="btn-simpan mt-16">
                        Simpan Pengaturan
                    </button>
                </form>

            </div>
        </section>

        <!-- ══ BANTUAN ══ -->
        <section class="page" id="page-bantuan">
            <div class="page-header">
                <h1>Bantuan</h1>
                <p>Temukan jawaban atau hubungi tim kami</p>
            </div>
            <div class="page-grid">
                <div class="content-area">
                    <div class="card">
                        <h2 class="card-title">Pertanyaan Umum (FAQ)</h2>
                        <div class="faq-list">
                            <details class="faq-item">
                                <summary>Bagaimana cara menjual barang di Secondify?</summary>
                                <p>Klik tombol "Jual Barang" di dashboard, isi detail produk seperti nama, harga, kondisi, dan foto. Setelah diverifikasi, barangmu akan tampil di marketplace.</p>
                            </details>
                            <details class="faq-item">
                                <summary>Metode pembayaran apa yang tersedia?</summary>
                                <p>Secondify mendukung transfer bank, dompet digital (GoPay, OVO, DANA), dan pembayaran tunai untuk transaksi tatap muka di Bandar Lampung.</p>
                            </details>
                            <details class="faq-item">
                                <summary>Bagaimana jika barang yang diterima tidak sesuai?</summary>
                                <p>Laporkan dalam 1×24 jam setelah barang diterima melalui menu "Laporkan Masalah" di halaman transaksi. Tim kami akan memediasi.</p>
                            </details>
                            <details class="faq-item">
                                <summary>Apakah ada biaya untuk berjualan di Secondify?</summary>
                                <p>Daftar dan pasang iklan gratis! Secondify mengambil komisi kecil hanya setelah transaksi berhasil dilakukan.</p>
                            </details>
                            <details class="faq-item">
                                <summary>Bagaimana cara meningkatkan rating penjual?</summary>
                                <p>Respons pembeli dengan cepat, kirim barang sesuai deskripsi, dan pastikan kondisi barang sesuai yang dijanjikan untuk mendapatkan ulasan positif.</p>
                            </details>
                        </div>
                    </div>
                    <form method="POST">
                    <div class="card mt-16">
                        <h2 class="card-title">Kirim Pesan ke Tim Kami</h2>
                        <div class="form-grid single">
                            <div class="form-group full-width">
                                <label>Topik</label>
                                <div class="input-wrap select-wrap">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                                    <select name="topik" required>
                                        <option value="Masalah Transaksi">Masalah Transaksi</option>
                                        <option value="Akun & Keamanan">Akun & Keamanan</option>
                                        <option value="Pengiriman">Pengiriman</option>
                                        <option value="Pengembalian Barang">Pengembalian Barang</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    <svg class="select-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                                </div>
                            </div>
                            <div class="form-group full-width">
                                <label>Pesan</label>
                                <div class="input-wrap textarea-wrap">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                    <textarea name="pesan" placeholder="Jelaskan masalah atau pertanyaanmu..." required></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="kirim_bantuan"class="btn-simpan">Kirim Pesan</button>
                        </form>
                    </div>
                </div>

                <div class="side-cards">
                    <div class="card tips-card">
                        <h2 class="card-title">Hubungi Kami</h2>
                        <ul class="kontak-list">
                            <li>
                                <div class="kontak-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                </div>
                                <div>
                                    <p class="kontak-label">Email</p>
                                    <p class="kontak-value">support@secondify.id</p>
                                </div>
                            </li>
                            <li>
                                <div class="kontak-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.93 12 19.79 19.79 0 0 1 1.86 3.38 2 2 0 0 1 3.84 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                </div>
                                <div>
                                    <p class="kontak-label">WhatsApp</p>
                                    <p class="kontak-value">0811-7222-333</p>
                                </div>
                            </li>
                            <li>
                                <div class="kontak-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </div>
                                <div>
                                    <p class="kontak-label">Jam Operasional</p>
                                    <p class="kontak-value">Sen–Jum, 08.00–17.00</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <!-- MODAL TAMBAH ALAMAT -->
        <div id="modalAlamat" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); z-index:1000; align-items:center; justify-content:center;">
            <div style="background:white; border-radius:18px; padding:28px; width:100%; max-width:480px; margin:0 16px; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
                <h2 style="font-size:16px; font-weight:800; margin-bottom:20px; color:#1a1a2e;">Tambah Alamat Baru</h2>
                <form action="setting.php" method="POST" style="display:flex; flex-direction:column; gap:14px;">
                    <div class="form-group">
                        <label>Label Alamat</label>
                        <div class="input-wrap">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <input type="text" name="label_alamat" placeholder="Rumah / Kantor" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama Penerima</label>
                        <div class="input-wrap">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <input type="text" name="nama_penerima" placeholder="Nama lengkap penerima" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <div class="input-wrap">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            <input type="tel" name="no_hp_penerima" placeholder="No HP Penerima" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat Lengkap</label>
                        <div class="input-wrap textarea-wrap">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <textarea name="alamat_lengkap" placeholder="Nama jalan, nomor rumah, RT/RW..." required></textarea>
                        </div>
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                        <div class="form-group">
                            <label>Kota</label>
                            <div class="input-wrap">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                                <input type="text" name="kota" placeholder="Kota" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Provinsi</label>
                            <div class="input-wrap">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                                <input type="text" name="provinsi" placeholder="Provinsi" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <div class="input-wrap">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.92v3a2 2 0 0 1-2.18 2"/></svg>
                            <input type="text" name="kode_pos" placeholder="Kode Pos" required>
                        </div>
                    </div>
                    <div style="display:flex; gap:10px; margin-top:6px;">
                        <button type="button" id="btnBatalAlamat" style="flex:1; padding:12px; background:#f4f4f8; border:none; border-radius:12px; font-size:14px; font-weight:700; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif;">Batal</button>
                        <button type="submit" name="tambah_alamat" style="flex:2; padding:12px; background:linear-gradient(135deg,#886BC6,#D3C3FB); color:white; border:none; border-radius:12px; font-size:14px; font-weight:700; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif;">Simpan Alamat</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL UBAH ALAMAT -->
        <div id="modalUbahAlamat" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); z-index:1000; align-items:center; justify-content:center;">
            <div style="background:white; border-radius:18px; padding:28px; width:100%; max-width:480px; margin:0 16px; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
                <h2 style="font-size:16px; font-weight:800; margin-bottom:20px; color:#1a1a2e;">Ubah Alamat</h2>
                <form action="setting.php" method="POST" style="display:flex; flex-direction:column; gap:14px;">
                    <input type="hidden" name="id_alamat" id="editIdAlamat">
                    <div class="form-group">
                        <label>Label Alamat</label>
                        <div class="input-wrap">
                            <input type="text" name="label_alamat" id="editLabelAlamat" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama Penerima</label>
                        <div class="input-wrap">
                            <input type="text" name="nama_penerima" id="editNamaPenerima" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <div class="input-wrap">
                            <input type="tel" name="no_hp_penerima" id="editNoHpPenerima" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat Lengkap</label>
                        <div class="input-wrap textarea-wrap">
                            <textarea name="alamat_lengkap" id="editAlamatLengkap" required></textarea>
                        </div>
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                        <div class="form-group">
                            <label>Kota</label>
                            <div class="input-wrap">
                                <input type="text" name="kota" id="editKota" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Provinsi</label>
                            <div class="input-wrap">
                                <input type="text" name="provinsi" id="editProvinsi" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <div class="input-wrap">
                            <input type="text" name="kode_pos" id="editKodePos" required>
                        </div>
                    </div>
                    <div style="display:flex; gap:10px; margin-top:6px;">
                        <button type="button" id="btnBatalUbahAlamat" style="flex:1; padding:12px; background:#f4f4f8; border:none; border-radius:12px; font-size:14px; font-weight:700; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif;">Batal</button>
                        <button type="submit" name="ubah_alamat" style="flex:2; padding:12px; background:linear-gradient(135deg,#886BC6,#D3C3FB); color:white; border:none; border-radius:12px; font-size:14px; font-weight:700; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif;">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

</div>

<script src="<?= SECONDIFY; ?>/assets/js/user/setting.js?v=20260518-3"></script>
</body>
</html>
