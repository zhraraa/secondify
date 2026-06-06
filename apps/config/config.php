<?php
$lifetime = 86400; //set waktu keseluruhan server bertahan hanya 24 jam saat buka halaman maupun tidak

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params($lifetime);
    ini_set('session.gc_maxlifetime', $lifetime);
    session_start();
}

if (!defined('SECONDIFY')) {
    define('SECONDIFY', 'http://localhost/secondify');
}
?>