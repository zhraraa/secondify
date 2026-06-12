<?php

session_start();
require_once '../../../koneksi/koneksi.php';

$id_pengirim = $_SESSION['id_user'];

$id_produk = !empty($_POST['id_produk'])
    ? (int)$_POST['id_produk']
    : null;

$id_penerima = (int)$_POST['id_penerima'];
$pesan = trim($_POST['pesan']);

$query = $conn->prepare("
INSERT INTO pesan
(id_produk,id_pengirim,id_penerima,isi_pesan)
VALUES (?,?,?,?)
");

$query->bind_param(
    "iiis",
    $id_produk,
    $id_pengirim,
    $id_penerima,
    $pesan
);

if($query->execute()){
    echo "success";
}else{
    echo $query->error;
}