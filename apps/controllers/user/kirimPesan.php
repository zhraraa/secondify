<?php

session_start();
require_once '../../../koneksi/koneksi.php';

$id_pengirim = $_SESSION['id_user'];

$id_produk   = (int)($_POST['id_produk'] ?? 0);
$id_penerima = (int)($_POST['id_penerima'] ?? 0);
$pesan       = trim($_POST['pesan'] ?? '');

if($id_penerima <= 0 || empty($pesan)){
    exit("error");
}

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
    echo "error";
}