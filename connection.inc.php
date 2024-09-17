<?php
session_start();
$con = mysqli_connect("localhost", "u922309690_root", "Webprodavnica-1", "u922309690_webprodavnica");

// Adjust SERVER_PATH and SITE_PATH to match the actual server structure
define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'].'/web-prodavnica/');
define('SITE_PATH', 'https://web-prodavnica.milossturanovic.com/');

define('PRODUCT_IMAGE_SERVER_PATH', SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH', SITE_PATH.'media/product/');
?>
