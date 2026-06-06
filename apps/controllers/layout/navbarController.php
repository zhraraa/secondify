<?php
require_once __DIR__ . '/../auth/auth_check.php';
require_once __DIR__ . '/../../../koneksi/koneksi.php';
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/userModel.php';


$id_user = $_SESSION['id_user'];
$dataUser = getDataUSer($conn, $id_user);

$penjual = false;
if($dataUser['is_penjual'] == 1){
    $penjual = true;
}

require_once __DIR__ . '/../../views/layout/navbar.php';
?>