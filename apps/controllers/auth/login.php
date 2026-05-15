<?php
session_start();
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
$hashed_password = '';

if(isset($_POST['masuk'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $cek_user = $conn -> prepare("SELECT id_user, password, role, nama_lengkap FROM users WHERE email = ?");
    $cek_user -> bind_param("s", $email);
    $cek_user -> execute(); 

    $cek_user -> store_result();
    if($cek_user -> num_rows > 0){
        $cek_user -> bind_result($id_user, $hashed_password, $role, $nama_lengkap);
        $cek_user -> fetch();
        if(password_verify($password, $hashed_password)){
            $_SESSION['id_user'] = $id_user;
            $_SESSION['nama_lengkap'] = $nama_lengkap;
            $_SESSION['role'] = $role;
            $_SESSION['status'] = "login";

            if($role == 'admin'){
                header("Location: " . SECONDIFY . "/apps/views/admin/adminDashboard.php");
                exit();
            } else {
                header("Location: " . SECONDIFY . "/apps/views/user/dashboard.php");            
            }
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