<?php
    $page=$_SERVER['REQUEST_URI'];
    echo '<div id="menu">
        <ul>';
        if($page=="/tecweb2019/index.php"){
            echo '<li xml:lang="en">Home</li>
            <li><a href="azienda.php" tabindex="2" accesskey="A">Azienda</a></li>
            <li><a href="preventivatore.php" tabindex="3" accesskey="P">Preventivatore</a></li>';
        }
        if($page=="/tecweb2019/azienda.php"){
            echo '<li><a href="index.php" tabindex="2" accesskey="H">Home</a></li>
            <li xml:lang="it">Azienda</li>
            <li><a href="preventivatore.php" tabindex="3" accesskey="P">Preventivatore</a></li>';
        }
        if($page=="/tecweb2019/preventivatore.php"){
            echo '<li><a href="index.php" tabindex="2" accesskey="H">Home</a></li>
            <li><a href="azienda.php" tabindex="3" accesskey="A">Azienda</a></li>
            <li xml:lang="it">Preventivatore</li>';
        }
    echo '</ul>
    </div>';
?>