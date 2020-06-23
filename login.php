<?php
session_start(['cookie_lifetime' => 86400]);
require_once 'bin/Connection.php';
$connection = new Connection();
if(!isset($_POST['uname']) || $_POST['uname']=='')
	$error = '<div class="error">Inserire lo username!</div>';
else{
	if(!isset($_POST['password']) || $_POST['password']=='')
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
				echo "righe: ".($res?"true":"false");
				if($res)
					$_SESSION['logged'] = true;
				else
					$_SESSION['logged'] = false;
			}
		}
		
	}
}

if(isset($_SESSION['logged']) && $_SESSION['logged'])
	header('Location: admin.php');
try {
	if(!isset($error))
		$error = 'log-in invalido';
	$file = fopen('views/login.xhtml','r');
	$content = fread($file,filesize('views/login.xhtml'));
	$loginpage_errored = str_replace('<error/>',isset($error)?$error:'',
		$content);
	$loginpage = str_replace('<olduname/>',isset($_POST['uname'])?$_POST['uname']:'',$loginpage_errored);
	echo $loginpage;
} catch (Throwable $error){
	die($error);
}
