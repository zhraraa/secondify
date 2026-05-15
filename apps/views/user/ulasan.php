<?php
require_once '../../config/config.php';
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
<?php include __DIR__ . '/../layout/navbar.php'; ?>

<div class="container">
    <h2>Beri Ulasan ⭐</h2>

    <!-- RATING -->
    <div class="stars" id="stars">
        <span onclick="setRating(1)">☆</span>
        <span onclick="setRating(2)">☆</span>
        <span onclick="setRating(3)">☆</span>
        <span onclick="setRating(4)">☆</span>
        <span onclick="setRating(5)">☆</span>
    </div>

    <!-- TEXT -->
    <textarea id="reviewText" placeholder="Tulis ulasan..."></textarea>

    <button onclick="submitReview()">Kirim Ulasan</button>

    <!-- HASIL -->
    <div class="review-list" id="reviewList"></div>
</div>

<script src="<?= SECONDIFY; ?>/assets/js/user/ulasan.js"></script>
</body>
</html>
