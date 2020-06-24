<?php
session_start(['cookie_lifetime' => 86400]);
require_once 'bin/Connection.php';
$connection = new Connection();

if(isset($_POST['uname'])){
	if(!isset($_POST['password']))
		$error = '<div class="error">Inserire la password!</div>';
	else{
		if(isset($_POST['uname']) && $_POST['uname'] != $connection->escape
			($_POST['uname']))
			$error = '<div class="error">Lo username inserito puo\' violare il database</div>';
		else{
			if(isset($_POST['password']) && $_POST['password'] !=
				$connection->escape($_POST['password']))
				$error = '<div class="error">La password inserita puo\' violare il database</div>';
			else{
				$username = $connection->escape($_POST['uname']);
				$password = $connection->escape($_POST['password']);
				$res = $connection->Query("SELECT * FROM users WHERE username = '$username'");
				//TODO add password hash check
				if($res)
					$_SESSION['logged'] = true;
				else
					$_SESSION['logged'] = false;
			}
		}
	}
}
else{
	if(isset($_POST['password'])){
		$error = '<div class="error">Inserire lo username!</div>';
	}
	else{
		$error ='';
	}
}

if(isset($_SESSION['logged']) && $_SESSION['logged']){
	header('Location: admin.php');
	error_log('redirect to admin');
}
try {
	if(!isset($error)){
		$error = 'log-in invalido';
		error_log($error);
	}
	$file = fopen('views/login.xhtml','r');
	$content = fread($file,filesize('views/login.xhtml'));
	$loginpage_errored = str_replace('<error/>',isset($error)?$error:'',
		$content);
	$loginpage = str_replace('<olduname/>',isset($_POST['uname'])?$_POST['uname']:'',$loginpage_errored);
	echo $loginpage;
} catch (Throwable $error){
	die($error);
}
