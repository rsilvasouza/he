<?php
session_start();

if($_SESSION['perfil'] != '1'){
    header("location: aluno.php");
}