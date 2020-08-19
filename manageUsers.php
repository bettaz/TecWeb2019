<?php
session_start(['cookie_lifetime' => 86400]);
if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
	error_log('non auth user trying to access admin, redirected to login');
	header('Location: login.php');
}
require_once 'bin/Connection.php';
$connection = new Connection();
$error ='';
if(isset($_POST['passwordAttuale'])) {
	if ($_POST['passwordAttuale'] == '')
		$error = '<div id="errors">Inserire la vecchia password!</div>';
	else{
		if ($_POST['passwordNuova'] == '')
			$error = '<div id="errors">Inserire la nuova password!</div>';
		else{
			if ($_POST['confirmPassword'] == '')
				$error = '<div id="errors">Inserire la conferma password!</div>';
			else {
				if ($_POST['passwordAttuale'] != $connection->escape($_POST['passwordAttuale']))
					$error ='<div id="errors">La vecchia password inserita puo\' violare il database</div>';
				else {
					if ($_POST['passwordNuova'] != $connection->escape
						($_POST['passwordNuova']))
						$error ='<div id="errors">La nuova password inserita puo\' violare il database</div>';
					else{
						if($_POST['passwordNuova']!=$_POST['confirmPassword'])
							$error = '<div id="errors">Le password immesse non coincidono</div>';
						else{
							$username = $_SESSION['user'];
							$password = $connection->escape($_POST['passwordAttuale']);
							$enc_pwd = hash('sha256',$password);
							$res = $connection->Query("SELECT * FROM users WHERE username = '$username' AND enc_password = '$enc_pwd'");
							if($res && $res->num_rows>0){
								$new_enc_pwd = hash('sha256',$_POST['passwordNuova']);
								$res = $connection->Query("UPDATE users SET enc_password='$new_enc_pwd' WHERE username = '$username'");
								if($res)
									$error = '<div class="message">Password modificata correttamente</div>';
								else
									$error = '<div id="errors">Impossibile cambiare la password</div>';
							}
							else
								$error = '<div id="errors">La vecchia password non e\' corretta</div>';
						}
					}
				}
			}
		}
	}
}
$usr_mng_file= fopen('views/gestioneUtenti.xhtml','r');
$mng_content = fread($usr_mng_file,filesize('views/gestioneUtenti.xhtml'));
$mng_content = str_replace('<message/>', $error, $mng_content);
echo $mng_content;
