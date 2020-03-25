<?php

include_once ('/opt/lampp/htdocs/tecweb2019/php/Connections/connection.php');
include_once ('/opt/lampp/htdocs/tecweb2019/php/Classes/convertitor.php');
//import ('/opt/lampp/htdos/tecweb2019/php/Classes/convertitor.php');

echo '<html>';

include ("php/doctype.php");
echo "<body>";
include ("php/header.php");
include ("php/breadcrumb.php");
include ("php/menu.php");
include ("php/Contents/preventivatoreContent.php");
include ("php/footer.php");
echo '</body>';
echo '</html>';

$url=$_SERVER['REQUEST_URI'];

if($url != "/tecweb2019/preventivatore.php"){

    $url_components= parse_url($url);
    parse_str($url_components['query'],$params);//pull di tutti gli attributi della query string
    $conv= new convertitor($params['bara'],$params['cremazione'],$params['urna'],$params['auto'],"");
    echo "valore cremazione= ".$conv->cremazione;
    echo "<br/>";
    $bara= $conv->getBaraPrice();
    echo "prezzo bara: ".$bara;
    echo "<br/>";
    $urna= $conv->getUrnaPrice();
    echo " prezzo urna: ".$urna;
    echo "<br/>";
    $auto= $conv->getAutoPrice();
    echo " prezzo auto: ".$auto;
}
?>

