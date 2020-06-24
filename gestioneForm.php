<?php
session_start(['cookie_lifetime' => 86400]);
if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
	error_log('user non auth trying to access admin, redirected to login');
	header('Location: login.php');
}
if(isset($_POST['tipoAddP'])){
	// TODO insert checks and add record to the table
	echo '';
}
if(isset($_POST['nomeRemoveP'])){
	// TODO remove the product
	echo '';
}
require_once 'bin/Connection.php';
$connection = new Connection();
$car_res = $connection->Query("SELECT * FROM auto");
$coffin_res = $connection->Query("SELECT * FROM bare");
$urn_res = $connection->Query("SELECT * FROM urne");
$flower_res = $connection->Query("SELECT * FROM composizioni");
$funeral_res = $connection->Query("SELECT * FROM cerimonie");
$option_list = '';
while ($row = $car_res->fetch_assoc()){
	$option_list .= "<option value=\"0-".$row['id']."\">".sprintf("auto %s - %s - %d cc", $row['marca'],$row['modello'],$row['cilindrata'])."</option>";
}
while ($row = $coffin_res->fetch_assoc()){
	$option_list .= "<option value=\"1-".$row['id']."\">".sprintf("bara %s in %s",$row['versione'],$row['materiale'])."</option>";
}
while ($row = $urn_res->fetch_assoc()){
	$option_list .= "<option value=\"2-".$row['id']."\">".sprintf("urna %s in %s",$row['versione'],$row['materiale'])."</option>";
}
while ($row = $flower_res->fetch_assoc()){
	$option_list .= "<option value=\"3-".$row['id']."\">".sprintf("fiori %s", $row['nome'])."</option>";
}
while ($row = $funeral_res->fetch_assoc()){
	$option_list .= "<option value=\"4-".$row['id']."\">".sprintf("cerimonia %s",$row['tipologia'])."</option>";
}
$management_file = fopen('views/gestioneForm.xhtml','r');
$man_content = fread($management_file,filesize('views/gestioneForm.xhtml'));
$man_content = str_replace('<elementlist/>',$option_list,$man_content);
echo $man_content;
