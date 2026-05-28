<?php
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/produkModel.php';
require_once '../auth/auth_check.php';

$id_user = $_SESSION['id_user'];
if(isset($_POST['ubah'])){
    $id_produk = $_POST['id_produk']; 
    
    $kategori = $_POST['kategoriBarang'];
    $namaBarang = $_POST['namaBarang'];
    $deskripsi = $_POST['deskripsiBarang'];
    $harga = $_POST['hargaBarang'];
    $lokasi = $_POST['kecamatanBarang'];
    $kondisi = $_POST['kondisiBarang'];

    $updateDataProduk = updateProduk($conn, $id_produk, $id_user, $kategori, $namaBarang, $deskripsi, $harga, $lokasi, $kondisi);
    
    if($updateDataProduk){
        header("Location: ../penjual/kelolaBarang.php?pesan=berhasil_ubah");
        exit();
    } else {
        header("Location: ../penjual/kelolaBarang.php?pesan=gagal_ubah");
        exit();
    }
}


?>