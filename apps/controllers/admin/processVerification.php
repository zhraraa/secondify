<?php
// apps/controllers/admin/processVerification.php

require_once '../../../koneksi/koneksi.php';

// Atur header agar merespons dalam format JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data kiriman dari JavaScript Fetch
    $id_pengajuan = isset($_POST['id_pengajuan']) ? intval($_POST['id_pengajuan']) : 0;
    $action       = isset($_POST['action']) ? $_POST['action'] : '';
    $alasan       = isset($_POST['alasan']) ? trim($_POST['alasan']) : null;

    if ($id_pengajuan <= 0 || !in_array($action, ['approve', 'reject'])) {
        echo json_encode(['status' => 'error', 'message' => 'Data input tidak valid.']);
        exit;
    }

    // Mulai Database Transaction biar aman jika salah satu query gagal
    mysqli_begin_transaction($conn);

    try {
        if ($action === 'approve') {
            // 1. Update status di tabel seller_application jadi 'approved'
            $sqlApprove = "UPDATE seller_application SET status = 'approved', alasan_penolakan = NULL WHERE id_pengajuan = $id_pengajuan";
            mysqli_query($conn, $sqlApprove);

            // 2. Ambil id_user terkait dari pengajuan tersebut untuk diubah rolenya
            $queryUser  = mysqli_query($conn, "SELECT id_user FROM seller_application WHERE id_pengajuan = $id_pengajuan");
            $id_user    = mysqli_fetch_assoc($queryUser)['id_user'];

            // 3. Update status user tersebut di tabel users menjadi penjual (is_penjual = 1)
            $sqlUser = "UPDATE users SET is_penjual = 1 WHERE id_user = $id_user";
            mysqli_query($conn, $sqlUser);

            $msg = "Pengajuan toko berhasil disetujui!";
        } else {
            // Jika ditolak, wajib sertakan alasan penolakan
            if (empty($alasan)) {
                echo json_encode(['status' => 'error', 'message' => 'Alasan penolakan wajib diisi.']);
                exit;
            }

            // Update status menjadi 'rejected' dan simpan alasan penolakannya
            $alasan_safe = mysqli_real_escape_string($conn, $alasan);
            $sqlReject   = "UPDATE seller_application SET status = 'rejected', alasan_penolakan = '$alasan_safe' WHERE id_pengajuan = $id_pengajuan";
            mysqli_query($conn, $sqlReject);

            $msg = "Pengajuan toko telah ditolak.";
        }

        // Commit perubahan jika semua query sukses dijalankan
        mysqli_commit($conn);
        echo json_encode(['status' => 'success', 'message' => $msg]);

    } catch (Exception $e) {
        // Rollback database jika terjadi kendala/error SQL
        mysqli_rollback($conn);
        echo json_encode(['status' => 'error', 'message' => 'Gagal memproses data ke database.']);
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Akses ditolak.']);