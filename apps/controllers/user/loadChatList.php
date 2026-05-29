<?php

session_start();
require_once '../../../koneksi/koneksi.php';

$id_user = $_SESSION['id_user'];

$query = $conn->prepare("
SELECT DISTINCT
    u.id_user,
    COALESCE(u.nama_toko, u.nama_lengkap) AS nama_user
FROM pesan p
JOIN users u ON (
    CASE
        WHEN p.id_pengirim = ? THEN p.id_penerima
        ELSE p.id_pengirim
    END
) = u.id_user
WHERE p.id_pengirim = ?
OR p.id_penerima = ?
");

$query->bind_param(
    "iii",
    $id_user,
    $id_user,
    $id_user
);

$query->execute();

$result = $query->get_result();

$data = [];

while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);