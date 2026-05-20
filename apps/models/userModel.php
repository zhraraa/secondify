<?php
function getDataUSer($conn, $id_user){
    $query = $conn -> prepare("SELECT * FROM users WHERE id_user = ?");
    $query -> bind_param ("i", $id_user);
    $query -> execute();
    $data = $query -> get_result();
    $dataUser = $data -> fetch_assoc(); 
    
    return $dataUser;
};


function getDataUserbyEmail($conn, $email){
    $query = $conn -> prepare("SELECT id_user, password, role, nama_lengkap FROM users WHERE email = ?");
    $query -> bind_param("s", $email);
    $query -> execute(); 

    $dataUser = $query -> get_result();
    $cek_user = $dataUser -> fetch_assoc();
    return $cek_user;
}

?>