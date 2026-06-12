<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';

if(isset($_POST['daftar'])){

    $nama       = trim($_POST['nama']);
    $username   = trim($_POST['username']);
    $email      = trim($_POST['email']);
    $password   = trim($_POST['password']);
    $konfirmasi = trim($_POST['konfirmasi_password']);
    $lokasi     = trim($_POST['lokasi']);

    // Validasi password
    if($password != $konfirmasi){

        echo "
        <script>
            alert('Password dan Konfirmasi Password tidak sama!');
            history.back();
        </script>
        ";
        exit();

    }

    // Cek email
    $cek_email = $conn->prepare(
        "SELECT id_user FROM users WHERE email = ?"
    );

    $cek_email->bind_param("s", $email);
    $cek_email->execute();
    $cek_email->store_result();

    if($cek_email->num_rows > 0){

        echo "
        <script>
            alert('Email sudah digunakan!');
            history.back();
        </script>
        ";
        exit();

    }

    // Cek username
    $cek_username = $conn->prepare(
        "SELECT id_user FROM users WHERE username = ?"
    );

    $cek_username->bind_param("s", $username);
    $cek_username->execute();
    $cek_username->store_result();

    if($cek_username->num_rows > 0){

        echo "
        <script>
            alert('Username sudah digunakan!');
            history.back();
        </script>
        ";
        exit();

    }
    // Password minimal 6 karakter,
// harus ada huruf besar, huruf kecil dan angka

if(
    strlen($password) < 6 ||
    !preg_match('/[A-Z]/', $password) ||
    !preg_match('/[a-z]/', $password) ||
    !preg_match('/[0-9]/', $password)
){

    echo "
    <script>
        alert('Password minimal 6 karakter dan harus mengandung huruf besar, huruf kecil, dan angka!');
        history.back();
    </script>
    ";
    exit();
}
    // Hash password
    $passwordHash = password_hash(
        $password,
        PASSWORD_BCRYPT
    );

    // Simpan user
    $query = $conn->prepare(
        "INSERT INTO users
        (
            nama_lengkap,
            username,
            password,
            email,
            lokasi
        )
        VALUES
        (
            ?, ?, ?, ?, ?
        )"
    );

    $query->bind_param(
        "sssss",
        $nama,
        $username,
        $passwordHash,
        $email,
        $lokasi
    );

    if($query->execute()){

        echo "
        <script>
            alert('Registrasi berhasil!');
            window.location='".SECONDIFY."/index.php';
        </script>
        ";
        exit();

    }else{

        die(
            'MYSQL ERROR : ' .
            $query->error
        );

    }

}
?>