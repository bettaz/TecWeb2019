<?php
session_start(['cookie_lifetime' => 86400]);
if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
	error_log('non auth user trying to access admin, redirected to login');
	header('Location: login.php');
}
require_once 'bin/Connection.php';
$connection = new Connection();
$error = '';

if(isset($_POST['tipolog'])){
	if($_POST['tipolog'] == ''){
		$error = '<div id="errors">Inserire i dettagli del tipo di cerimonia!</div>';
	} else {
		if($_POST['prezzoC'] == ''){
			$error = '<div id="errors">Inserire il prezzo della cerimonia!</div>';
		} else {
			$tipo = $connection->escape($_POST['tipolog']);
			$prezzoC = $connection->escape($_POST['prezzoC']);
			$rows = $connection->Query("SELECT `tipologia`, `costoBase` FROM `cerimonie` WHERE `tipologia` = '$tipo'");
			if($rows->num_rows == 0){
				$res = $connection->Query("INSERT INTO  `cerimonie`(`tipologia`, `costoBase`) VALUES ('$tipo', '$prezzoC')");
			} else {
				$res = $connection->Query("UPDATE `cerimonie` SET `costoBase`= '$prezzoC' WHERE `tipologia` = '$tipo'");
			}
			if($res){
				$error = '<div class="message">Cerimonia inserita correttamente</div>';
			}
			else{
				$error = '<div id="errors">Impossibile inserire la cerimonia</div>';
			}
		}
	}
}

$usr_mng_file= fopen('views/gestioneCerimonia.xhtml','r');
$mng_content = fread($usr_mng_file,filesize('views/gestioneCerimonia.xhtml'));
fclose($usr_mng_file);
$mng_content = str_replace('<message/>', $error, $mng_content);
echo $mng_content;

