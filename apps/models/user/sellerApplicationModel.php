<?php
function getPengajuanPenjual($conn, $id_user){
    $cek_status_query = "SELECT status FROM seller_application WHERE id_user = ?";
    $cek_status_stmt = $conn -> prepare($cek_status_query);
    $cek_status_stmt -> bind_param("i", $id_user);
    $cek_status_stmt -> execute();
    $hasil = $cek_status_stmt -> get_result();
    $row = $hasil -> fetch_assoc();

    return $row;
}

?>