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
SELECT d.cf, d.cognomeCliente, d.cognomeDefunto,
       d.data, d.dataDecesso, d.dataNascita,
       d.isPublic, d.numeroTelefono, d.proposta,
       d.residenza, d.nomeCliente,d.nomeDefunto,
       a.marca marcaCarro, a.modello modelloCarro,
       a.cilindrata cilindrataCarro, a.costoBase costoCarro,
       f.nome nomeCompos, f.costoBase costoCompos,
       b.versione nomeBara, b.materiale tipoBara, b.costoBase costoBara,
       c.tipologia tipoCerim, c.costoBase costoCerim,
       u.versione nomeUrna, u.materiale tipoUrna, u.costoBase costoUrna
FROM defunti d
    JOIN auto a ON d.idAuto=a.id
    JOIN composizioni f ON d.idFiori=f.id
    JOIN bare b on d.idBara = b.id
    JOIN cerimonie c ON d.idCerimonia=c.id
    LEFT JOIN urne u ON d.idUrna=u.id
WHERE cf = '$clean_input'");

if($data = $resource->fetch_assoc()){
    $cerimonia=sprintf("%s - %.02f€",$data['tipoCerim'],$data['costoCerim']);
    $auto=sprintf("%s - %s %s cc - %.02f€",$data['marcaCarro'],
        $data['modelloCarro'],$data['cilindrataCarro'],$data['costoCarro']);
    $bara=sprintf("%s - %s - %.02f€",$data['nomeBara'],$data['tipoBara'],
        $data['costoBara']);
    $fiori = sprintf("%s - %.02f€",$data['nomeCompos'],$data['costoCompos']);
    $totale= $data['costoCarro'] + $data['costoBara'] + $data['costoCerim'] +
        $data['costoCompos'];
    if(isset($data['nomeUrna'])){
        $urna=sprintf("%s - %s - %.02f€",$data['nomeUrna'],$data['tipoUrna'],
            $data['costoUrna']);
        $totale += $data['costoUrna'];
    }
    $scontato=isset($data['proposta'])?$data['proposta']."€":'Ancora da valutare';
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
    $content = str_replace('<coffin/>',$bara,$content);
    $content = str_replace('<cremation/>',isset($urna)?'con cremazione':'senza cremazione',$content);
    $content = str_replace('<urn/>',isset($urna)?$urna:"//",$content);
    $content = str_replace('<car/>',$auto,$content);
    $calculated = 0.0;
    $content = str_replace('<funeral/>',$cerimonia,$content);
    $content = str_replace('<flowers/>',$fiori,$content);
    $content = str_replace('<quotation/>',$totale."€",$content);
    $content = str_replace('<customquotation/>',$scontato,$content);
    $content = str_replace('<finalquotation/>',trim($scontato,'€'),$content);
    $content = str_replace('<necroCheck/>',$data['isPublic']?'checked="checked()"':'',$content);
    $content = str_replace('<publicdeath/>',$data['isPublic']?'Pubblicato sul necrologio':'Privato',$content);
    echo $content;
}
else
    die("impossibile recuperare il preventivo!");
