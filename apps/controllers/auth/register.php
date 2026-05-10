<?php
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';


if(isset($_POST['daftar'])){
    $nama = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash( trim($_POST['password']), PASSWORD_BCRYPT);
    $lokasi = trim($_POST['lokasi']);
    
    $cek_user = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $cek_user->bind_param("s", $email);
    $cek_user->execute();

    $cek_user->store_result();
    if($cek_user->num_rows > 0){
        echo "email udh ada, ganti email";
    } else {
        $query = $conn->prepare("INSERT INTO `users`(`nama_lengkap`, `password`, `email`, `username`, `lokasi`) VALUES (?,?,?,?,?)");
        $query->bind_param("sssss", $nama, $password, $email, $username, $lokasi);
        $query->execute();
        header("Location: " . SECONDIFY . "/index.php");
        exit();
    }
}

?>