<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "CONTROLLER JALAN <br>";

require_once '../../../koneksi/koneksi.php';

echo "KONEKSI OK <br>";

require_once '../../config/config.php';

echo "CONFIG OK <br>";

if(isset($_POST['daftar'])){
    echo "POST MASUK <br>";
}else{
    echo "POST TIDAK MASUK <br>";
}
?>