<?php
session_start();
require_once 'classes.php';

$aluno = new Aluno();
$email = new Email();

if (isset($_POST['cadastrar'])) {

    try {
        $aluno->setMatricula($_POST['matricula']);
        $aluno->setNome($_POST['nome']);
        $aluno->setEmail($_POST['email']);
        $aluno->setSenha($_POST['senha']);
        $aluno->setTurno($_POST['turno']);
        $aluno->setCurso($_POST['curso']);
        # Insert

        if (!$aluno->findMatricula($_POST['matricula']) && !$aluno->findEmail($_POST['email'])) :

            if ($aluno->insert()) {
                $email->sendEmail("cadastro", $aluno->getEmail());
                $_SESSION['msgSucesso'] = "Registro cadastrado com sucesso. <strong>Aguarde aprovação!</strong>";
                header("location: login.php");
                exit();
            } else {
                $_SESSION['msgErro'] = "Erro ao Cadastrar!";
                header("location: login.php");
                exit();
            }
        else :
            $_SESSION['msgErro'] = "Aluno já cadastrado no sistema!";
            header("location: login.php");
            exit();
        endif;
    } catch (Exception $ex) {
        Erro::trataErro($ex);
    }
} else if (isset($_POST['aprovar'])) {
    try {

        if ($aluno->atualizaStatus($_POST['idAprovar'], 1)) {
            $email->aprovarCadastro('liberacao', $_POST['email']);
            $_SESSION['msgSucesso'] = "Aluno Aprovado com Sucesso!";
            header("location: alunoCadastrado.php");
            exit();
        } else {
            $_SESSION['msgErro'] = "Erro ao Aprovar registro!";
            header("location: alunoCadastrado.php");
            exit();
        }
    } catch (Exception $ex) {
        Erro::trataErro($ex);
    }
}
if (isset($_POST['editar'])) {
    try {
        $aluno->setId($_POST['id']);
        $aluno->setMatricula($_POST['matricula']);
        $aluno->setNome($_POST['nome']);
        $aluno->setEmail($_POST['email']);
        $aluno->setTurno($_POST['turno']);
        $aluno->setCurso($_POST['curso']);
        $aluno->setSenha($_POST['senha']);

        if (empty($_POST['senha'])) {
            if ($aluno->updateSemSenha()) {
                $_SESSION['msgSucesso'] = "Registro Alterado com sucesso!";
                header("location: aluno.php");
                exit();
            } else {
                $_SESSION['msgErro'] = "Erro ao Editar o seu cadastro!";
                header("location: aluno.php");
            }
        }
        if (!empty($_POST['senha'])) {
            if ($aluno->updateComSenha()) {
                $_SESSION['msgSucesso'] = "Registro Alterado com sucesso!";
                header("location: aluno.php");
                exit();
            } else {
                $_SESSION['msgErro'] = "Erro ao Editar o seu cadastro!";
                header("location: aluno.php");
            }
        }
    } catch (Exception $ex) {
        Erro::trataErro($ex);
    }
} else if (isset($_POST['rejeitar']) && $_POST['idRejeitar'] != 0) {

    try {
        $id = $_POST['idRejeitar'];
        $motivo = $_POST['motivo'];
        $status = 0;

        if ($aluno->rejeitar($id, $motivo, $status)) :
            $_SESSION['msgSucesso'] = "Cadastro <b>Rejeitado</b> com sucesso!";
            header("location: alunoCadastrado.php");
            exit();
        else :
            $_SESSION['msgErro'] = "Ocorreu um erro durante a rejeição do registo, por favor tente novamente";
            header("location: alunoCadastrado.php");
            exit();
        endif;
    } catch (Exception $ex) {
        Erro::trataErro($ex);
    }
} else {
    $_SESSION['msgInfo'] = "Ops, algo de errado aconteceu!";
    header("location: index.php");
    exit();
}
