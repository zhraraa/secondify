<?php
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/produkModel.php';
require_once '../../models/pesanModel.php';
require_once '../auth/auth_check.php';

$id_user = $_SESSION['id_user'];
$dataProduk = getDataProdukById($conn, $id_user);
$id_produk = $dataProduk['id_produk'];
$dataPembeli = getDataUserPesan($conn, $id_produk, $id_user);

$barangAktif = [];
$barangTerjual = [];

foreach ($dataProduk as $item){
    if ($item['status'] == 'available' ){
        $barangAktif[] = $item;
        } else {
            $barangTerjual[] = $item;
            }
            }
            
$daftarPembeli = [];
while($row = $dataPembeli -> fetch_assoc()){
    $daftarPembeli[] = $row;
}

$pembeli = [];
foreach($daftarPembeli as $data){
    $pembeli[] = $data;
}

// echo '<pre>';
// var_dump($dataProduk); // Jika kamu pakai Cara 1 sebelumnya, ubah jadi var_dump($barangAktif)
// echo '</pre>';
// die();

require_once '../../views/penjual/kelolaBarang.php';
?>
