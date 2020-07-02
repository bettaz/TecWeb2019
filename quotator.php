<?php
session_start();
require_once 'bin/Connection.php';
$connection = new Connection();
$errors='';
$quot_file = fopen('./views/preventivatore.xhtml','r');
$quot_content = fread($quot_file,filesize('./views/preventivatore.xhtml'));
if(isset($_POST['submit'])){
	$textRegex = '^([A-Z]|[a-z]|\ )+^';
	$dateRegex = '^\\d{4}\\-(0[1-9]|1[012])\\-(0[1-9]|[12][0-9]|3[01])^';
	$selectRegex = '^\\d+^';
	$telRegex = '^[+]?[0-9]+^';
	$cfRegex = '^([A-Z]|[a-z]){6}[0-9]{2}([A-Z]|[a-z])[0-9]{2}([A-Z]|[a-z])[0-9]{3}([A-Z]|[a-z])^';
	$boolRegex = '^(true|false)^';
	$provRegex = '^[A-Z]{2}^';
	$roadRegex = '^([a-z]|[A-Z]|[0-9]|\ )+^';
	$suggestions = [
		"cf" => [
			"regex" => $cfRegex,
			"suggestion" => "Codice fiscale non corretto"
		],
		"nomeC" => [
			"regex" => $textRegex,
			"suggestion" => "Nome cliente vuoto o contenente una cifra"
		],
		"cognomeC" => [
			"regex" => $textRegex,
			"suggestion" => "Cognome cliente vuoto o contenente una cifra"
		],
		"nomeD" => [
			"regex" => $textRegex,
			"suggestion" => "Nome defunto vuoto o contenente una cifra"
		],
		"cognomeD" => [
			"regex" => $textRegex,
			"suggestion" => "Cognome defunto vuoto o contenente una cifra"
		],
		"decesso" => [
			"regex" => $dateRegex,
			"suggestion" => "La data del decesso deve avere formato AAAA-MM-GG"
		],
		"via" => [
			"regex" => $roadRegex,
			"suggestion" => "Nome della via vuoto o contenente caratteri speciali"
		],
		"citta" => [
			"regex" => $textRegex,
			"suggestion" => "Nome della città vuoto o contenente una cifra"
		],
		"provincia" => [
			"regex" => $provRegex,
			"suggestion" => "Non è stata selezionata la provincia"
		],
		"tel" => [
			"regex" => $telRegex,
			"suggestion" => "Numero di telefono non inserito o contenente caratteri non numerici non appartenenti al prefisso internazionale"
		],
		"nascita" => [
			"regex" => $dateRegex,
			"suggestion" => "La data di nascita deve avere formato AAAA-MM-GG"
		],
		"cerimonia" => [
			"regex" => $selectRegex,
			"suggestion" => "Selezionare una cerimonia"
		],
		"bara" => [
			"regex" => $selectRegex,
			"suggestion" => "Selezionare una bara"
		],
		"urna" => [
			"regex" => $selectRegex,
			"suggestion" => "Selezionare un'urna"
		],
		"auto" => [
			"regex" => $selectRegex,
			"suggestion" => "Selezionare un carro funebre"
		],
		"fiori" => [
			"regex" => $selectRegex,
			"suggestion" => "Selezionare una composizione floreale"
		],
		"cremazione" => [
			"regex" => $boolRegex,
			"suggestion" => "Scegliere se si desidera o meno la cremazione"
		]
	];
	$errors ="";
	foreach($_POST as $key => $input){
		if($key!= "submit" && !preg_match($suggestions[$key]['regex'],$input)){
			$suggestion = $suggestions[$key]['suggestion'];
			$errors .= "<p><a href=\"#$key\" rel=\"tag\">$suggestion</a></p>";
			error_log("errore in ".$key);
		}
	}
	$errors .= $_POST['cremazione']=='false'&&$_POST['urna']!='false'?
		"<p><a href=\"#sicremazione\" rel=\"tag\">E' stata selezionata un'urna ma non la cremazione</a></p>":"";
	$cf = $connection->escape($_POST['cf']);
	$nomeC =$connection->escape($_POST['nomeC']);
	$cognomeC = $connection->escape($_POST['cognomeC']);
	$nomeD=$connection->escape($_POST['nomeD']);
	$cognomeD=$connection->escape($_POST['cognomeD']);
	$nascita=$connection->escape($_POST['nascita']);
	$decesso=$connection->escape($_POST['decesso']);
	$via =$connection->escape($_POST['via']);
	$citta =$connection->escape( $_POST['citta']);
	$provincia=$connection->escape($_POST['provincia']);
	$tel=$connection->escape($_POST['tel']);
	$bara = $connection->escape($_POST['bara']);
	$cremazione =$connection->escape($_POST['cremazione']);
	$urna = $connection->escape($_POST['urna']);
	$auto = $connection->escape($_POST['auto']);
	$fiori=$connection->escape($_POST['fiori']);
	$cerimonia = $connection->escape($_POST['cerimonia']);
	if($errors=="") {
		$indirizzo = sprintf("%s - %s (%s)", $via, $citta, $provincia);
		error_log("received_quotator_data");
		$res = $connection->Query("INSERT INTO `defunti` (`cf`,
	                       `nomeDefunto`, `cognomeDefunto`, `dataNascita`,
	                       `dataDecesso`, `residenza`, `nomeCliente`,
	                       `cognomeCliente`, `numeroTelefono`,
	                       `idCerimonia`, `idBara`, `idUrna`, `idAuto`,
	                       `isPublic`, `proposta`, `idFiori`)
	                       VALUES ('$cf', '$nomeD', '$cognomeD', '$nascita', '$decesso',
	                               '$indirizzo', '$nomeC', '$cognomeC',
	                               '$tel', $cerimonia, $bara, $urna, $auto,
	                               '0', NULL, $fiori)");
		if ($res) {
			$_SESSION['cf'] = $cf;
			header("Location: viewQuotation.php");
		}
		else {
			$errors .= "<p>Impossibile inserire il preventivo</p>";
		}
	}
}
$selectStatement = 'selected="selected"';
$province_file = fopen('views/partials/province.xml','r');
$province_content = fread($province_file, filesize('views/partials/province.xml'));
if(isset($_POST['provincia'])){
	$province_content = str_replace("value=\"$provincia\"","value=\"$provincia\" selected=\"selected\"",$province_content);
}

