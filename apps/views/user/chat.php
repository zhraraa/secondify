<?php

session_start();

require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/userModel.php';

$id_user = $_SESSION['id_user'];

$id_produk = $_GET['id_produk'] ?? 0;
$id_penjual = $_GET['id_penjual'] ?? 0;

$dataUser = getDataUSer($conn,$id_user);

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chat — Secondify</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/user/chat.css">
<link rel="stylesheet" href="<?= SECONDIFY; ?>/assets/css/layouts/navbar.css">
<script src="<?= SECONDIFY; ?>/assets/js/layouts/navbar.js" defer></script>

<body>

<!-- NAVBAR -->
<?php include __DIR__ . '/../layout/navbar.php'; ?>

<div class="chat-container">

    <!-- LIST CHAT -->
    <div class="chat-sidebar">
        <div class="chat-header">Pesan</div>

        <div id="chatList"></div>

    </div>

    <!-- CHAT BOX -->
    <div class="chat-main">
        <div class="chat-topbar" id="chatTitle">Pesan</div>

        <div class="chat-messages" id="messages"></div>

        <div class="chat-input">
            <input type="text" id="msgInput" placeholder="Ketik pesan...">
            <button onclick="sendMessage()">Kirim</button>
        </div>
    </div>

</div>

<script>
const ID_PRODUK = <?= (int)$id_produk ?>;
const ID_PENJUAL = <?= (int)$id_penjual ?>;

console.log("ID_PRODUK =", ID_PRODUK);
console.log("ID_PENJUAL =", ID_PENJUAL);
</script>

<script src="<?= SECONDIFY; ?>/assets/js/user/chat.js?v=20260519-1"></script>
</body>
</html>





















