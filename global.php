<?php

require_once 'classes/config.php';

spl_autoload_register('carregarClasses');

function carregarClasses($nomeClasse){
    if(file_exists("classes/". $nomeClasse . ".php")){
        require_once 'classes/'. $nomeClasse . ".php";
    }
}

?>