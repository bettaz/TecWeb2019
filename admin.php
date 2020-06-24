<?php
session_start(['cookie_lifetime' => 86400]);
if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
	error_log('user non auth trying to access admin, redirected to login');
	header('Location: login.php');
}
require_once('bin/Connection.php');
$connection = new Connection();
$list = "<div>";
if($res = $connection->Query("SELECT cf code, nomeCliente name, cognomeCliente surname, data date FROM defunti ORDER BY data DESC")){
	while ($row = $res->fetch_assoc()){
		$name = $row['name'];
		$surname = $row['surname'];
		$code = $row['code'];
		$date = $row['date'];
		$list .= "
			<div class=\"linea\">
		        <ul>
		            <li>Codice cliente: $code</li>
		            <li>Nome cliente: $name</li>
		            <li>Cognome cliente: $surname</li>
		            <li>Data preventivo: $date</li>
		        </ul>
	            <button type=\"button\" value=\"showdetail.php?customer=$code\"> Visualizza </button>
	        </div>";
	}
}
$list .= "</div>";
$view_file = fopen('views/listaPreventivi.xhtml','r');
$placeholded = fread($view_file, filesize('views/listaPreventivi.xhtml'));
$content = str_replace('<prevlist/>',$list,$placeholded);
echo $content;