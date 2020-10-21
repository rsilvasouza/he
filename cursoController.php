 <?php
    session_start();
    require_once 'classes.php';

    $curso = new Curso();


    if (isset($_POST['cadastrar'])) {

        try {
           $curso->setNome($_POST['nome']);
           $curso->setSigla($_POST['sigla']);
            # Insert
            if ($curso->insert()) :
                $_SESSION['msgSucesso'] = "Curso cadastrado com sucesso!";
                header("location: curso.php");
                exit();
            else :
                $_SESSION['msgErro'] = "Ocorreu um erro durante salvar o registo, por favor tente novamente";
                header("location: curso.php");
                exit();
            endif;
        } catch (Exception $ex) {
            Erro::trataErro($ex);
        }
    } else if (isset($_POST['editar'])) {

        try {
            $curso->setId($_POST['id']);
            $curso->setNome($_POST['nome']);
            $curso->setSigla($_POST['sigla']);

            if ($curso->update()) :
                $_SESSION['msgSucesso'] = "Curso editado com sucesso!";
                header("location: curso.php");
                exit();
            else :
                $_SESSION['msgErro'] = "Ocorreu um erro durante alterar o registo, por favor tente novamente";
                header("location: curso.php");
                exit();
            endif;
        } catch (Exception $ex) {
            Erro::trataErro($ex);
        }
    } else if (isset($_POST['excluir']) && $_POST['idExcluir'] != 0) {

        try {
            $id = $_POST['idExcluir'];

            if ($curso->delete($id)) :
                $_SESSION['msgSucesso'] = "Curso excluido com sucesso!";
                header("location: curso.php");
                exit();
            else :
                $_SESSION['msgErro'] = "Ocorreu um erro durante a exclusão do registo, por favor tente novamente";
                header("location: curso.php");
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
