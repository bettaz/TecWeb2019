<?php
session_start(['cookie_lifetime' => 86400]);
if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
	error_log('non auth user trying to access admin, redirected to login');
	header('Location: login.php');
}
require_once('bin/Connection.php');
$connection = new Connection();
$clean_input = $connection->escape($_GET['code']);
if(isset($_POST['finalTot'])){
	$finalToSet = $connection->escape($_POST['finalTot']);
	$isPublished = isset($_POST['publicNecro']);
	$connection->Query("
		UPDATE defunti SET proposta= '$finalToSet' , isPublic= ".
		($isPublished?'TRUE':'FALSE')." WHERE cf = '$clean_input';
	");
}
$resource = $connection->Query("
	SELECT * FROM defunti where cf = '$clean_input'
");
$data = $resource->fetch_assoc();
$detail_file = fopen('views/singleQuotation.xhtml','r');
$detail_content = fread($detail_file,filesize('views/singleQuotation.xhtml'));
$content = str_replace('<idquotation/>',$data['cf'],$detail_content);
$content = str_replace('<rdate/>',$data['data'],$content);
$content = str_replace('<ncustomer/>',$data['nomeCliente'],$content);
$content = str_replace('<scustomer/>',$data['cognomeCliente'],$content);
$content = str_replace('<ndead/>', $data['nomeDefunto'],$content);
$content = str_replace('<sdead/>', $data['cognomeDefunto'], $content);
$content = str_replace('<cusaddress/>',$data['residenza'],$content);
$content = str_replace('<mobile/>', $data['numeroTelefono'],$content);
$content = str_replace('<coffin/>',$data['idBara'],$content);
$content = str_replace('<cremation/>',$data['idUrna']!=null?$data['idUrna']:'senza cremazione',$content);
$content = str_replace('<car/>',$data['idAuto'],$content);
// TODO add flower, funeral, quotation calc and stored quotation fetch and print
$calculated = 0;
$content = str_replace('<funeral/>',$data['idCerimonia'],$content);
$content = str_replace('<flowers/>','',$content);
$content = str_replace('<quotation/>',$calculated,$content);
$content = str_replace('<finalquotation/>',$data['proposta']?$data['proposta']:$calculated,$content);
$content = str_replace('<necroCheck/>',$data['isPublic']?'checked="checked()"':'',$content);
echo $content;
