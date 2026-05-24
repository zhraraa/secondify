<?php
/** @var array $dataProduk */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Barang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/penjual/kelolaBarang.css">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/layouts/navbar.css">
    <link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/style.css">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="<?= SECONDIFY; ?>/assets/js/layouts/navbar.js" defer></script>
</head>
<body>
    <!-- NAVBAR -->
    <?php include __DIR__ . '/../layout/navbar.php'; ?>

    <section>
        <div class="header">
            <div class="title">
                <span>Barang Saya</span>
                <span>Kelola daftar barang dagang saya</span>
            </div>

            <a href="<?= SECONDIFY ?>/apps/controllers/penjual/jualBarangController.php" class="btn-tambah">
                <i data-lucide="plus" class="icon"></i>
                Tambah Barang
            </a>
        </div>

        <div class="kelola-barang">
            <div class="opsi">
                <button class="active">Aktif (2)</button>
                <button>Tejual (1)</button>
            </div>

            <div class="list-barang">
                <?php foreach($dataProduk as $data) : ?>
                    <div class="barang-item">
                        <div class="detail-barang">
                            <img src="<?= SECONDIFY; ?>/assets/images/produk/<?= $data['foto_barang'] ?>" alt="barang">
                            
                            <div class="info-barang">
                                <span><?= $data['nama_barang'] ?></span>
                                <span class="harga">Rp <?= $data['harga'] ?></span>
                                
                                <div class="lokasi">
                                    <i data-lucide="map-pin" class="icon"></i>
                                    <span><?= $data['lokasi'] ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <i data-lucide="ellipsis-vertical" class="opsi-menu"></i>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>