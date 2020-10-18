<?php
    session_start();
    require_once 'classes.php';

    $aluno = new Aluno();


    if (isset($_POST['cadastrar'])) {

        try {
            $aluno->setMatricula($_POST['matricula']);
            $aluno->setNome($_POST['nome']);
            $aluno->setEmail($_POST['email']);
            $aluno->setSenha($_POST['senha']);            
            $aluno->setTurno($_POST['turno']);
            $aluno->setCurso($_POST['curso']);
           // $aluno->setDataRegistro(date('Y-m-d H:i:s'));
           
            # Insert
            
            if(!$aluno->findMatricula($_POST['matricula']) && !$aluno->findEmail($_POST['email'])):
                $aluno->insert();
                $_SESSION['msgSucesso'] = "Registro cadastrado com sucesso. Aguardando aprovação!";
                header("location: login.php");
                exit();
            else :
                $_SESSION['msgErro'] = "Aluno já cadastrado no sistema!";
                header("location: login.php");
                exit();
            endif;
        } catch (Exception $ex) {
            Erro::trataErro($ex);
        }
    } else if(isset($_POST['aprovar'])){
        try {
            
            if($aluno->atualizaStatus($_POST['idAprovar'], 1)){
                $_SESSION['msgSucesso'] = "Aluno Aprovado com Sucesso!";
                header("location: alunoCadastrado.php");
                exit();
            }else{
                $_SESSION['msgErro'] = "Erro ao Aprovar registro!";
                header("location: alunoCadastrado.php");
                exit();
            }

        } catch (Exception $ex) {
            Erro::trataErro($ex);
        }
    }
    // else if (isset($_POST['editar'])) {

    //     try {
    //         $aluno->setId($_POST['id']);
    //         $aluno->setNome($_POST['nome']);
    //         $aluno->setPostoGraduacao($_POST['pg']);
    //         $aluno->setMilitar($_POST['militar']);
    //         $aluno->setFuncao($_POST['funcao']);
    //         $aluno->setSecao($_POST['secao']);
    //         $aluno->setIp($_POST['ip']);
    //         $aluno->setMac($_POST['mac']);
    //         $aluno->setNumPatrimonio($_POST['numPatrimonio']);
    //         $aluno->setSistemaOperacional($_POST['so']);
    //         $aluno->setSoLicenciado($_POST['licenca']);
    //         $aluno->setObservacao($_POST['observacao']);
    //         $aluno->setUsuario($_POST['usuario']);

    //         if ($aluno->update()) :
    //             $_SESSION['msgSucesso'] = "Registro editada com sucesso!";
    //             header("location: maquina.php");
    //             exit();
    //         else :
    //             $_SESSION['msgErro'] = "Ocorreu um erro durante alterar o registo, por favor tente novamente";
    //             header("location: maquina.php");
    //             exit();
    //         endif;
    //     } catch (Exception $ex) {
    //         Erro::trataErro($ex);
    //     }
    // } else if ($_GET['acao'] == 'deletar' && $_GET['id'] != 0) {

    //     try {
    //         $id = $_GET['id'];

    //         if ($aluno->delete($id)) :
    //             $_SESSION['msgSucesso'] = "Registro excluido com sucesso!";
    //             header("location: maquina.php");
    //             exit();
    //         else :
    //             $_SESSION['msgErro'] = "Ocorreu um erro durante a exclusão do registo, por favor tente novamente";
    //             header("location: maquina.php");
    //             exit();
    //         endif;
    //     } catch (Exception $ex) {
    //         Erro::trataErro($ex);
    //     }
    // } 
    else {
        $_SESSION['msgInfo'] = "Ops, algo de errado aconteceu!";
        header("location: index.php");
        exit();
    }
