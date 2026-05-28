<?php
require_once '../auth/auth_check.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/userModel.php';
require_once '../../models/produkModel.php';

$id_user = $_SESSION['id_user'];
$dataUser = getDataUSer($conn, $id_user);
$dataProdukMarketplace = formatProdukUntukJs(getAllProdukMarketplace($conn));

require_once '../../views/user/kategori.php';
?>
