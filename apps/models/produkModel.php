<?php

function getDataProduk($conn, $id_user){
    $query = $conn -> prepare("SELECT * FROM produk WHERE id_user = ?");
    $query -> bind_param("i", $id_user);
    $query -> execute();
    $data = $query -> get_result();
    $dataProduk = $data -> fetch_assoc();
    return $dataProduk;
}

?>