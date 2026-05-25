<?php
// controllers/admin/DashboardController.php

require_once '../../../koneksi/koneksi.php';

function getDashboardStats() {
    global $conn; 

    $stats = [];

    // data STAT start
    $queryUser = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
    $stats['totalUser'] = mysqli_fetch_assoc($queryUser)['total'];

    $queryBarang = mysqli_query($conn, "SELECT COUNT(*) as total FROM produk WHERE status = 'available'");
    $stats['totalBarang'] = mysqli_fetch_assoc($queryBarang)['total'];

    $querySeller = mysqli_query($conn, "SELECT COUNT(*) as total FROM seller_application WHERE status = 'pending'");
    $stats['totalPendingSeller'] = mysqli_fetch_assoc($querySeller)['total'];

    $queryLaporan = mysqli_query($conn, "SELECT COUNT(*) as total FROM laporan_barang WHERE status = 'pending'");
    $stats['totalPendingLaporan'] = mysqli_fetch_assoc($queryLaporan)['total'];
    // end

    // data Grafik donut start
    $queryPembeli = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE is_penjual = 0 AND role = 'user'");
    $stats['totalPembeli'] = mysqli_fetch_assoc($queryPembeli)['total'];

    $queryPenjual = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE is_penjual = 1");
    $stats['totalPenjual'] = mysqli_fetch_assoc($queryPenjual)['total'];

    $stats['totalLainnya'] = $stats['totalUser'] - ($stats['totalPembeli'] + $stats['totalPenjual']);

    $kelilingTotal = 289; 
    $totalUserDihitung = $stats['totalUser'] > 0 ? $stats['totalUser'] : 1; 

    $stats['donut']['strokePembeli'] = ($stats['totalPembeli'] / $totalUserDihitung) * $kelilingTotal;
    $stats['donut']['strokePenjual'] = ($stats['totalPenjual'] / $totalUserDihitung) * $kelilingTotal;
    $stats['donut']['strokeLainnya'] = ($stats['totalLainnya'] / $totalUserDihitung) * $kelilingTotal;
    
    $stats['donut']['offsetPenjual'] = -$stats['donut']['strokePembeli'];
    $stats['donut']['offsetLainnya'] = -($stats['donut']['strokePembeli'] + $stats['donut']['strokePenjual']);
    $stats['donut']['kelilingTotal'] = $kelilingTotal;
    // end

    // data grafik bar kategori barang start
    $sqlKategori = "SELECT k.nama_kategori, COUNT(p.id_produk) as jumlah 
                    FROM kategori k 
                    LEFT JOIN produk p ON k.id_kategori = p.id_kategori 
                    GROUP BY k.id_kategori 
                    ORDER BY jumlah DESC 
                    LIMIT 5";
    $queryKat = mysqli_query($conn, $sqlKategori);
    
    $stats['kategori_terpopuler'] = [];
    while ($row = mysqli_fetch_assoc($queryKat)) {
        // --- LOGIC PERSENTASE BAR CSS (Dipindah ke Controller) ---
        $persen = $row['jumlah'] > 100 ? 100 : $row['jumlah'];
        if ($persen == 0) $persen = 5; 
        
        $row['persen_bar'] = $persen;
        $stats['kategori_terpopuler'][] = $row;
    }
    // end
    
    return $stats;
}