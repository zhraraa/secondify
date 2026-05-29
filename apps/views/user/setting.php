<?php
/** @var array $user */
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
        <a href="<?= SECONDIFY ?>/apps/controllers/user/dashboardController.php" class="sidebar-logo">
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
            <a href="javascript:void(0)" class="nav-item" data-page="keamanan">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
                Keamanan Akun
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
                        <form action="" method="POST" enctype="multipart/form-data" id="formUbahFoto">
                        <h2 class="card-title">Informasi Profil</h2>

                        <div class="avatar-row">
                            <div class="avatar-circle">
                                <?php if (!empty($user['profile_pict']) && $user['profile_pict'] !== 'default.png'): ?>
                                    <img src="<?= SECONDIFY ?>/assets/images/<?= $user['profile_pict'] ?>" 
                                        alt="Foto Profil" class="avatar-img">
                                <?php else: ?>
                                    <?= strtoupper(substr($user['nama_lengkap'], 0, 1)) ?>
                                <?php endif; ?>
                            </div>
                            <div class="avatar-info">
                                    <input type="file" name="foto_profil" id="inputFoto" 
                                        accept="image/png,image/jpeg" style="display:none">
                                    <button type="button" class="btn-ubah-foto" id="btnUbahFoto">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                            <circle cx="12" cy="12" r="3"/>
                                            <path d="M6.343 17.657A8 8 0 1 0 17.657 6.343 8 8 0 0 0 6.343 17.657z"/>
                                        </svg>
                                        Ubah Foto
                                    </button>
                                    <button type="submit" name="ubah_foto" id="btnSimpanFoto" 
                                            style="display:none" class="btn-ubah-foto">Simpan Foto</button>
                                <p class="avatar-hint">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="12" height="12">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="12" y1="8" x2="12" y2="12"/>
                                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                                    </svg>
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
                        <?php while($faq = mysqli_fetch_assoc($dataFaq)) : ?>
                            <details class="faq-item">
                                <summary><?= $faq['pertanyaan']; ?></summary>
                                <p><?= $faq['jawaban']; ?></p>
                            </details>
                        <?php endwhile; ?>
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
</div>

<script src="<?= SECONDIFY; ?>/assets/js/user/setting.js?v=20260518-3"></script>
</body>
</html>
