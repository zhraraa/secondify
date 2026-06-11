<?php
session_start();
require_once '../../../koneksi/koneksi.php';

header('Content-Type: application/json');

if (!isset($_SESSION['id_user'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Anda harus login terlebih dahulu untuk melaporkan barang.'
    ]);
    exit;
}

$id_user = $_SESSION['id_user'];
$id_produk = isset($_POST['id_produk']) ? intval($_POST['id_produk']) : 0;
$alasan = isset($_POST['alasan']) ? trim($_POST['alasan']) : '';

if ($id_produk <= 0 || empty($alasan)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Data laporan tidak lengkap.'
    ]);
    exit;
}

// Cek apakah produk ada
$check_product = mysqli_query($conn, "SELECT id_produk FROM produk WHERE id_produk = '$id_produk'");
if (mysqli_num_rows($check_product) === 0) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Produk tidak ditemukan.'
    ]);
    exit;
}

// Masukkan laporan menggunakan prepared statement demi keamanan
$stmt = mysqli_prepare($conn, "INSERT INTO laporan_barang (id_pelapor, id_target_produk, alasan, status) VALUES (?, ?, ?, 'pending')");
mysqli_stmt_bind_param($stmt, "iis", $id_user, $id_produk, $alasan);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Laporan barang berhasil dikirim!'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Gagal mengirim laporan ke database.'
    ]);
}
mysqli_stmt_close($stmt);
?>
