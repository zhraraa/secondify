<?php
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/userModel.php';
$hashed_password = '';

if(isset($_POST['masuk'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $cek_user = getDataUserbyEmail($conn, $email);

    if($cek_user){
        $id_user = $cek_user['id_user'];
        $nama_lengkap = $cek_user['nama_lengkap'];
        $role = $cek_user['role'];
        $hashed_password = $cek_user['password'];        
    
        if(password_verify($password, $hashed_password)){
            $_SESSION['id_user'] = $id_user;
            $_SESSION['nama_lengkap'] = $nama_lengkap;
            $_SESSION['role'] = $role;
            $_SESSION['status'] = "login";
            // if waktu udah lewat dari 1 jam maka status = belumLogin, else status = login

            if($_SESSION['status'] === 'login'){
                if($role == 'admin'){
                    header("Location: " . SECONDIFY . "/apps/views/admin/adminDashboard.php");
                    exit();
                } else {
                    header("Location: " . SECONDIFY . "/apps/controllers/user/dashboardController.php");            
                    exit();
                }
            }    
        } else {
            header("Location: " . SECONDIFY . "/index.php?error=loginError");
            exit();
        }

                
    } else{
        header("Location: " . SECONDIFY . "/index.php?error=loginError");
        exit();
    }

}

?>
