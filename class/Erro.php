<?php

class Erro {

    public static function trataErro(Exception $erro) {
        if (DEBUG) {
            echo '<pre>';
            var_dump($erro);
            echo '</pre';
        } else {
            //echo $erro->getMessage();
            header("Location: index.php");
        }
        exit;
    }

}
