<?php

require_once '../auth/auth_check.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/userModel.php';
require_once '../../models/produkModel.php';
require_once '../../models/ulasanModel.php';

if (isset($_GET['id'])) {
    // kalo ada '?id=' di link, berarti lagi liat profil orang lain
    $id_target = $_GET['id'];
} else {
    // kalo linknya polos (dari Navbar), berarti liat profil sendiri
    $id_target = $_SESSION['id_user'];
}

$is_own_profile = ($id_target == $_SESSION['id_user']);
$dataUser = getDataUSer($conn, $id_target);
$dataProduk = getDataProdukById($conn, $id_target);
$totalProduk = totalProduk($conn, $id_target);

$daftarUlasan = [];
if($dataUser['is_penjual'] == 1){
    $daftarUlasan = getDataUlasan($conn, $id_target);
}

require_once '../../views/user/profile.php';
?>
