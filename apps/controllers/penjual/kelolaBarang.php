<?php
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/produkModel.php';
require_once '../../models/pesanModel.php';
require_once '../auth/auth_check.php';

$id_user = $_SESSION['id_user'];
$dataProduk = getDataProdukById($conn, $id_user);

if (isset($_GET['tandaiTerjual'])){
    $idProduk = (int) $_GET['tandaiTerjual'];
    
    $dropdownValue = getDataUserPesan($conn, $idProduk);
}

if (isset($_POST['tandaiTerjual'])){
    $idProduk = (int) $_GET['tandaiTerjual'];
    $usernamePembeli = $_POST['usnPembeli'];
    
    $update = updateStatusProduk($conn, $idProduk);

    if ($update){
        echo "<script>alert('Produk berhasil ditandai sebagai terjual.'); window.location.href = '" . SECONDIFY . "/apps/controllers/penjual/kelolaBarang.php';</script>";
        exit();
    } else {
        echo "<script>alert('Produk gagal ditandai sebagai terjual.'); window.history.back();</script>";
        exit();
    }
}

if (isset($_POST['hapusProduk'])){
    $idProduk = $_POST['id_produk'];
    $hapus = hapusProduk($conn, $idProduk);

    if ($hapus){
        echo "<script>alert('Produk berhasil dihapus.'); window.location.href = '" . SECONDIFY . "/apps/controllers/penjual/kelolaBarang.php';</script>";
        exit();
    } else {
        echo "<script>alert('Produk gagal dihapus.'); window.history.back();</script>";
        exit();
    }
}

$barangAktif = [];
$barangTerjual = [];

foreach ($dataProduk as $item){
    if ($item['status'] == 'available' ){
        $barangAktif[] = $item;
    } else {
        $barangTerjual[] = $item;
    }
}

// echo '<pre>';
// var_dump($dataProduk); // Jika kamu pakai Cara 1 sebelumnya, ubah jadi var_dump($barangAktif)
// echo '</pre>';
// die();

require_once '../../views/penjual/kelolaBarang.php';
?>
