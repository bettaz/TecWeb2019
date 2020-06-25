<?php
session_start(['cookie_lifetime' => 86400]);
if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
	error_log('user non auth trying to access admin, redirected to login');
	header('Location: login.php');
}

$usr_mng_file= fopen('views/gestioneUtenti.xhtml','r');
$mng_content = fread($usr_mng_file,filesize('views/gestioneUtenti.xhtml'));
echo $mng_content;
