<?php
session_start(['cookie_lifetime' => 86400]);
if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
	error_log('non auth user trying to access admin, redirected to login');
	header('Location: login.php');
}

$usr_mng_file= fopen('views/gestionePreventivatore.xhtml','r');
$mng_content = fread($usr_mng_file,filesize('views/gestionePreventivatore.xhtml'));
fclose($mng_content);
echo $mng_content;