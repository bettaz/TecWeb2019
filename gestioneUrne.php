<?php
session_start(['cookie_lifetime' => 86400]);
if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
	error_log('non auth user trying to access admin, redirected to login');
	header('Location: login.php');
}
require_once 'bin/Connection.php';
$connection = new Connection();
$error = '';

if(isset($_POST['nomeU'])){
	if($_POST['nomeU'] == ''){
		$error = '<div id="errors">Inserire il nome dell\'urna!</div>';
	} else {
		if($_POST['nomeMatU'] == ''){
			$error = '<div id="errors">Inserire il materiale dell\'urna!</div>';
		} else {
			if($_POST['prezzoU'] == ''){
				$error = '<div id="errors">Inserire il prezzo dell\'urna!</div>';
			} else {
				$nomeU = $_POST['nomeU'];
				$materiale = $_POST['nomeMatU'];
				$prezzoU = $_POST['prezzoU'];
				$rows = $connection->Query("SELECT `versione`, `materiale` , `costoBase` FROM `urne` WHERE `versione` = '$nomeU'");
				if($rows->num_rows == 0){
					$res = $connection->Query("INSERT INTO  `urne`(`versione`, `materiale` , `costoBase`) VALUES ('$nomeU', '$materiale', '$prezzoU')");
				} else {
					$res = $connection->Query("UPDATE `urne` SET `costoBase`= '$prezzoU', `materiale`='$materiale' WHERE `versione` = '$nomeU'");
				}
				if($res){
					$error = '<div class="message">Urna inserita correttamente</div>';
				}
				else{
					$error = '<div id="errors">Impossibile inserire l\'urna</div>';
				}
			}
		}
	}
}

$usr_mng_file= fopen('views/gestioneUrne.xhtml','r');
$mng_content = fread($usr_mng_file,filesize('views/gestioneUrne.xhtml'));
fclose($usr_mng_file);
$mng_content = str_replace('<message/>', $error, $mng_content);
echo $mng_content;

