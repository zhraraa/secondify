<?php
if ($_SESSION['status'] != "login") {
    header("Location: " . SECONDIFY . "index.php?error=harusLogin");
    exit();
}
?>