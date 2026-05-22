<?php
$lifetime = 60;

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params($lifetime);
    ini_set('session.gc_maxlifetime', $lifetime);
    session_start();
}

if (!defined('SECONDIFY')) {
    define('SECONDIFY', 'http://localhost/secondify');
}
?>
