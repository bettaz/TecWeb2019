<?php
session_start(['cookie_lifetime' => 86400]);
require_once 'bin/Connection.php';
$connection = new Connection();
if(isset($_POST['uname'])) {
	if ($_POST['uname'] == '')
		$error = '<div id="errors">Inserire lo username!</div>';
	else{
		if ($_POST['password'] == '')
			$error = '<div id="errors">Inserire la password!</div>';
		else{
			if ($_POST['uname'] != $connection->escape($_POST['uname']))
				$error ='<div id="errors">Lo username inserito puo\' violare il database</div>';
			else {
				if ($_POST['password'] != $connection->escape($_POST['password']))
					$error ='<div id="errors">La password inserita puo\' violare il database</div>';
				else{
					$username = $connection->escape($_POST['uname']);
					$password = $connection->escape($_POST['password']);
					$enc_pwd = hash('sha256',$password);
					$res = $connection->Query("SELECT * FROM users WHERE username = '$username' AND enc_password = '$enc_pwd'");
					if($res && $res->num_rows>0){
						$_SESSION['user'] = $username;
						$_SESSION['logged'] = true;
					}
					else {
						$_SESSION['logged'] = false;
						$error = '<div id="errors">Log-in non corretto</div>';
					}
				}
			}
		}
	}
}
if(isset($_SESSION['logged']) && $_SESSION['logged']){
	header('Location: admin.php');
	error_log('redirect to admin');
}
try {
	$file = fopen('views/login.xhtml','r');
	$content = fread($file,filesize('views/login.xhtml'));
	fclose($file);
	$loginpage_errored = str_replace('<error/>',isset($error)?$error:'',
		$content);
	$loginpage = str_replace('<olduname/>',isset($_POST['uname'])?$_POST['uname']:'',$loginpage_errored);
	echo $loginpage;
} catch (Throwable $error){
	die($error);
}
