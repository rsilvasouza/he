 <?php
    session_start();
    require_once 'classes.php';

    $maquina = new Maquina();


    if (isset($_POST['cadastrar'])) {

        try {
           $maquina->setNome($_POST['nome']);
           $maquina->setPostoGraduacao($_POST['pg']);
           $maquina->setMilitar($_POST['militar']);
           $maquina->setFuncao($_POST['funcao']);
           $maquina->setSecao($_POST['secao']);
           $maquina->setIp($_POST['ip']);
           $maquina->setMac($_POST['mac']);
           $maquina->setNumPatrimonio($_POST['numPatrimonio']);
           $maquina->setSistemaOperacional($_POST['so']);
           $maquina->setSoLicenciado($_POST['licenca']);
           $maquina->setObservacao($_POST['observacao']);
           $maquina->setUsuario($_POST['usuario']);
    
            # Insert
            if ($maquina->insert()) :
                $_SESSION['msgSucesso'] = "Maquina cadastrada com sucesso!";
                header("location: maquina.php");
                exit();
            else :
                $_SESSION['msgErro'] = "Ocorreu um erro durante salvar o registo, por favor tente novamente";
                header("location: maquina.php");
                exit();
            endif;
        } catch (Exception $ex) {
            Erro::trataErro($ex);
        }
    } else if (isset($_POST['editar'])) {

        try {
            $maquina->setId($_POST['id']);
            $maquina->setNome($_POST['nome']);
            $maquina->setPostoGraduacao($_POST['pg']);
            $maquina->setMilitar($_POST['militar']);
            $maquina->setFuncao($_POST['funcao']);
            $maquina->setSecao($_POST['secao']);
            $maquina->setIp($_POST['ip']);
            $maquina->setMac($_POST['mac']);
            $maquina->setNumPatrimonio($_POST['numPatrimonio']);
            $maquina->setSistemaOperacional($_POST['so']);
            $maquina->setSoLicenciado($_POST['licenca']);
            $maquina->setObservacao($_POST['observacao']);
            $maquina->setUsuario($_POST['usuario']);

            if ($maquina->update()) :
                $_SESSION['msgSucesso'] = "Maquina editada com sucesso!";
                header("location: maquina.php");
                exit();
            else :
                $_SESSION['msgErro'] = "Ocorreu um erro durante alterar o registo, por favor tente novamente";
                header("location: maquina.php");
                exit();
            endif;
        } catch (Exception $ex) {
            Erro::trataErro($ex);
        }
    } else if ($_GET['acao'] == 'deletar' && $_GET['id'] != 0) {

        try {
            $id = $_GET['id'];

            if ($maquina->delete($id)) :
                $_SESSION['msgSucesso'] = "Maquina excluido com sucesso!";
                header("location: maquina.php");
                exit();
            else :
                $_SESSION['msgErro'] = "Ocorreu um erro durante a exclusão do registo, por favor tente novamente";
                header("location: maquina.php");
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
