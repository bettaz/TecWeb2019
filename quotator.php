<?php
$quot_file = fopen('./views/preventivatore.xhtml','r');
$quot_content = fread($quot_file,filesize('./views/preventivatore.xhtml'));
echo $quot_content;
