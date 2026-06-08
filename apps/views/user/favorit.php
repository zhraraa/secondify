<?php
session_start();

require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/userModel.php';

$id_user = $_SESSION['id_user'];
$dataUser = getDataUSer($conn, $id_user);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Favorit — Secondify</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/style.css">
<link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/layouts/navbar.css">
<script src="<?= SECONDIFY; ?>/assets/js/layouts/navbar.js" defer></script>

<body class="favoritPage">

<!-- NAVBAR -->
<?php include __DIR__ . '/../../controllers/layout/navbarController.php'; ?>

<div class="container">
    <h2>Barang Favorit ❤️</h2>

    <div class="grid" id="favoriteGrid"></div>
</div>

<script src="<?= SECONDIFY; ?>/assets/js/user/favorit.js?v=20260519-1"></script>
</body>
</html>
