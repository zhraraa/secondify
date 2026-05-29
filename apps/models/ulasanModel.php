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

?>