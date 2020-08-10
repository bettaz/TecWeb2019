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

if(isset($_POST['nomeB'])){
	if($_POST['nomeB'] == ''){
		$error = '<div class="error">Inserire il nome della bara!</div>';
	} else {
		if($_POST['nomeMatB'] == ''){
			$error = '<div class="error">Inserire il materiale della bara!</div>';
		} else {
			if($_POST['prezzoB'] == ''){
				$error = '<div class="error">Inserire il prezzo della bara!</div>';
			} else {
				$nomeB = $_POST['nomeB'];
				$materiale = $_POST['nomeMatB'];
				$prezzoB = $_POST['prezzoB'];
				$rows = $connection->Query("SELECT `versione`, `materiale` , `costoBase` FROM `bare` WHERE `versione` = '$nomeB'");
				if($rows->num_rows == 0){
					$res = $connection->Query("INSERT INTO  `bare`(`versione`, `materiale` , `costoBase`) VALUES ('$nomeB', '$materiale', '$prezzoB')");
				} else {
					$res = $connection->Query("UPDATE `bare` SET `costoBase`= '$prezzoB', `materiale`='$materiale' WHERE `versione` = '$nomeB'");
				}
				if($res){
					$error = '<div class="message">Bara inserita correttamente</div>';
				}
				else{
					$error = '<div class="error">Impossibile inserire la bara</div>';
				}
			}
		}
	}
}

$usr_mng_file= fopen('views/gestioneBare.xhtml','r');
$mng_content = fread($usr_mng_file,filesize('views/gestioneBare.xhtml'));
$mng_content = str_replace('<message/>', $error, $mng_content);
echo $mng_content;

