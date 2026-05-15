<?php
require_once '../../config/config.php';
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

        <div class="chat-user active" onclick="openChat('Toko Rizky')">
            <div class="avatar">R</div>
            <div>
                <div class="name">Toko Rizky</div>
                <div class="last-msg">Halo kak, masih ada?</div>
            </div>
        </div>

        <div class="chat-user" onclick="openChat('Toko Rara')">
            <div class="avatar">R</div>
            <div>
                <div class="name">Toko Rara</div>
                <div class="last-msg">Siap kak</div>
            </div>
        </div>

    </div>

    <!-- CHAT BOX -->
    <div class="chat-main">
        <div class="chat-topbar" id="chatTitle">Toko Rizky</div>

        <div class="chat-messages" id="messages">
            <div class="msg sender">Halo kak</div>
            <div class="msg receiver">Iya kak, ada yang bisa dibantu?</div>
        </div>

        <div class="chat-input">
            <input type="text" id="msgInput" placeholder="Ketik pesan...">
            <button onclick="sendMessage()">Kirim</button>
        </div>
    </div>

</div>

<script src="<?= SECONDIFY; ?>/assets/js/user/chat.js"></script>
</body>
</html>
