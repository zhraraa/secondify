<?php

function getAllKategori($conn){
    $query = $conn -> prepare("
        SELECT id_kategori, nama_kategori
        FROM kategori
        ORDER BY id_kategori ASC
    ");
    $query -> execute();
    $dataKategori = $query -> get_result();
    return $dataKategori -> fetch_all(MYSQLI_ASSOC);
}

function slugKategori($namaKategori){
    return strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $namaKategori), '-'));
}

?>