$bara_res = $connection->Query("SELECT * FROM bare");
$urna_res = $connection->Query("SELECT * FROM urne");
$auto_res = $connection->Query("SELECT * FROM auto");
$fiori_res = $connection->Query("SELECT * FROM composizioni");
$cer_res = $connection->Query("SELECT * FROM cerimonie");
$cerimonie = '';
while($row= $cer_res->fetch_assoc()){
	$id=$row['id'];
	$tipo = $row['tipologia'];
	$prezzo=$row['costoBase'];
	$cerimonie.="<option value=\"$id\"".((isset($_POST['cerimonia'])
			&&$_POST['cerimonia']==$id)?$selectStatement:'').">$tipo - $prezzo €</option>";
}
$bare='';
while($row = $bara_res->fetch_assoc()){
	$id=$row['id'];
	$desc = $row['versione'];
	$prezzo = $row['costoBase'];
	$mat = $row['materiale'];
	$bare.="<option value=\"$id\"".((isset($_POST['bara'])
			&&$_POST['bara']==$id)?$selectStatement:'').">$desc - $mat - $prezzo €</option>";
}
$urne='';
while($row = $urna_res->fetch_assoc()){
	$id=$row['id'];
	$desc = $row['versione'];
	$prezzo = $row['costoBase'];
	$mat = $row['materiale'];
	$urne.="<option value=\"$id\"".((isset($_POST['urna'])
			&&$_POST['urna']==$id)?$selectStatement:'').">$desc - $mat - $prezzo €</option>";
}
$autos='';
while($row = $auto_res->fetch_assoc()){
	$id=$row['id'];
	$modello = $row['modello'];
	$prezzo = $row['costoBase'];
	$marca = $row['marca'];
	$cilindrata = $row['cilindrata'];
	$autos.="<option value=\"$id\"".((isset($_POST['auto'])
		&&$_POST['auto']==$id)?$selectStatement:'').">$marca - $modello - $cilindrata cc - $prezzo €</option>";
}
$fiori = '';
while($row = $fiori_res->fetch_assoc()){
	$id=$row['id'];
	$nome = $row['nome'];
	$prezzo = $row['costoBase'];
	$fiori.="<option value=\"$id\"".((isset($_POST['fiori'])
			&&$_POST['fiori']==$id)?$selectStatement:'').">$nome - $prezzo €</option>";
}
$quot_content = str_replace("<provinciaoptions/>",$province_content,
	$quot_content);
$quot_content = str_replace("<cerimoniaoptions/>",$cerimonie,$quot_content);
$quot_content = str_replace("<baraoptions/>",$bare,$quot_content);
$quot_content = str_replace("<urnaoptions/>",$urne,$quot_content);
$quot_content = str_replace("<autooptions/>",$autos,$quot_content);
$quot_content = str_replace("<fiorioptions/>",$fiori,$quot_content);
$quot_content = str_replace("<cfvalue/>",isset($_POST['cf'])?$_POST['cf']:'', $quot_content);
$quot_content = str_replace("<nomeDvalue/>",isset($_POST['nomeD'])
	?$_POST['nomeD']:'', $quot_content);
$quot_content = str_replace("<cognomeDvalue/>",isset($_POST['cognomeD'])
	?$_POST['cognomeD']:'', $quot_content);
$quot_content = str_replace("<nascitavalue/>",isset($_POST['nascita'])
	?$_POST['nascita']:'', $quot_content);
$quot_content = str_replace("<decessovalue/>",isset($_POST['decesso'])
	?$_POST['decesso']:'', $quot_content);
$quot_content = str_replace("<decessovalue/>",isset($_POST['decesso'])
	?$_POST['decesso']:'', $quot_content);
$quot_content = str_replace("<nomeCvalue/>",isset($_POST['nomeC'])
	?$_POST['nomeC']:'', $quot_content);
$quot_content = str_replace("<cognomeCvalue/>",isset($_POST['cognomeC'])
	?$_POST['cognomeC']:'', $quot_content);
$quot_content = str_replace("<viavalue/>",isset($_POST['via'])
	?$_POST['via']:'', $quot_content);
$quot_content = str_replace("<cittavalue/>",isset($_POST['citta'])
	?$_POST['citta']:'', $quot_content);
$quot_content = str_replace("<telvalue/>",isset($_POST['tel'])
	?$_POST['tel']:'', $quot_content);
$infocremazione = $quot_content = str_replace('id="nocremazione"',
	(isset($_POST['cremazione'])&&$_POST['cremazione']==='false')?'id="nocremazione"
	checked="checked"':'id="nocremazione"',
		$quot_content);
if(!isset($_POST['cremazione'])||$_POST['cremazione']==='true')
	$quot_content = str_replace('id="sicremazione"','id="sicremazione" checked="checked"',
	$quot_content);
$quot_content = str_replace('<globalerr/>',$errors==''?'':"<div id=\"errors\" class=\"linea\">$errors</div>
",$quot_content);
echo $quot_content;
