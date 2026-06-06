<?php
require_once '../../config/config.php';
/** @var array $fotoProduk */
/** @var array $daftarUlasan */

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ulasan — Secondify</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/user/ulasan.css">
<link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/layouts/navbar.css">
<script src="<?= SECONDIFY; ?>/assets/js/layouts/navbar.js" defer></script>

<body>

<!-- NAVBAR -->
<?php include __DIR__ . '/../../controllers/layout/navbarController.php'; ?>

<?php foreach ($daftarUlasan as $dataUlasan): ?>
    <div class="container">
        <h2>Beri Ulasan</h2>
        <div>
            <div class="ulasan-produkUlasan">
                <span>Bagaimana pendapatmu tentang pembelian produk ini?</span>
                <div class="ulasan-rowProduk">
                    <img src="<?= SECONDIFY ?>/assets/images/produk/<?= $dataUlasan['foto_barang'] ?>" alt="Foto Produk">
                    <div class="ulasan-asalProduk">
                        <span class="ulasan-namaBarang"><?= $dataUlasan['nama_barang'] ?></span>
                        <span class="ulasan-namaToko">by <?= $dataUlasan['nama_toko'] ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- RATING & TEXT (FORM) -->
        <form action="<?= SECONDIFY; ?>/apps/controllers/user/ulasanController.php" method="POST">
            <!-- Hidden input untuk membawa ID Review ke backend -->
            <input type="hidden" name="id_review" value="<?= $dataUlasan['id_review'] ?>">
            <!-- Hidden input untuk menangkap nilai bintang dari JavaScript -->
            <input type="hidden" name="ratingValue" id="ratingInput" value="0" required>
            
            <div class="stars" id="stars">
                <span onclick="setRating(1)">☆</span>
                <span onclick="setRating(2)">☆</span>
                <span onclick="setRating(3)">☆</span>
                <span onclick="setRating(4)">☆</span>
                <span onclick="setRating(5)">☆</span>
            </div>
            <div class="ulasan-Penilaian">
                <span>buruk</span>
                <span>sangat baik</span>
            </div>

            <!-- TEXT -->
            <textarea id="reviewText" placeholder="Tulis ulasan... (minimal 15 karakter)" name="teksUlasan" minlength="15" required></textarea>

            <button type="submit">Kirim Ulasan</button>
        </form>

        <!-- HASIL -->
        <div class="review-list" id="reviewList"></div>
    </div>
<?php endforeach; ?>

<script src="<?= SECONDIFY; ?>/assets/js/user/ulasan.js"></script>
</body>
</html>
