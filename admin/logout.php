<?php

// komanda za izlogovanje iz admin dijela
session_start();
unset($_SESSION['ADMIN_LOGIN']);
unset($_SESSION['ADMIN_USERNAME']);
header('location:login.php');
die();
?>