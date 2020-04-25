<?php
@session_start();
@ob_start();
@session_destroy();
unset($_SESSION['k_adi']);
unset($_SESSION['sifre']);
unset($_SESSION['login']);
echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=../index.php">';
?>