<?php
session_start(['cookie_lifetime' => 86400]);
if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
	error_log('non auth user trying to access admin, redirected to login');
	header('Location: login.php');
}
require_once 'bin/Connection.php';
$connection = new Connection();
$flower_res = $connection->Query("SELECT * FROM composizioni");
$option_list = '';
while ($row = $flower_res->fetch_assoc()){
	$option_list .= "<option value=\"3-".$row['id']."\">".sprintf("fiori %s", $row['nome'])."</option>";
}
$management_file = fopen('views/gestioneFiori.xhtml','r');
$man_content = fread($management_file,filesize('views/gestioneFiori.xhtml'));
$man_content = str_replace('<elementlist/>',$option_list,$man_content);
$man_content = str_replace('<deleteerror/>',isset($del_error)
	?$del_error:'',$man_content);
$man_content = str_replace('<adderror/>',isset($add_error)
	?$add_error:'',$man_content);
echo $man_content;
