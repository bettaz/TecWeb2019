<?php
session_start();
require_once 'bin/Connection.php';
$connection = new Connection();
$auto_error= $incoerenza=$urna_error = $bara_error= $cell_error= $prov_error=
	$citta_error= $via_error= $surD_error= $namD_error= $surC_error=$namC_error=
	$cf_error=$nascita_error=$decesso_error=$cerimonia_error= $global_error=
	false;
if(isset($_POST['cf'])){
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
	$cell=$connection->escape($_POST['cell']);
	$bara = $connection->escape($_POST['bara']);
	$cremazione =$connection->escape($_POST['cremazione']);
	$urna = $connection->escape($_POST['urna']);
	$auto = $connection->escape($_POST['auto']);
	$fiori=$connection->escape($_POST['fiori']);
	$cerimonia = $connection->escape($_POST['cerimonia']);
	$auto_error= ($auto=='false');
	$incoerenza = $cremazione=='false' && $urna!='false';
	$urna_error= $cremazione!='false' && $urna=='false';
	$bara_error= $bara=='false';
	$cell_error= $cell=='';
	$prov_error= $provincia=='false';
	$citta_error= $citta=='';
	$via_error= $via=='';
	$fiori_error = $fiori=='false';
	error_log($nascita);
	$nascita_error= !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$nascita);
	error_log($nascita_error?"true":"false");
	$decesso_error= !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$decesso);
	$surD_error= $cognomeD=='';
	$namD_error= $nomeD=='';
	$surC_error=$cognomeC=='';
	$namC_error=$nomeC=='';
	$cf_error=!preg_match("/^([A-Z]||[a-z]){6}[0-9]{2}([A-Z]||[a-z])(0[1-9]|[1-2][0-9]|3[0-1])([A-Z]||[a-z])[0-9]{3}([A-Z||[a-z])$/",$cf);
	$cerimonia_error=$cerimonia=='false';
	if(!$auto_error&&!$incoerenza&&!$urna_error&&!$bara_error&&!$cell_error
		&&!$prov_error&&!$citta_error&&!$via_error&&!$surD_error
		&&!$surC_error&&!$namC_error&&!$surC_error&&!$nascita_error
		&&!$decesso_error&&!$cerimonia_error&&!$fiori_error){
		$indirizzo= sprintf("%s - %s (%s)",$via,$citta,$provincia);
		error_log("received_quotator_data");
		$res=$connection->Query("INSERT INTO `defunti` (`cf`,
                       `nomeDefunto`, `cognomeDefunto`, `dataNascita`,
                       `dataDecesso`, `residenza`, `nomeCliente`,
                       `cognomeCliente`, `numeroTelefono`,
                       `idCerimonia`, `idBara`, `idUrna`, `idAuto`,
                       `isPublic`, `proposta`, `idFiori`)
                       VALUES ('$cf', '$nomeD', '$cognomeD', '$nascita', '$decesso',
                               '$indirizzo', '$nomeC', '$cognomeC',
                               '$cell', $cerimonia, $bara, $urna, $auto,
                               '0', NULL, $fiori)");
		if($res){
			$_SESSION['cf']= $cf;
			header("Location: viewQuotation.php");
		}
		else
			$global_error=true;
	}
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
	$cerimonie.="<option value=\"$id\">$tipo - $prezzo €</option>";
}
$bare='';
while($row = $bara_res->fetch_assoc()){
	$id=$row['id'];
	$desc = $row['versione'];
	$prezzo = $row['costoBase'];
	$mat = $row['materiale'];
	$bare.="<option value=\"$id\">$desc - $mat - $prezzo €</option>";
}
$urne='';
while($row = $urna_res->fetch_assoc()){
	$id=$row['id'];
	$desc = $row['versione'];
	$prezzo = $row['costoBase'];
	$mat = $row['materiale'];
	$urne.="<option value=\"$id\">$desc - $mat - $prezzo €</option>";
}
$autos='';
while($row = $auto_res->fetch_assoc()){
	$id=$row['id'];
	$modello = $row['modello'];
	$prezzo = $row['costoBase'];
	$marca = $row['marca'];
	$cilindrata = $row['cilindrata'];
	$autos.="<option value=\"$id\">$marca - $modello - $cilindrata cc - $prezzo €</option>";
}
$fiori ='';
while($row = $fiori_res->fetch_assoc()){
	$id=$row['id'];
	$desc = $row['nome'];
	$prezzo = $row['costoBase'];
	$fiori.="<option value=\"$id\">$desc - $prezzo €</option>";
}
$quot_file = fopen('./views/preventivatore.xhtml','r');
$quot_content = fread($quot_file,filesize('./views/preventivatore.xhtml'));
$quot_content=str_replace('<cerimoniaoptions/>',$cerimonie,$quot_content);
$quot_content=str_replace('<baraoptions/>',$bare,$quot_content);
$quot_content=str_replace('<autooptions/>',$autos,$quot_content);
$quot_content=str_replace('<urnaoptions/>',$urne,$quot_content);
$quot_content=str_replace('<fiorioptions/>',$fiori,$quot_content);
$quot_content = str_replace('<cferr/>',$cf_error?'Il codice
fiscale inserito non e\' corretto':'', $quot_content);
$quot_content = str_replace('<nomecerr/>',$namC_error?'Impostare il nome cliente':'',
	$quot_content);
$quot_content = str_replace('<cognomecerr/>',$surC_error?'Impostare il cognome cliente':'',
	$quot_content);
$quot_content = str_replace('<nomederr/>',$namD_error?'Impostare il nome del defunto':'',
	$quot_content);
$quot_content = str_replace('<cognomederr/>',$surD_error?'Impostare il cognome del defunto':'',
	$quot_content);
$quot_content = str_replace('<nacsitaerr/>',$nascita_error?'La data di
nascita deve essere nel formato AAAA-MM-GG':'',
	$quot_content);
$quot_content = str_replace('<decessoerr/>',$decesso_error?'La data di
decesso deve essere nel formato AAAA-MM-GG':'',
	$quot_content);
$quot_content = str_replace('<viaerr/>',$via_error?'Impostare l\'indirizzo':'',
$quot_content);
$quot_content = str_replace('<cittaerr/>',$citta_error?'Impostare una citta\'':'',
$quot_content);
$quot_content = str_replace('<proverr/>',$prov_error?'Impostare la provincia':'',
	$quot_content);
$quot_content = str_replace('<cellerr/>',$cell_error?'Impostare un numero di telefono':'',
	$quot_content);
$quot_content = str_replace('<cerimoniaerr/>',$cerimonia_error?'Impostare una
cerimonia':'',
	$quot_content);
$quot_content = str_replace('<baraerr/>',$bara_error?'Impostare una bara':'',
$quot_content);
$quot_content = str_replace('<coerenzaerr/>',$incoerenza?'Non e\' stata selezionata la cremazione ma e\' stata scelta un\'urna':'',
	$quot_content);
$quot_content = str_replace('<urnaerr/>',$urna_error?'Impostare un urna':'',
	$quot_content);
$quot_content = str_replace('<autoerr/>',$auto_error?'Impostare un\'auto':'',
$quot_content);
$quot_content = str_replace('<globalerr/>',$global_error?'Impossibile
inserire un preventivo':'',
	$quot_content);
$quot_content = str_replace('<fiorierr/>',$fiori_error?'Impostare una
composizione floreale':'',
	$quot_content);
echo $quot_content;
