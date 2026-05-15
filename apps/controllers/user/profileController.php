<?php
session_start();

require_once '../auth/auth_check.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../config/config.php';

$id_user = $_SESSION['id_user'];
$data = mysqli_query($conn, "SELECT * FROM users WHERE id_user = $id_user");
$row = mysqli_fetch_assoc($data);

require_once '../../views/user/profile.php';
?>
