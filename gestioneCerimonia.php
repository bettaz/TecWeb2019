<?php
session_start(['cookie_lifetime' => 86400]);
if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
	error_log('non auth user trying to access admin, redirected to login');
	header('Location: login.php');
}
require_once 'bin/Connection.php';
$connection = new Connection();
$funeral_res = $connection->Query("SELECT * FROM cerimonie");
$option_list = '';
while ($row = $funeral_res->fetch_assoc()){
	$option_list .= "<option value=\"4-".$row['id']."\">".sprintf("cerimonia %s",$row['tipologia'])."</option>";
}
$management_file = fopen('views/gestioneCerimonia.xhtml','r');
$man_content = fread($management_file,filesize('views/gestioneCerimonia.xhtml'));
$man_content = str_replace('<elementlist/>',$option_list,$man_content);
$man_content = str_replace('<deleteerror/>',isset($del_error)
	?$del_error:'',$man_content);
$man_content = str_replace('<adderror/>',isset($add_error)
	?$add_error:'',$man_content);
echo $man_content;
