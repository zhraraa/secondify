<?php
function getDataUSer($conn, $id_user){
    $query = $conn -> prepare("SELECT * FROM users WHERE id_user = ?");
    $query -> bind_param ("i", $id_user);
    $query -> execute();
    $data = $query -> get_result();
    $dataUser = $data -> fetch_assoc(); 
    
    return $dataUser;
};

function getIdUserByUsername($conn, $username) {
    $query = $conn->prepare("SELECT id_user FROM users WHERE username = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();
    
    if ($row = $result->fetch_assoc()) {
        return $row['id_user'];
    }
}

function getDataUserbyEmail($conn, $email){
    $query = $conn -> prepare("SELECT id_user, password, role, nama_lengkap, status_akun FROM users WHERE email = ?");
    $query -> bind_param("s", $email);
    $query -> execute(); 

    $dataUser = $query -> get_result();
    $cek_user = $dataUser -> fetch_assoc();
    return $cek_user;
}

function updateProfilUser($conn, $id_user, $nama, $username, $email, $no_hp, $jenis_kelamin, $tanggal_lahir, $bio){
    $query = $conn -> prepare("
        UPDATE users SET
            nama_lengkap = ?,
            username = ?,
            email = ?,
            no_hp = ?,
            jenis_kelamin = ?,
            tanggal_lahir = ?,
            bio = ?
        WHERE id_user = ?
    ");
    $query -> bind_param("sssssssi", $nama, $username, $email, $no_hp, $jenis_kelamin, $tanggal_lahir, $bio, $id_user);
    return $query -> execute();
}

function updatePasswordUser($conn, $id_user, $password_baru){
    $hashPassword = password_hash($password_baru, PASSWORD_DEFAULT);
    $query = $conn -> prepare("UPDATE users SET password = ? WHERE id_user = ?");
    $query -> bind_param("si", $hashPassword, $id_user);
    return $query -> execute();
}

function updatePrivasiUser($conn, $id_user, $show_whatsapp, $show_email, $show_tanggal_lahir, $show_transaksi, $allow_tracking, $anonymous_data){
    $query = $conn -> prepare("
        UPDATE users SET
            show_whatsapp = ?,
            show_email = ?,
            show_tanggal_lahir = ?,
            show_transaksi = ?,
            allow_tracking = ?,
            anonymous_data = ?
        WHERE id_user = ?
    ");
    $query -> bind_param("iiiiiii", $show_whatsapp, $show_email, $show_tanggal_lahir, $show_transaksi, $allow_tracking, $anonymous_data, $id_user);
    return $query -> execute();
}

function simpanBantuanUser($conn, $id_user, $topik, $pesan){
    $query = $conn -> prepare("
        INSERT INTO bantuan (id_user, topik, pesan)
        VALUES (?, ?, ?)
    ");
    $query -> bind_param("iss", $id_user, $topik, $pesan);
    return $query -> execute();
}

function updateFotoProfil($conn, $id_user, $nama_file) {
    $query = $conn->prepare("UPDATE users SET profile_pict = ? WHERE id_user = ?");
    $query->bind_param("si", $nama_file, $id_user);
    return $query->execute();
}

function getAllFaq($conn)
{
    $query = mysqli_query($conn, "
        SELECT *
        FROM faq
        WHERE is_active = 1
        ORDER BY urutan ASC
    ");

    return $query;
}

?>
