<?php
require_once '../auth/auth_check.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/userModel.php';
require_once '../../models/produkModel.php';

$id_user = $_SESSION['id_user'];
$dataUser = getDataUSer($conn, $id_user);
$id_produk = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$dataProdukMarketplace = formatProdukUntukJs(getAllProdukMarketplace($conn));
$dataProdukDetail = $id_produk > 0 ? getProdukMarketplaceById($conn, $id_produk) : null;

require_once '../../views/user/detail.php';
?>
