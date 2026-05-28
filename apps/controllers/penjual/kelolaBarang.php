<?php
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/produkModel.php';
require_once '../../models/pesanModel.php';
require_once '../auth/auth_check.php';

$id_user = $_SESSION['id_user'];
$dataProduk = getDataProdukById($conn, $id_user);

if (isset($_GET['tandaiSelesai'])){
    $idProduk = (int) $_GET['tandaiSelesai'];
    
    $dropdownValue = getDataUserPesan($conn, $idProduk);
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
