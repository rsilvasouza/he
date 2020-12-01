<?php
session_start();
require_once 'classes.php';

$administrador = new Administrador();

if (isset($_POST['editar'])) {
    try {
        $administrador->setId($_POST['id']);
        $administrador->setMatricula($_POST['matricula']);
        $administrador->setNome($_POST['nome']);
        $administrador->setEmail($_POST['email']);
        $administrador->setSenha($_POST['senha']);

        if (empty($_POST['senha'])) {
            if ($administrador->updateSemSenha()) {
                $_SESSION['msgSucesso'] = "Registro Alterado com sucesso!";
                header("location: index.php");
                exit();
            } else {
                $_SESSION['msgErro'] = "Erro ao Editar o seu cadastro!";
                header("location: index.php");
            }
        }
        if (!empty($_POST['senha'])) {
            if ($administrador->updateComSenha()) {
                $_SESSION['msgSucesso'] = "Registro Alterado com sucesso!";
                header("location: index.php");
                exit();
            } else {
                $_SESSION['msgErro'] = "Erro ao Editar o seu cadastro!";
                header("location: index.php");
            }
        }
    } catch (Exception $ex) {
        Erro::trataErro($ex);
    }
} else {
    $_SESSION['msgInfo'] = "Ops, algo de errado aconteceu!";
    header("location: index.php");
    exit();
}
