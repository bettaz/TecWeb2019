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
			<form action='viewDetail.php'>
				<div class=\"linea\">
			        <ul>
			            <li>Codice cliente: $code</li>
			            <li>Nome cliente: $name</li>
			            <li>Cognome cliente: $surname</li>
			            <li>Data preventivo: $date</li>
			        </ul>
			        <input type=\"hidden\" value=\"$code\" name=\"code\"/>
		            <input type=\"submit\" value=\"Visualizza\"/>
		        </div>
		    </form>";
	}
}
$list .= "</div>";
$view_file = fopen('views/quotationList.xhtml','r');
$placeholded = fread($view_file, filesize('views/quotationList.xhtml'));
$content = str_replace('<prevlist/>',$list,$placeholded);
echo $content;
