<?php
require 'bin/Connection.php';
$connection = new Connection();
if(isset($_SESSION['logged']) && $_SESSION['logged']=='logged')
	header('admin.php');
if(!isset($_POST['password']) || $_POST['password']=='')
	$error = '<div class="error">Inserire la password!</div>';
if(isset($_POST['password'])&& isset($_POST['uname']) && $_POST['uname']=='')
		$error = '<div class="error">Inserire lo username!</div>';
if(isset($_POST['password'])&&$_POST['password'] != $connection->escape($_POST['password']))
	$error = '<div class="error">La password inserita puo\' violare il database</div>';
if(isset($_POST['uname'])&&$_POST['uname'] != $connection->escape($_POST['uname']))
	$error = '<div class="error">Lo username inserito puo\' violare il database</div>';
try {
	$file = fopen('views/login.xhtml','r');
	$content = fread($file,filesize('views/login.xhtml'));
	$loginpage = str_replace('<error/>',isset($error)?$error:'',$content);
	$loginpage = str_replace('<olduname/>',isset($_POST['uname'])?$_POST['uname']:'',$loginpage);
	echo $loginpage;
} catch (Throwable $error){
	die($error);
}
