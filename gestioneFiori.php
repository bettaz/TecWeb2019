<?php
session_start(['cookie_lifetime' => 86400]);
if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
	error_log('non auth user trying to access admin, redirected to login');
	header('Location: login.php');
}
require_once 'bin/Connection.php';
$connection = new Connection();
$error = '';

# TODO controllare

if(isset($_POST['nomeF'])){
	if($_POST['nomeF'] == ''){
		$error = '<div id="errors">Inserire il nome della composizione!</div>';
	} else {
		if($_POST['prezzoF'] == ''){
			$error = '<div id="errors">Inserire il prezzo della composizione!</div>';
		} else {
			$nomeF = $_POST['nomeF'];
			$prezzoF = $_POST['prezzoF'];
			$rows = $connection->Query("SELECT `nome`, `costoBase` FROM `composizioni` WHERE `nome` = '$nomeF'");
			if($rows->num_rows == 0){
				$res = $connection->Query("INSERT INTO  `composizioni`(`nome`, `costoBase`) VALUES ('$nomeF', '$prezzoF')");
			} else {
				$res = $connection->Query("UPDATE `composizioni` SET `costoBase`= '$prezzoF' WHERE `nome` = '$nomeF'");
			}
			if($res){
				$error = '<div class="message">Composizione inserita correttamente</div>';
			}
			else{
				$error = '<div id="errors">Impossibile inserire la composizione</div>';
			}
		}
	}
}

$usr_mng_file= fopen('views/gestioneFiori.xhtml','r');
$mng_content = fread($usr_mng_file,filesize('views/gestioneFiori.xhtml'));
$mng_content = str_replace('<message/>', $error, $mng_content);
echo $mng_content;

