<?php

function getDataProdukById($conn, $id_user){
    $query = $conn -> prepare("
        SELECT * FROM produk 
        JOIN kategori ON produk.id_kategori = kategori.id_kategori
        WHERE id_user = ?
    ");
    $query -> bind_param("i", $id_user);
    $query -> execute();
    $dataProduk = $query -> get_result();
    return $dataProduk -> fetch_all(MYSQLI_ASSOC);
}

function postProduk($conn, $id_user, $kategori, $namaBarang, $deskripsi, $harga, $lokasi, $kondisi, $nama_file_baru){
    $query = $conn -> prepare("INSERT INTO produk (id_user, id_kategori, nama_barang, deskripsi, harga, lokasi, kondisi, foto_barang) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $query -> bind_param("iississs", $id_user, $kategori, $namaBarang, $deskripsi, $harga, $lokasi, $kondisi, $nama_file_baru);
    return $query -> execute();
}

?>