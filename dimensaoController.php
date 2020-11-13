<?php
    session_start();
    require_once 'classes.php';

    $dimensao = new Dimensao();


    if (isset($_POST['cadastrar'])) {

        try {
           $dimensao->setNome($_POST['nome']);
           $dimensao->setMax_horas($_POST['max_horas']);
            # Insert
            if ($dimensao->insert()) :
                $_SESSION['msgSucesso'] = "Dimensão cadastrada com sucesso!";
                header("location: dimensao.php");
                exit();
            else :
                $_SESSION['msgErro'] = "Ocorreu um erro durante salvar o registo, por favor tente novamente";
                header("location: dimensao.php");
                exit();
            endif;
        } catch (Exception $ex) {
            Erro::trataErro($ex);
        }
    } else if (isset($_POST['editar'])) {

        try {
            $dimensao->setId($_POST['id']);
            $dimensao->setNome($_POST['nome']);
            $dimensao->setMax_horas($_POST['max_horas']);

            if ($dimensao->update()) :
                $_SESSION['msgSucesso'] = "Dimensão editada com sucesso!";
                header("location: dimensao.php");
                exit();
            else :
                $_SESSION['msgErro'] = "Ocorreu um erro durante alterar o registo, por favor tente novamente";
                header("location: dimensao.php");
                exit();
            endif;
        } catch (Exception $ex) {
            Erro::trataErro($ex);
        }
    } else if (isset($_POST['excluir']) && $_POST['idExcluir'] != 0) {

        try {
            $id = $_POST['idExcluir'];

            if ($dimensao->delete($id)) :
                $_SESSION['msgSucesso'] = "Dimensão excluida com sucesso!";
                header("location: dimensao.php");
                exit();
            else :
                $_SESSION['msgErro'] = "Ocorreu um erro durante a exclusão do registo, por favor tente novamente";
                header("location: dimensao.php");
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
