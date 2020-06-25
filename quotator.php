<?php
session_start(['cookie_lifetime' => 86400]);
if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
	error_log('non auth user trying to access admin, redirected to login');
	header('Location: login.php');
}
$quot_file = fopen('./views/preventivatore.xhtml','r');
$quot_content = fread($quot_file,filesize('./views/preventivatore.xhtml'));
echo $quot_content;
