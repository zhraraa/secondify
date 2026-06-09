<?php
// apps/controllers/admin/UserController.php

require_once '../../../koneksi/koneksi.php';

$allUsers = getAllUsersData();
$totalTampil = count($allUsers);

function getAllUsersData() {
    global $conn;

    $data = [];
    
    // Kolom created_at dihapus dari query
    $sql = "SELECT id_user, username, nama_lengkap, email, is_penjual, status_akun 
            FROM users 
            WHERE role != 'admin' 
            ORDER BY id_user DESC";
            
    $query = mysqli_query($conn, $sql);

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            // Mock transaksi berdasarkan ID biar tetep ramai
            $row['total_transaksi'] = (($row['id_user'] * 3) % 15) + 1;
            $data[] = $row;
        }
    }

    return $data;
}