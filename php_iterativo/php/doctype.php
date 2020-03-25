<?php
    $page=$_SERVER['REQUEST_URI'];

    echo'<!DOCTYPE html
            PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <meta name="title" content="SleekParadise, sito di onoranze funebri" />
        <meta name="description" content="Home page del sito di SleekParadise, fornisce informazioni utili e brevi sulle nostre offerte" />
        <meta name="keywords" content="SleekParadise, onoranze, funebri, funerali, preventivo" />
        <meta name="language" content="italian it" />
        <meta name="author" content="Alessio Bettarello, Mattia Gottardello, Olivier Utshudi, Nicolo Sartor" />
        <!-- link dei css -->';

        if($page=="/tecweb2019/index.php"){
            echo '<title>Home</title>
            <link rel="stylesheet" href="./css/indexDesktop.css" media="screen" /> 
            <link rel="stylesheet" href="./css/indexPrint.css" media="print"/>';
        }
        if($page=="/tecweb2019/azienda.php"){
            echo '<title>Azienda</title>
            <link rel="stylesheet" href="./css/aziendaDesktop.css" media="screen" /> 
            <link rel="stylesheet" href="./css/aziendaPrint.css" media="print"/>';
        }
        if($page=="/tecweb2019/preventivatore.php"){
            echo '<title>Preventivatore</title>
            <link rel="stylesheet" href="./css/preventivatoreDesktop.css" media="screen" /> 
            <link rel="stylesheet" href="./css/preventivatorePrint.css" media="print"/>';
        }

    echo    '<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>';

?>