<?php
session_start(['cookie_lifetime' => 86400]);
if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
	error_log('non auth user trying to access admin, redirected to login');
	header('Location: login.php');
}
require_once 'bin/Connection.php';
$connection = new Connection();
$urn_res = $connection->Query("SELECT * FROM urne");
$option_list = '';
while ($row = $urn_res->fetch_assoc()){
	$option_list .= "<option value=\"2-".$row['id']."\">".sprintf("urna %s in %s",$row['versione'],$row['materiale'])."</option>";
}
$management_file = fopen('views/gestioneUrne.xhtml','r');
$man_content = fread($management_file,filesize('views/gestioneUrne.xhtml'));
$man_content = str_replace('<elementlist/>',$option_list,$man_content);
$man_content = str_replace('<deleteerror/>',isset($del_error)
	?$del_error:'',$man_content);
$man_content = str_replace('<adderror/>',isset($add_error)
	?$add_error:'',$man_content);
echo $man_content;