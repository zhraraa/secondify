<?php
// apps/controllers/admin/SellerVerificationController.php

require_once '../../../koneksi/koneksi.php';

function getVerificationData() {
    global $conn;

    $data = [
        'menunggu'  => [],
        'disetujui' => [],
        'ditolak'   => []
    ];

    // Query gabungan (JOIN) antara tabel seller_application dengan users 
    // biar kita bisa dapetin nama lengkap, email, dan profile picture pemohon
    $sql = "SELECT sa.*, u.nama_lengkap, u.email, u.profile_pict, u.username
            FROM seller_application sa
            JOIN users u ON sa.id_user = u.id_user
            ORDER BY sa.tgl_pengajuan DESC";

    $query = mysqli_query($conn, $sql);

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            // Format Tanggal Indonesia Sederhana (Contoh: 28 May 2026)
            $row['tgl_format'] = date('j M Y', strtotime($row['tgl_pengajuan']));
            
            // Pengelompokan data berdasarkan status aplikasi di database
            if ($row['status'] === 'pending') {
                $data['menunggu'][] = $row;
            } elseif ($row['status'] === 'approved') {
                $data['disetujui'][] = $row;
            } elseif ($row['status'] === 'rejected') {
                $data['ditolak'][] = $row;
            }
        }
    }

    // Hitung total counter tiap tipe status untuk komponen Badge & Tab angka Navigasi
    $data['count_menunggu']  = count($data['menunggu']);
    $data['count_disetujui'] = count($data['disetujui']);
    $data['count_ditolak']   = count($data['ditolak']);

    return $data;
}