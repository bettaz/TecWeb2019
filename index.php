<?php
require_once('./bin/Connection.php');
$connection = new Connection();
$result = $connection->Query("SELECT nomeDefunto AS nome, cognomeDefunto AS cognome, dataDecesso AS data  FROM defunti WHERE isPublic IS TRUE");
$news = '<div id="news">';
if($result){
    $news = $news.' <h3 id="tnews">Necrologi</h3> <ul>';
    while ($row = $result->fetch_assoc()){
        $news = $news.sprintf('<li>%s %s - %s</li>', $row['nome'], $row['cognome'], $row['data']);
    }
    $news = $news.'</ul>';
}
else
    $news = $news.'<h3 id="tnews">Impossibile caricare i necrologi</h3>';
$news = $news.'</div>';
$file = fopen('./views/index.xhtml','r');
$content = fread($file, filesize('./views/index.xhtml'));
$processed = str_replace('<news/>', $news, $content);
fclose($file);
echo $processed;