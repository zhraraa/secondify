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
        $pesan = "Semua kolom wajib diisi.";
        header("location: ".SECONDIFY."/apps/views/user/profile.php?pesan=" . urlencode($pesan));
        exit();
    } elseif (strlen($namaBarang) > 50 ){
        $pesan = "Nama barang terlalu panjang.";
        header("location: ".SECONDIFY."/apps/views/user/profile.php?pesan=" . urlencode($pesan));
        exit();
    } elseif ($foto_size > 2000000){
        $pesan = "Ukuran file terlalu besar.";
        header("location: ".SECONDIFY."/apps/views/user/profile.php?pesan=" . urlencode($pesan));
        exit();
    } elseif ($harga <= 0) {
        // $pesan = "Harga tidak boleh nol atau negatif.";
        header("location: ".SECONDIFY."/apps/views/user/profile.php?error=hargaNegatif");
        exit();
    } else {
        $ekstensi = pathinfo($foto_name, PATHINFO_EXTENSION);
        $nama_file_baru = "produk_" . $id_user . "_" . time() . "." . $ekstensi;
        $folder_tujuan = "../../../assets/images/produk/" . $nama_file_baru;

        if(move_uploaded_file($foto_tmp, $folder_tujuan)){
            // besok pindah ke folder controller dan model
            $upload = postProduk($conn, $namaBarang, $harga, $kondisi, $kategori, $lokasi, $deskripsi, $nama_file_baru, $id_user);
            if($upload){
                $pesan = "Produk berhasil ditambahkan.";
                header("location: " . SECONDIFY . "/apps/controllers/user/profileController.php?alert=" . urlencode($pesan));
                exit();
            } else {
                $pesan = "Produk gagal ditambahkan.";
                header("location: " . SECONDfIFY . "/apps/controllers/user/profileController.php?alert=" . urlencode($pesan));
                exit();
            }
        } else {
            $pesan = "Gagal mengunggah gambar.";
            header("location: " . SECONDIFY . "/apps/controllers/user/profileController.php?alert=" . urlencode($pesan));
            exit();
        }
        header("location: ".SECONDIFY."/apps/views/user/profile.php?pesan=" . urlencode($pesan));

        exit();
    }

}

?>