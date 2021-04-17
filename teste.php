<?php

require_once 'classes.php';

$email = new Email();

if($email->sendEmail("cadastro","rj.souzarafael@gmail.com","cpf","senha")){
    echo "enviado";
}else{
    echo "erro";
}

