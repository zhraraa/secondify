<?php
require_once '../auth/auth_check.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/userModel.php';

$id_user = $_SESSION['id_user'];

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

if (isset($_POST['save_privacy'])) {
    updatePrivasiUser(
        $conn,
        $id_user,
        isset($_POST['show_whatsapp']) ? 1 : 0,
        isset($_POST['show_email']) ? 1 : 0,
        isset($_POST['show_tanggal_lahir']) ? 1 : 0,
        isset($_POST['show_transaksi']) ? 1 : 0,
        isset($_POST['allow_tracking']) ? 1 : 0,
        isset($_POST['anonymous_data']) ? 1 : 0
    );

    header("Location: " . SECONDIFY . "/apps/controllers/user/settingController.php?success=savePrivacy#privasi");
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
