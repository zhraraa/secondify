<?php
$lifetime = 60;
session_set_cookie_params($lifetime);
ini_set('session.gc_maxlifetime', $lifetime);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

define('SECONDIFY', 'http://localhost/secondify');
?>
