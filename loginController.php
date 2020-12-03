<?php
session_start();
require_once 'classes.php';

$aluno = new Aluno();
$administrador = new Administrador();


if (isset($_POST['logar'])) {

    try {
        $aluno->setEmail($_POST['email']);
        $aluno->setSenha($_POST['senha']);
        $aluno->setStatus('1');

        $administrador->setEmail($_POST['email']);
        $administrador->setSenha($_POST['senha']);

        if ($administrador->autenticar()) {
            $dados = $administrador->findEmail($administrador->getEmail());
            $_SESSION['status'] = 'logado';
            $_SESSION['idAdministrador'] = $dados[0]->id;
            $_SESSION['nome'] = $dados[0]->nome;
            $_SESSION['perfil'] = '1';
            $_SESSION['idUsuario'] = '';
            header("location: index.php");
            exit();
        } else if ($aluno->autenticar()) {
            
            $dados = $aluno->findEmail($aluno->getEmail());
            $_SESSION['status'] = 'logado';
            $_SESSION['idAluno'] = $dados[0]->id;
            $_SESSION['nome'] = $dados[0]->nome;
            $_SESSION['perfil'] = '2';
            header("location: aluno.php");
            exit();
        } else if($aluno->verificaRejeitado($aluno->getEmail(), $aluno->getSenha(), -1)){
            $dados = $aluno->findEmail($aluno->getEmail());
            $_SESSION['msgInfo'] = "O seu cadastro foi <strong>Rejeitado!</strong> <br> Motivo: {$dados[0]->info_cadastro}";
            header("location: login.php");
            exit();
        }else if($aluno->verificaStatus($aluno->getEmail(), $aluno->getSenha())){
            $_SESSION['msgInfo'] = "O Cadastro está aguardando <strong>aprovação do administrador</strong>";
            header("location: login.php");
            exit();
        }  else {
            $_SESSION['msgErro'] = "Credenciais inválidas!";
            header("location: login.php");
            exit();
        }
    } catch (Exception $ex) {
        Erro::trataErro($ex);
    }
}
else if (isset($_POST['logout'])) {

    try {

        $_SESSION['status'] = '0';
        session_destroy();
        header('Location: login.php');
    } catch (Exception $ex) {
        Erro::trataErro($ex);
    }
} else {
    $_SESSION['msgInfo'] = "Ops, algo de errado aconteceu!";
    header("location: index.php");
    exit();
}
