<?php
session_start(['cookie_lifetime' => 86400]);
if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
	error_log('non auth user trying to access admin, redirected to login');
	header('Location: login.php');
}
require_once 'bin/Connection.php';
$connection = new Connection();

// TODO verificare errore in rimozione
if(isset($_POST['nomeRemoveP'])){
	$full_qualifier= $_POST['nomeRemoveP'];
	$split = explode('-',$full_qualifier);
	$table='';
	switch ($split[0]){
		case '0':
			$table='auto';
			break;
		case '1':
			$table='bare';
			break;
		case '2':
			$table='urne';
			break;
		case '3':
			$table='composizioni';
			break;
		case '4':
			$table='cerimonie';
			break;
	}
	$id=$split[1];
	$del_res=$connection->Query("
		DELETE FROM $table WHERE id='$id'
	");
	$del_error ="Rimozione effettuata con successo";
	if(!$del_res){
		$del_error="Errore di rimozione";
	}
}
require_once 'bin/Connection.php';
$connection = new Connection();
$car_res = $connection->Query("SELECT * FROM auto");
$coffin_res = $connection->Query("SELECT * FROM bare");
$urn_res = $connection->Query("SELECT * FROM urne");
$flower_res = $connection->Query("SELECT * FROM composizioni");
$funeral_res = $connection->Query("SELECT * FROM cerimonie");
$option_list = '';
while ($row = $car_res?$car_res->fetch_assoc():false){
	$option_list .= "<option value=\"0-".$row['id']."\">".sprintf("auto %s - %s - %d cc", $row['marca'],$row['modello'],$row['cilindrata'])."</option>";
}
while ($row = $coffin_res?$coffin_res->fetch_assoc():false){
	$option_list .= "<option value=\"1-".$row['id']."\">".sprintf("bara %s in %s",$row['versione'],$row['materiale'])."</option>";
}
while ($row = $urn_res?$urn_res->fetch_assoc():false){
	$option_list .= "<option value=\"2-".$row['id']."\">".sprintf("urna %s in %s",$row['versione'],$row['materiale'])."</option>";
}
while ($row = $flower_res?$flower_res->fetch_assoc():false){
	$option_list .= "<option value=\"3-".$row['id']."\">".sprintf("fiori %s", $row['nome'])."</option>";
}
while ($row = $funeral_res?$funeral_res->fetch_assoc():false){
	$option_list .= "<option value=\"4-".$row['id']."\">".sprintf("cerimonia %s",$row['tipologia'])."</option>";
}
$management_file = fopen('views/gestioneForm.xhtml','r');
$man_content = fread($management_file,filesize('views/gestioneForm.xhtml'));
fclose($management_file);
$man_content = str_replace('<elementlist/>',$option_list,$man_content);
$man_content = str_replace('<deleteerror/>',isset($del_error)
	?$del_error:'',$man_content);
$man_content = str_replace('<adderror/>',isset($add_error)
	?$add_error:'',$man_content);
echo $man_content;