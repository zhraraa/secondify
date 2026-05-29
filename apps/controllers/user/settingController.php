<?php
require_once '../auth/auth_check.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/userModel.php';

$id_user = $_SESSION['id_user'];
$dataFaq = getAllFaq($conn);

if (isset($_POST['ubah_foto'])) {
    $file = $_FILES['foto_profil'];
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    $maxSize = 2 * 1024 * 1024; 

    if (!in_array($file['type'], $allowedTypes)) {
        header("Location: " . SECONDIFY . "/apps/controllers/user/settingController.php?error=formatFoto#edit-profil");
        exit();
    }
    if ($file['size'] > $maxSize) {
        header("Location: " . SECONDIFY . "/apps/controllers/user/settingController.php?error=ukuranFoto#edit-profil");
        exit();
    }

    // Hapus foto lama 
    $userNow = getDataUSer($conn, $id_user);
    $fotoLama = $userNow['profile_pict'];
    $pathLama = $_SERVER['DOCUMENT_ROOT'] . '/secondify/assets/images/' . $fotoLama;
    if ($fotoLama && $fotoLama !== 'default.png' && file_exists($pathLama)) {
        unlink($pathLama);
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $namaFile = 'user_' . $id_user . '_' . time() . '.' . $ext;
    $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/secondify/assets/images/' . $namaFile;

    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        updateFotoProfil($conn, $id_user, $namaFile);
        header("Location: " . SECONDIFY . "/apps/controllers/user/settingController.php?success=ubahFoto#edit-profil");
    } else {
        header("Location: " . SECONDIFY . "/apps/controllers/user/settingController.php?error=uploadGagal#edit-profil");
    }
    exit();
}

if (isset($_POST['simpan_profil'])) {
    updateProfilUser(
        $conn,
        $id_user,
        $_POST['nama_lengkap'],
        $_POST['username'],
        $_POST['email'],
        $_POST['no_hp'],
        $_POST['jenis_kelamin'],
        $_POST['tanggal_lahir'],
        $_POST['bio']
    );

    header("Location: " . SECONDIFY . "/apps/controllers/user/settingController.php?success=editProfil");
    exit();
}

if (isset($_POST['ubah_password'])) {
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi = $_POST['konfirmasi_password'];

    $userPassword = getDataUSer($conn, $id_user);

    if (!password_verify($password_lama, $userPassword['password'])) {
        header("Location: " . SECONDIFY . "/apps/controllers/user/settingController.php?error=passwordLama#keamanan");
        exit();
    }

    if ($password_baru !== $konfirmasi) {
        header("Location: " . SECONDIFY . "/apps/controllers/user/settingController.php?error=konfirmasiPassword#keamanan");
        exit();
    }

    if (strlen($password_baru) < 8) {
        header("Location: " . SECONDIFY . "/apps/controllers/user/settingController.php?error=passwordPendek#keamanan");
        exit();
    }

    updatePasswordUser($conn, $id_user, $password_baru);
    header("Location: " . SECONDIFY . "/apps/controllers/user/settingController.php?success=ubahPassword#keamanan");
    exit();
}

if (isset($_POST['kirim_bantuan'])) {
    simpanBantuanUser($conn, $id_user, $_POST['topik'], $_POST['pesan']);

    header("Location: " . SECONDIFY . "/apps/controllers/user/settingController.php?success=kirimBantuan#bantuan");
    exit();
}

$user = getDataUSer($conn, $id_user);

require_once '../../views/user/setting.php';
?>
