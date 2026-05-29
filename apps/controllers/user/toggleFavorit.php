<?php

session_start();
require_once '../../../koneksi/koneksi.php';

if(!isset($_SESSION['id_user'])){
    exit("login");
}

$id_user = $_SESSION['id_user'];
$id_produk = $_POST['id_produk'];

$cek = mysqli_query(
    $conn,
    "SELECT *
    FROM favorit
    WHERE id_user='$id_user'
    AND id_produk='$id_produk'"
);

if(mysqli_num_rows($cek) > 0){

    mysqli_query(
        $conn,
        "DELETE FROM favorit
        WHERE id_user='$id_user'
        AND id_produk='$id_produk'"
    );

    echo "removed";

}else{

    mysqli_query(
        $conn,
        "INSERT INTO favorit(id_user,id_produk)
        VALUES('$id_user','$id_produk')"
    );

    echo "added";
}