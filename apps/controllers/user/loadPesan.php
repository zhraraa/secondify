<?php

session_start();
require_once '../../../koneksi/koneksi.php';

$id_user = $_SESSION['id_user'];

$id_produk = (int)$_GET['id_produk'];
$id_penjual = (int)$_GET['id_penjual'];

$query = $conn->prepare("
SELECT *
FROM pesan
WHERE id_produk = ?
AND (
    (id_pengirim = ? AND id_penerima = ?)
    OR
    (id_pengirim = ? AND id_penerima = ?)
)
ORDER BY waktu_kirim ASC
");

$query->bind_param(
    "iiiii",
    $id_produk,
    $id_user,
    $id_penjual,
    $id_penjual,
    $id_user
);

$query->execute();

$result = $query->get_result();

$data = [];

while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);