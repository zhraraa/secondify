<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menjadi Penjual</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/user/formDaftarPenjual.css">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/layouts/navbar.css">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/style.css">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="<?= SECONDIFY; ?>/assets/js/layouts/navbar.js" defer></script>
</head>
<body>
    <?php include __DIR__ . '/../layout/navbar.php'; ?>

    <section>
        <div class="content">
            <a href="<?= SECONDIFY ?>/apps/controllers/user/profileController.php" class="tombol-kembali">
                <i data-lucide="arrow-left" class="icon"></i>
                <span class="text">Kembali ke Profil</span>
            </a>
            
            <div class="container-form">
                <div class="header">
                    <img src="<?= SECONDIFY; ?>/assets/images/logo/logo2.png" alt="" style="width: 45px;">
                    <div class="header-title">
                        <span>Daftar Jadi Penjual</span>
                        <p>Lengkapi data berikut untuk mulai berjualan</p>
                    </div>
                </div>

                <?php if(isset($status) && $status == 'pending'): ?>
                    <div class="penyetujuanAdmin">
                        <i data-lucide="timer" class="iconStatus"></i>
                        <h2>Pengajuan Sedang Diproses</h2>
                        <p>Halo, form pendaftaran kamu sudah masuk dan sedang menunggu konfirmasi admin. Mohon tunggu maksimal 3x24 jam.</p>
                        <a href="<?= SECONDIFY ?>/apps/controllers/user/profileController.php" class="submit-button">Kembali ke Profil</a>
                    </div>

                <?php elseif(isset($status) && $status == 'approved'): ?>
                    <div class="penyetujuanAdmin"> 
                        <i data-lucide="check-circle" class="iconStatus"></i>
                        <h2>Selamat! Toko Disetujui</h2>
                        <p>Pendaftaran kamu telah disetujui. Sekarang kamu sudah bisa mulai berjualan di Secondify.</p>
                        <a href="<?= SECONDIFY ?>/apps/controllers/penjual/kelolaBarang.php" class="submit-button">Mulai Berjualan</a>
                    </div>

                <?php elseif(isset($status) && $status == 'rejected'): ?>
                    <div class="penyetujuanAdmin"> 
                        <i data-lucide="x-circle" class="iconStatus" style="color: #e74c3c;"></i>
                        <h2>Mohon Maaf, Pengajuan Ditolak</h2>
                        <p>Pendaftaran tokomu belum disetujui oleh admin.</p>
                        
                        <?php if(!empty($alasan_penolakan)): ?>
                            <div style="background-color: #fdf2f2; border: 1px solid #f5c6cb; padding: 10px; border-radius: 8px; margin: 15px 0; color: #721c24; font-size: 13px;">
                                <strong>Alasan Penolakan:</strong> <?= htmlspecialchars($alasan_penolakan) ?>
                            </div>
                        <?php endif; ?>
                        
                        <a href="?daftar_ulang=true" class="submit-button" style="background-color: #e74c3c;">Daftar Ulang</a>
                    </div>

                <?php else: ?>
                    <form action="<?= SECONDIFY ?>/apps/controllers/user/daftarPenjualController.php" method="POST" enctype="multipart/form-data">
                        <div class="input-group">
                            <label>Nama Toko</label>
                            <input type="text" placeholder="Contoh: Toko Ara" name="nama_toko" maxlength="30" minlength="5" required>
                        </div>

                        <div class="input-group">
                            <label>Foto KTP</label>
                            <label for="fotoKTP" class="upload-file">
                                <i data-lucide="upload" class="icon"></i>
                                <div id="namaFoto">
                                    <span>Klik untuk unggah foto KTP</span>
                                    <span>Format: JPG / PNG, max 2MB</span>
                                </div>
                            </label>
                            <input id="fotoKTP" type="file" accept=".jpg,.png" style="display: none;" name="foto_ktp" required>
                        </div>

                        <div class="input-group">
                            <label>Deskripsi Singkat (Opsional)</label>
                            <textarea placeholder="Ceritakan jenis barang yang akan kamu jual" name="catatan_tambahan"></textarea>
                        </div>

                        <div class="input-checkbox">
                            <input type="checkbox" required>
                            <label>Saya telah membaca dan menyetujui <span class="syarat-ketentuan">Syarat dan Ketentuan</span></label>
                        </div>
                        
                        <button type="submit" name="kirim_pengajuan" class="submit-button">Kirim Pengajuan</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </section>
    
    <script src="<?= SECONDIFY; ?>/assets/js/user/formDaftarPenjual.js"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>