<?php
    echo '<div id="breadcrumb">';
    $page= $_SERVER['REQUEST_URI'];
    
    if($page== "/tecweb2019/index.php"){
        echo '<p>Ti trovi in: <span xml:lang="en">Home</span> </p>';

    }

    if($page=="/tecweb2019/azienda.php"){ //NB: change visited link color in stylesheet
        echo '<p>Ti trovi in: <a href="./index.php"><span xml:lang="en">Home</span><a/> &gt;&gt; Azienda </p>';
    }

    if($page=="/tecweb2019/preventivatore.php"){
        echo '<p>Ti trovi in: <a href="./index.php"><span xml:lang="en">Home</span><a/> &gt;&gt; Preventivatore </p>';
    }

    echo '</div>';
?>