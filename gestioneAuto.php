<?php
session_start(['cookie_lifetime' => 86400]);
if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
	error_log('non auth user trying to access admin, redirected to login');
	header('Location: login.php');
}

require_once 'bin/Connection.php';
$connection = new Connection();
$car_res = $connection->Query("SELECT * FROM auto");
$option_list = '';
while ($row = $car_res->fetch_assoc()){
	$option_list .= "<option value=\"0-".$row['id']."\">".sprintf("auto %s - %s - %d cc", $row['marca'],$row['modello'],$row['cilindrata'])."</option>";
}
$management_file = fopen('views/gestioneAuto.xhtml','r');
$man_content = fread($management_file,filesize('views/gestioneAuto.xhtml'));
$man_content = str_replace('<elementlist/>',$option_list,$man_content);
$man_content = str_replace('<deleteerror/>',isset($del_error)
	?$del_error:'',$man_content);
$man_content = str_replace('<adderror/>',isset($add_error)
	?$add_error:'',$man_content);
echo $man_content;