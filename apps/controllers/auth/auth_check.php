<?php
require_once '../../config/config.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: " . SECONDIFY . "/index.php?error=harusLogin");
    exit();
}
?>
