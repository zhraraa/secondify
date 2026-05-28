<?php
function getDataUserPesan($conn, $id_produk ,$id_user){
    $query = $conn -> prepare("SELECT DISTINCT u.id_user, u.username, u.nama_lengkap 
                                FROM pesan p
                                JOIN users u ON p.id_pengirim = u.id_user
                                WHERE p.id_produk = ? AND p.id_penerima = ?");
    $query -> bind_param("ii", $id_produk, $id_user);
    $query -> execute();
    $data = $query -> get_result();
    return $data;
}

?>