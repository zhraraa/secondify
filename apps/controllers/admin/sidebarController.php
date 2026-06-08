<?php
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

if (isset($conn)) {
    $queryPendingSeller = mysqli_query($conn, "SELECT COUNT(*) as total FROM seller_application WHERE status = 'pending'");
    $rowPendingSeller = mysqli_fetch_assoc($queryPendingSeller);
    $totalPendingSeller = $rowPendingSeller['total'];

    $queryPendingReport = mysqli_query($conn, "
        SELECT (
            (SELECT COUNT(*) FROM laporan_barang WHERE status = 'pending') +
            (SELECT COUNT(*) FROM bantuan WHERE status != 'selesai')
        ) AS total
    ");
    $totalPendingReport = $queryPendingReport ? (int)mysqli_fetch_assoc($queryPendingReport)['total'] : 0;
} else {
    // Fallback jika variabel $conn belum terdefinisi agar tidak memicu error
    $totalPendingSeller = 3;
    $totalPendingReport = 0; // fallback jika $conn belum tersedia
}
?>