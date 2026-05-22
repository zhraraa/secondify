<?php

function getDataProduk($conn, $id_user){
    $query = $conn -> prepare("SELECT * FROM produk WHERE id_user = ?");
    $query -> bind_param("i", $id_user);
    $query -> execute();
    $data = $query -> get_result();
    $dataProduk = [];
    while($row = $data -> fetch_assoc()){
        $dataProduk[] = $row;
    }
    return $dataProduk;
}

function postProduk($conn, $namaBarang, $harga, $kondisi, $kategori, $lokasi, $deskripsi, $nama_file_baru ,$id_user ){
    $query = $conn -> prepare("INSERT INTO produk (nama_produk, harga, kondisi, kategori, lokasi, deskripsi, gambar_produk, id_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $query -> bind_param("sisisssi", $namaBarang, $harga, $kondisi, $kategori, $lokasi, $deskripsi, $nama_file_baru, $id_user);
    return $query -> execute();
}

?>