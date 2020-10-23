 <?php
    session_start();
    require_once 'classes.php';

    $atividade = new Atividade();


    if (isset($_POST['cadastrar'])) {

        try {
           $atividade->setNome($_POST['nome']);
           $atividade->setModo_comprovacao($_POST['modo_comprovacao']);
           $atividade->setMaxHoras($_POST['maxHoras']);
           $atividade->setDataRegistro(date('Y-m-d H:i:s'));
            # Insert
            if ($atividade->insert()) :
                $_SESSION['msgSucesso'] = "Atividade cadastrada com sucesso!";
                header("location: atividade.php");
                exit();
            else :
                $_SESSION['msgErro'] = "Ocorreu um erro durante salvar o registo, por favor tente novamente";
                header("location: atividade.php");
                exit();
            endif;
        } catch (Exception $ex) {
            Erro::trataErro($ex);
        }
    } else if (isset($_POST['editar'])) {

        try {
            $atividade->setId($_POST['id']);
            $atividade->setNome($_POST['nome']);
            $atividade->setModo_comprovacao($_POST['modo_comprovacao']);
            $atividade->setMaxHoras($_POST['maxHoras']);

            if ($atividade->update()) :
                $_SESSION['msgSucesso'] = "Atividade editada com sucesso!";
                header("location: atividade.php");
                exit();
            else :
                $_SESSION['msgErro'] = "Ocorreu um erro durante alterar o registo, por favor tente novamente";
                header("location: atividade.php");
                exit();
            endif;
        } catch (Exception $ex) {
            Erro::trataErro($ex);
        }
    } else if (isset($_POST['excluir']) == 'excluir' && $_POST['idExcluir'] != 0) {

        try {
            $id = $_POST['idExcluir'];

            if ($atividade->delete($id)) :
                $_SESSION['msgSucesso'] = "Atividade excluida com sucesso!";
                header("location: atividade.php");
                exit();
            else :
                $_SESSION['msgErro'] = "Ocorreu um erro durante a exclusão do registo, por favor tente novamente";
                header("location: atividade.php");
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
