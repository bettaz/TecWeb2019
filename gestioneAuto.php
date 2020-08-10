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

if(isset($_POST['nomeMarca'])){
	if($_POST['nomeMarca'] == ''){
		$error = '<div class="error">Inserire il nome della marca dell\'auto!</div>';
	} else {
		if($_POST['nomeModello'] == ''){
			$error = '<div class="error">Inserire il nome del modello dell\'auto!</div>';
		} else {
			if($_POST['prezzoA'] == ''){
				$error = '<div class="error">Inserire il prezzo dell\'utilizzo dell\'auto!</div>';
			} else {
				if($_POST['cilindr'] == ''){
					$error = '<div class="error">Inserire il prezzo dell\'utilizzo dell\'auto!</div>';
				} else {
					$marca = $_POST['nomeMarca'];
					$modello = $_POST['nomeModello'];
					$prezzoA = $_POST['prezzoA'];
					$cilindrata = $_POST['cilindr'];
					$rows = $connection->Query("SELECT `marca`, `modello`, `costoBase`, `cilindrata` FROM `auto` WHERE `marca` = '$marca' AND  `modello` = '$modello'");
					if($rows->num_rows == 0){
						$res = $connection->Query("INSERT INTO `auto`(`marca`, `modello`, `costoBase`, `cilindrata`) VALUES ('$marca', '$modello', '$prezzoA', '$cilindrata')");
					} else {
						$res = $connection->Query("UPDATE `auto` SET `costoBase`= '$prezzoA',`cilindrata`= '$cilindrata' WHERE `marca` = '$marca' AND  `modello` = '$modello'");
					}
					if($res){
						$error = '<div class="message">Auto inserita correttamente</div>';
					}
					else{
						$error = '<div class="error">Impossibile inserire l\'auto</div>';
					}
				}
			}
		}
	}
}

$usr_mng_file= fopen('views/gestioneAuto.xhtml','r');
$mng_content = fread($usr_mng_file,filesize('views/gestioneAuto.xhtml'));
$mng_content = str_replace('<message/>', $error, $mng_content);
echo $mng_content;
