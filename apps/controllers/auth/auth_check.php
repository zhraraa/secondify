<?php
require_once '../../config/config.php';
require_once '../../models/userModel.php'; 
require_once '../../../koneksi/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: " . SECONDIFY . "/index.php?error=harusLogin");
    exit();
}

$id_user = $_SESSION['id_user'];
$dataUser = getDataUser($conn, $id_user); 

?>
