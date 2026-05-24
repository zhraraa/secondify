<?php
require_once '../auth/auth_check.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/produkModel.php';

$id_user = $_SESSION['id_user'];

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

    if(empty($namaBarang) || empty($harga) || empty($kondisi) || empty($kategori) || empty($lokasi) || empty($deskripsi) || empty($foto_name)){
        echo "<script>alert('Semua kolom wajib diisi.');window.history.back();</script>";
        exit();
    } elseif (strlen($namaBarang) > 50 ){
        echo "<script>alert('Nama barang terlalu panjang.');window.history.back();</script>";
        exit();
    } elseif ($foto_size > 2000000){
        echo "<script>alert('Ukuran file terlalu besar.');window.history.back();</script>";
        exit();
    } elseif ($harga <= 0) {
        echo "<script>alert('Harga tidak boleh nol atau negatif.');window.history.back();</script>";
        exit();
    } else {
        $ekstensi = pathinfo($foto_name, PATHINFO_EXTENSION);
        $nama_file_baru = "produk_" . $id_user . "_" . time() . "." . $ekstensi;
        $folder_tujuan = "../../../assets/images/produk/" . $nama_file_baru;

        if(move_uploaded_file($foto_tmp, $folder_tujuan)){
            $upload = postProduk($conn, $id_user, $kategori, $namaBarang, $deskripsi, $harga, $lokasi, $kondisi, $nama_file_baru);
            if($upload){
                echo "<script>alert('Produk berhasil ditambahkan.'); window.location.href = '" . SECONDIFY . "/apps/controllers/penjual/kelolaBarang.php';</script>";
                exit();
            } else {
                echo "<script>alert('Produk gagal ditambahkan.'); window.history.back();</script>";
                exit();
            }
        } else {
            echo "<script>alert('Gagal mengunggah gambar.'); window.history.back();</script>";
            exit();
        }
    }

}

require_once '../../views/penjual/formJualBarang.php';
?>