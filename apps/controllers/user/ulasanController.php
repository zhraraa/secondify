<?php
require_once '../auth/auth_check.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';
require_once '../../models/userModel.php';
require_once '../../models/produkModel.php';
require_once '../../models/ulasanModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_review_post = isset($_POST['id_review']) ? (int)$_POST['id_review'] : 0;
    $rating = isset($_POST['ratingValue']) ? (int)$_POST['ratingValue'] : 0;
    $komentar = isset($_POST['teksUlasan']) ? trim($_POST['teksUlasan']) : '';

    if ($id_review_post > 0 && $rating > 0 && strlen($komentar) >= 15) {
        $update = kirimUlasan($conn, $id_review_post, $rating, $komentar);
        
        if ($update) {
            echo "<script>
                alert('Terima kasih! Ulasan berhasil dikirim.');
                window.location.href = '" . SECONDIFY . "/apps/controllers/user/dashboardController.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Gagal mengirim ulasan.');
                window.history.back();
            </script>";
            exit;
        }
    } else {
        echo "<script>
            alert('Pastikan kamu sudah memberikan rating dan ulasan minimal 15 karakter!');
            window.history.back();
        </script>";
        exit;
    }
}

$id_user = $_SESSION['id_user'];
$idreview = isset($_GET['id_review']) ? (int) $_GET['id_review'] : 0;

if ($idreview === 0) {
    echo "<script>alert('ID Ulasan tidak valid!'); window.history.back();</script>";
    exit;
}

$dataUser = getDataUSer($conn, $id_user);
$daftarUlasan = getDataUlasanbyId($conn, $idreview);

require_once '../../views/user/ulasan.php';
?>