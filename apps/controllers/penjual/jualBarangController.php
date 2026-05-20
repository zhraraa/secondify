<?php
require_once '../auth/auth_check.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/produkModel.php';

$dataProduk = getDataProduk($conn, $_SESSION['id_user']);

if(isset($_POST['posting'])){
    $namaBarang = $_POST['namaBarang'];
    $harga = $_POST['hargaBarang'];
    $kondisi = $_POST['kondisiBarang'];
    $kategori = $_POST['kategoriBarang'];
    $lokasi = $_POST['kecamatanBarang'];
    $deskripsi = $_POST['deskripsiBarang'];
    
    $foto_name = $_FILES['gambarBarang']['name'];
    $foto_tmp  = $_FILES['gambarBarang']['tmp_name'];
    $foto_size = $_FILES['gambarBarang']['size'];
    $foto_error = $_FILES['gambarBarang']['error'];
    
    $idProduk = $dataProduk['id_produk'];

    if(empty($namaBarang) || empty($harga) || empty($kondisi) || empty($kategori) || empty($lokasi) || empty($deskripsi) || empty($foto_name)){
        $pesan = "Semua kolom wajib diisi.";
    } elseif (strlen($namaBarang) > 50 ){
        $pesan = "Nama barang terlalu panjang.";
    } elseif ($foto_size > 2000000){
        $pesan = "Ukuran file terlalu besar.";
    } else {
        $ekstensi = pathinfo($foto_name, PATHINFO_EXTENSION);
        $nama_file_baru = "produk_" . $idProduk . "_" . time() . "." . $ekstensi;
        $folder_tujuan = "../../../assets/images/produk/" . $nama_file_baru;

        if(move_uploaded_file($foto_tmp, $folder_tujuan)){
            // besok pindah ke folder controller dan model
            $status = insertProduk($conn, $namaBarang, $harga, $kondisi, $kategori, $lokasi, $deskripsi, $nama_file_baru, $idProduk);
            if($status){
                $pesan = "Produk berhasil ditambahkan.";
            } else {
                $pesan = "Produk gagal ditambahkan.";
            }
        } else {
            $pesan = "Gagal mengunggah gambar.";
        }
    }

}

?>