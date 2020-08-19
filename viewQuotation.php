<?php
session_start();
if(!isset($_SESSION['cf']))
	header('Location: quotator.php');
require_once 'bin/Connection.php';
$connection = new Connection();
$cf = $_SESSION['cf'];
$base_record= $connection->Query("
SELECT cf, nomeDefunto AS namD, cognomeDefunto AS surD, dataNascita AS born,
       dataDecesso AS death, residenza AS via, nomeCliente AS namC,
       cognomeCliente AS surC, numeroTelefono AS tel,
       cerimonie.tipologia AS cerimD, cerimonie.costoBase AS cerimP,
       auto.marca AS carB, auto.modello AS carM, auto.cilindrata AS carCC,
       auto.costoBase AS carP, bare.versione AS cofV,
       bare.materiale AS cofM, bare.costoBase AS cofP,
       composizioni.nome AS fioriN, composizioni.costoBase AS fioriP, idUrna
FROM defunti JOIN cerimonie ON defunti.idCerimonia=cerimonie.id
	JOIN auto ON defunti.idAuto=auto.id
	    JOIN bare ON defunti.idBara=bare.id
			JOIN composizioni ON defunti.idFiori=composizioni.id
	    		ORDER BY data DESC limit 0,1");
$urna_flag = $scontato_flag=false;

if ($dead_data=$base_record?$base_record->fetch_assoc():false){
	$cf=$dead_data['cf'];
	$namD=$dead_data['namD'];
	$surD=$dead_data['surD'];
	$born=$dead_data['born'];
	$death=$dead_data['death'];
	$namC = $dead_data['namC'];
	$surC= $dead_data['surC'];
	$via=$dead_data['via'];
	$tel=$dead_data['tel'];
	$cerimonia=sprintf("%s - %.02f€",$dead_data['cerimD'],$dead_data['cerimP']);
	$auto=sprintf("%s - %s %s cc - %.02f€",$dead_data['carB'],$dead_data['carM'],$dead_data['carCC'],$dead_data['carP']);
	$bara=sprintf("%s - %s - %.02f€",$dead_data['cofV'],$dead_data['cofM'],
		$dead_data['cofP']);
	$fiori = sprintf("%s - %.02f€",$dead_data['fioriN'],$dead_data['fioriP']);
	$totale= $dead_data['carP'] + $dead_data['cofP'] + $dead_data['cerimP'] +
		$dead_data['fioriP'];
	if($idUrna= $dead_data['idUrna']){
		$urna_res = $connection->Query("
		SELECT * FROM urne WHERE id='$idUrna'
		");
		if($urna_res){
            $urna_flag=$urna_res->fetch_assoc();
            $urna = sprintf("%s - %s - %.02f€",$urna_flag['versione'],
                $urna_flag['materiale'], $urna_flag['costoBase']);
            $totale += $urna_flag['costoBase'];
        }
	}
	$scontato=isset($dead_data['proposta'])?$dead_data['proposta'].'€':'Ancora da valutare';
}
$view_file=fopen('views/preventivatoreAnteprima.xhtml','r');
$view = fread($view_file,filesize('views/preventivatoreAnteprima.xhtml'));
$view = str_replace('<cf/>',$cf,$view);
$view = str_replace('<namD/>',$namD,$view);
$view = str_replace('<surD/>',$surD,$view);
$view = str_replace('<borndate/>',$born,$view);
$view = str_replace('<deathdate/>',$death,$view);
$view = str_replace('<namC/>',$namC,$view);
$view = str_replace('<surC/>',$surD,$view);
$view = str_replace('<viavalue/>',$via,$view);
$view = str_replace('<telvalue/>',$tel,$view);
$view = str_replace('<cerimoniaoptions/>',$cerimonia,$view);
$view = str_replace('<baraoptions/>',$bara,$view);
$view = str_replace('<cremazioneval/>',$urna_flag?"Con cremazione":"Senza Cremazione",$view);
$view = str_replace('<urnaoptions/>',$urna_flag?$urna:"---",$view);
$view = str_replace('<autooptions/>',$auto,$view);
$view = str_replace('<fiorioptions/>',$fiori,$view);
$view = str_replace('<calcimp/>',$totale, $view);
$view = str_replace('<scontimp/>',$scontato?$scontato:'non ancora processato', $view);
echo $view;
