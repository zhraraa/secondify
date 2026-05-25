<?php
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/produkModel.php';
require_once '../auth/auth_check.php';

$id_user = $_SESSION['id_user'];
$dataProduk = getDataProdukById($conn, $id_user);
require_once '../../views/penjual/kelolaBarang.php';
?>
