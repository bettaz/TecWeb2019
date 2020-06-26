<?php
session_start();
if(!isset($_SESSION['cf']))
	header('Location: quotator.php');
require_once 'bin/Connection.php';
$cf = $_SESSION['cf'];
$base_record= $connection->Query("
SELECT cf, nomeDefunto AS namD, cognomeDefunto AS surD, dataNascita AS born,
       dataDecesso AS death, residenza AS via, nomeCliente AS namC,
       cognomeCliente AS surC, numeroTelefono AS cell,
       cerimonie.tipologia AS cerimD, cerimonie.costoBase AS cerimP,
       auto.marca AS carB, auto.modello AS carM, auto.cilindrata AS carCC,
       auto.costoBase AS carP, bare.versione AS cofV,
       bare.materiale AS cofM, bare.costoBase AS cofP, idUrna, idFiori
FROM defunti JOIN cerimonie ON defunti.idCerimonia=cerimonie.id
	JOIN auto ON defunti.idAuto=auto.id
	    JOIN bare ON defunti.idBara=bare.id
	    ORDER BY data DESC limit 0,1");
$fiori_flag= $urna_flag =false;

if ($dead_data=$base_record->fetch_assoc()){
	if($idFiori=$dead_data['idFiori']){
		$fiori_res = $connection->Query("
		SELECT * FROM composizioni WHERE id='$idFiori'
		");
		$fiori_flag=$fiori_res->fetch_assoc();
		$fiori = sprintf("%s - %.02f€",$fiori_flag['nome'],$fiori_flag['costoBase']);
	}
	if($idUrna= $dead_data['idUrna']){
		$urna_res = $connection->Query("
		SELECT * FROM urne WHERE id='$idUrna'
		");
		$urna_flag=$urna_res->fetch_assoc();
		$urna = sprintf("%s - %s - %.02f€",$urna_flag['versione'],
			$urna_flag['materiale'], $urna_flag['costoBase']);
	}
	//TODO fetch base data
}
$view_file=fopen('views/preventivatoreAnteprima.xhtml','r');
$view = fread($view_file,filesize('views/preventivatoreAnteprima.xhtml'));
$view = str_replace('<cf/>',$cf,$view);
$view = str_replace('<namD/>',$namD,$view);
$view = str_replace('<surD/>',$surD,$view);
$view = str_replace('<borndata/>',$born,$view);
$view = str_replace('<deathdate/>',$death,$view);
$view = str_replace('<namC/>',$namC,$view);
$view = str_replace('<surC/>',$surD,$view);
$view = str_replace('<viavalue/>',$namD,$view);
