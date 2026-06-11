<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';

if(isset($_POST['daftar'])){

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $nama       = trim($_POST['nama']);
    $username   = trim($_POST['username']);
    $email      = trim($_POST['email']);
    $password   = trim($_POST['password']);
    $konfirmasi = trim($_POST['konfirmasi_password']);
    $lokasi     = trim($_POST['lokasi']);

    echo "LEWAT AMBIL DATA<br>";

    if($password != $konfirmasi){
        die("PASSWORD TIDAK SAMA");
    }

    echo "LEWAT VALIDASI PASSWORD<br>";

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $query = $conn->prepare("
        INSERT INTO users
        (nama_lengkap,username,password,email,lokasi)
        VALUES (?,?,?,?,?)
    ");

    if(!$query){
        die("PREPARE ERROR : " . $conn->error);
    }

    echo "PREPARE BERHASIL<br>";

    $query->bind_param(
        "sssss",
        $nama,
        $username,
        $passwordHash,
        $email,
        $lokasi
    );

    echo "BIND BERHASIL<br>";

    if($query->execute()){
        echo "REGISTER BERHASIL";
    }else{
        die("EXECUTE ERROR : " . $query->error);
    }

    exit;
}