<?php
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';

if(isset($_POST['masuk'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $cek_user = $conn -> prepare("SELECT password FROM users WHERE email = ?");
    $cek_user -> bind_param("s", $email);
    $cek_user -> execute(); 

    $cek_user -> store_result();
    if($cek_user -> num_rows > 0){
        $cek_user -> bind_result($hashed_password);
        $cek_user -> fetch();
        if(password_verify($password, $hashed_password)){
            header("Location: " . SECONDIFY . "/apps/views/user/dashboard.php");            
            exit();    
        } else{
            header("Location: " . SECONDIFY . "/index.php?error=loginError");
            exit();
        }
    } else {
        header("Location: " . SECONDIFY . "/index.php?error=loginError");
        exit();
    }


}




?>