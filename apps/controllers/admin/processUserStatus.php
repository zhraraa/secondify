<?php
// apps/controllers/admin/processUserStatus.php

require_once '../../../koneksi/koneksi.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = isset($_POST['id_user']) ? intval($_POST['id_user']) : 0;
    $action  = isset($_POST['action']) ? $_POST['action'] : '';

    if ($id_user <= 0 || !in_array($action, ['freeze', 'activate'])) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak valid.']);
        exit;
    }

    // Tentukan status baru untuk kolom status_akun di database
    // Misal di DB nama kolomnya status_akun, nilainya 'active' atau 'suspended' / 'dibekukan'
    $status_baru = ($action === 'freeze') ? 'dibekukan' : 'aktif';
    
    $sql = "UPDATE users SET status_akun = '$status_baru' WHERE id_user = $id_user";
    
    if (mysqli_query($conn, $sql)) {
        $msg = ($action === 'freeze') ? "Akun berhasil dibekukan!" : "Akun berhasil diaktifkan kembali!";
        echo json_encode(['status' => 'success', 'message' => $msg]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui status di database.']);
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Akses ditolak.']);