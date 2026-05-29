<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/secondify/koneksi/koneksi.php';

/**
 * FUNGSI AMBIL DATA GABUNGAN
 * FIX: status laporan_barang pakai 'pending'/'resolved' sesuai skema DB
 * FIX: status bantuan pakai 'menunggu'/'selesai' sesuai skema DB
 */
function getLaporanByStatus($status) {
    global $conn;

    if ($status === 'selesai') {
        $kondisiBarang  = "l.status = 'resolved'";   // FIX: bukan 'selesai'
        $kondisiBantuan = "b.status = 'selesai'";
    } else {
        $kondisiBarang  = "l.status = 'pending'";     // FIX: bukan != 'selesai'
        $kondisiBantuan = "b.status != 'selesai'";
    }

    $sql = "
        SELECT 
            'barang' AS tipe_laporan,
            l.id_laporan AS id_utama,
            CONCAT('[Melaporkan ', IFNULL(pr.nama_barang, 'Produk Terhapus'), '] ', l.alasan) AS deskripsi,
            l.tgl_lapor AS tanggal,
            IFNULL(p.nama_lengkap, 'User') AS nama_pelapor,
            IFNULL(t.nama_lengkap, 'Toko Penjual') AS nama_terlapor,
            t.id_user AS id_user_terlapor
        FROM laporan_barang l
        LEFT JOIN users p   ON l.id_pelapor = p.id_user
        LEFT JOIN produk pr ON l.id_target_produk = pr.id_produk
        LEFT JOIN users t   ON pr.id_user = t.id_user
        WHERE $kondisiBarang

        UNION ALL

        SELECT 
            'bantuan' AS tipe_laporan,
            b.id_bantuan AS id_utama,
            CONCAT('[', b.topik, '] ', b.pesan) AS deskripsi,
            b.created_at AS tanggal,
            IFNULL(p.nama_lengkap, 'User') AS nama_pelapor,
            'Customer Support (Admin)' AS nama_terlapor,
            NULL AS id_user_terlapor
        FROM bantuan b
        LEFT JOIN users p ON b.id_user = p.id_user
        WHERE $kondisiBantuan

        ORDER BY tanggal DESC
    ";

    $query  = mysqli_query($conn, $sql);
    $result = [];
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }
    return $result;
}

/**
 * PROSES AKSI (form POST biasa, bukan AJAX)
 * FIX: pakai prepared statement (anti SQL injection)
 * FIX: bekukan akun → update is_active = 0 (bukan status_akun)
 * FIX: turunkan barang → update produk.status = 'sold' (nilai ENUM valid)
 * FIX: laporan selesai → update status = 'resolved' (bukan 'selesai')
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_utama'])) {
    global $conn;

    $id_utama       = trim($_POST['id_utama'] ?? '');
    $tipe           = trim($_POST['tipe_laporan'] ?? '');
    $jenis_tindakan = trim($_POST['jenis_tindakan'] ?? 'turunkan');
    $balasan_admin  = trim($_POST['balasan_admin'] ?? '');

    // Tentukan URL redirect balik ke halaman moderasi
    $redirect = $_SERVER['HTTP_REFERER'] ?? '../../views/admin/moderasi.php';

    // Validasi id harus angka
    if (!ctype_digit($id_utama)) {
        $_SESSION['flash'] = 'ID tidak valid.';
        header("Location: $redirect");
        exit;
    }

    /* ── TIPE: BARANG ───────────────────────────────────────── */
    if ($tipe === 'barang') {

        $stmt = mysqli_prepare($conn,
            "SELECT pr.id_user, pr.id_produk
             FROM laporan_barang l
             LEFT JOIN produk pr ON l.id_target_produk = pr.id_produk
             WHERE l.id_laporan = ?"
        );
        mysqli_stmt_bind_param($stmt, 'i', $id_utama);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $data             = mysqli_fetch_assoc($result);
            $id_user_terlapor = $data['id_user'];
            $id_produk        = $data['id_produk'];

            if ($jenis_tindakan === 'bekukan' && !empty($id_user_terlapor)) {
                // FIX: kolom yang benar adalah is_active, bukan status_akun
                $s = mysqli_prepare($conn, "UPDATE users SET is_active = 0 WHERE id_user = ?");
                mysqli_stmt_bind_param($s, 'i', $id_user_terlapor);
                mysqli_stmt_execute($s);

            } elseif ($jenis_tindakan === 'turunkan' && !empty($id_produk)) {
                // FIX: ENUM produk.status hanya 'available'/'sold' — pakai 'sold'
                $s = mysqli_prepare($conn, "UPDATE produk SET status = 'sold' WHERE id_produk = ?");
                mysqli_stmt_bind_param($s, 'i', $id_produk);
                mysqli_stmt_execute($s);
            }
            // opsi 'peringatan' → tidak ada aksi ke user/produk, cukup selesaikan laporan

            // FIX: status laporan_barang pakai 'resolved'
            $s = mysqli_prepare($conn, "UPDATE laporan_barang SET status = 'resolved' WHERE id_laporan = ?");
            mysqli_stmt_bind_param($s, 'i', $id_utama);
            mysqli_stmt_execute($s);

            $_SESSION['flash'] = 'Laporan berhasil ditangani!';
        } else {
            $_SESSION['flash'] = 'Data laporan tidak ditemukan.';
        }

    /* ── TIPE: BANTUAN ──────────────────────────────────────── */
    } elseif ($tipe === 'bantuan') {

        if (empty($balasan_admin)) {
            $_SESSION['flash'] = 'Balasan admin tidak boleh kosong!';
            header("Location: $redirect");
            exit;
        }

        $stmtAmbil = mysqli_prepare($conn, "SELECT pesan FROM bantuan WHERE id_bantuan = ?");
        mysqli_stmt_bind_param($stmtAmbil, 'i', $id_utama);
        mysqli_stmt_execute($stmtAmbil);
        $res = mysqli_stmt_get_result($stmtAmbil);

        if ($res && mysqli_num_rows($res) > 0) {
            $row       = mysqli_fetch_assoc($res);
            $pesanBaru = $row['pesan'] . " | JAWABAN ADMIN: " . $balasan_admin;

            $stmtUp = mysqli_prepare($conn,
                "UPDATE bantuan SET status = 'selesai', pesan = ? WHERE id_bantuan = ?"
            );
            mysqli_stmt_bind_param($stmtUp, 'si', $pesanBaru, $id_utama);
            mysqli_stmt_execute($stmtUp);

            $_SESSION['flash'] = 'Tiket berhasil dibalas dan diselesaikan!';
        } else {
            $_SESSION['flash'] = 'Data tiket tidak ditemukan.';
        }

    } else {
        $_SESSION['flash'] = 'Tipe laporan tidak dikenal.';
    }

    header("Location: $redirect");
    exit;
}