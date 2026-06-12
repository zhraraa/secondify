<?php

session_start();
require_once '../../../koneksi/koneksi.php';

$id_user = $_SESSION['id_user'];
$id_penjual = (int)($_GET['id_penjual'] ?? 0);

echo "USER=".$id_user;
echo "<br>";
echo "PENJUAL=".$id_penjual;
exit;

$query = $conn->prepare("
SELECT *
FROM pesan
WHERE
(
    id_pengirim = ?
    AND id_penerima = ?
)
OR
(
    id_pengirim = ?
    AND id_penerima = ?
)
ORDER BY waktu_kirim ASC
");

$query->bind_param(
    "iiii",
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