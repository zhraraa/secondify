<?php
function getDataUlasan($conn, $id_penjual){
    $query = $conn->prepare("SELECT 
                                r.rating, 
                                r.komentar, 
                                r.tgl_ulasan,
                                u.nama_lengkap AS nama_pembeli, 
                                p.nama_barang,
                                p.foto_barang
                            FROM reviews r
                            JOIN users u ON r.id_pembeli = u.id_user
                            JOIN produk p ON r.id_produk = p.id_produk
                            WHERE r.id_penjual = ?
                            ORDER BY r.tgl_ulasan DESC");
                            
    $query->bind_param("i", $id_penjual);
    $query->execute();
    
    $result = $query->get_result();
    $daftarUlasan = $result->fetch_all(MYSQLI_ASSOC);
    return $daftarUlasan;
}

function buatKerangkaUlasan($conn, $id_penjual, $id_pembeli, $id_produk) {
    $query = $conn->prepare("INSERT INTO reviews (id_penjual, id_pembeli, id_produk) VALUES (?, ?, ?)");
    $query->bind_param("iii", $id_penjual, $id_pembeli, $id_produk);
    $eksekusi = $query->execute();
    
    return $eksekusi;
}

function getDataUlasanbyId($conn, $id_ulasan){
    $query = $conn->prepare("SELECT 
                                r.*, 
                                p.nama_barang, 
                                p.foto_barang,
                                u.nama_toko 
                            FROM reviews r 
                            JOIN produk p ON r.id_produk = p.id_produk 
                            JOIN users u ON r.id_penjual = u.id_user 
                            WHERE r.id_review = ?");
    $query->bind_param("i", $id_ulasan);
    $query->execute();
    $result = $query->get_result();
    $daftarUlasan = $result->fetch_all(MYSQLI_ASSOC);
    return $daftarUlasan;
}

function getUlasanKosong($conn, $id_pembeli) {
    $query = $conn->prepare("SELECT 
                                r.id_review, 
                                r.id_produk,
                                r.tgl_ulasan,
                                p.nama_barang, 
                                p.foto_barang,
                                u.nama_toko AS nama_penjual
                            FROM reviews r
                            JOIN produk p ON r.id_produk = p.id_produk
                            JOIN users u ON r.id_penjual = u.id_user
                            WHERE r.id_pembeli = ? AND r.rating IS NULL
                            ORDER BY r.tgl_ulasan DESC");
                            
    $query->bind_param("i", $id_pembeli);
    $query->execute();
    
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function kirimUlasan($conn, $id_review, $rating, $komentar){
    $query = $conn->prepare("UPDATE reviews SET rating = ?, komentar = ?, tgl_ulasan = NOW() WHERE id_review = ?");
    $query->bind_param("isi", $rating, $komentar, $id_review);
    return $query->execute();
}

?>