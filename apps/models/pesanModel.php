<?php
function getDataUserPesan($conn, $id_produk){
    $query = $conn -> prepare("SELECT DISTINCT u.id_user AS id_pembeli, u.username AS usename_pembeli, u.nama_lengkap AS pembeli
                                FROM pesan p
                                JOIN users u ON p.id_pengirim = u.id_user
                                WHERE p.id_produk = ?;");
    $query -> bind_param("i", $id_produk);
    $query -> execute();
    $data = $query -> get_result();
    return $data->fetch_all(MYSQLI_ASSOC);
}

?>