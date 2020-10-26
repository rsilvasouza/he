 <?php
    session_start();
    require_once 'classes.php';

    $alunoAtividade = new AlunoAtividade();


    if (isset($_POST['cadastrar'])) {

        try {

            $alunoAtividade->setDescricao($_POST['descricao']);
            $alunoAtividade->setAtividadeId($_POST['atividade']);
            $alunoAtividade->setHoras($_POST['horas']);
            $alunoAtividade->setDataAtividade($_POST['data']);
            $alunoAtividade->setAlunoId($_SESSION['idAluno']);

            if (!empty($_FILES['arquivo']['name'])) {
                $formatosPermitidos = array("png", "jpep", "jpg", "gif");
                $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);

                if (in_array($extensao, $formatosPermitidos)) {
                    $pasta = "arquivos/";
                    $temporario = $_FILES['arquivo']['tmp_name'];
                    $novoNome = uniqid() . ".$extensao";
                    $alunoAtividade->setArquivo($novoNome);

                    if (move_uploaded_file($temporario, $pasta . $novoNome)) {
                        if ($alunoAtividade->insert()) :
                            $_SESSION['msgSucesso'] = "Atividade cadastrada com sucesso!";
                            header("location: atividadeAluno.php");
                            exit();
                        else :
                            $_SESSION['msgErro'] = "Ocorreu um erro durante salvar o registo, por favor tente novamente";
                            header("location: atividadeAluno.php");
                            exit();
                        endif;
                    } else {
                        $_SESSION['msgInfo'] = "Ops! Erro ao salvar arquivo!";
                        header("location: atividadeAluno.php");
                        exit();
                    }

                    $_SESSION['msgErro'] = "O <b>formato do arquivo</b> informado não é válido";
                    header("location: atividadeAluno.php");
                    exit();
                }
            } else {
                $alunoAtividade->setArquivo('');
                if ($alunoAtividade->insert()) :
                    $_SESSION['msgSucesso'] = "Atividade cadastrada com sucesso!";
                    header("location: atividadeAluno.php");
                    exit();
                else :
                    $_SESSION['msgErro'] = "Ocorreu um erro durante salvar o registo, por favor tente novamente";
                    header("location: atividadeAluno.php");
                    exit();
                endif;
            }
        } catch (Exception $ex) {
            Erro::trataErro($ex);
        }
    }
    //  else if (isset($_POST['editar'])) {

    //     try {
    //         $curso->setId($_POST['id']);
    //         $curso->setNome($_POST['nome']);
    //         $curso->setSigla($_POST['sigla']);

    //         if ($curso->update()) :
    //             $_SESSION['msgSucesso'] = "Curso editado com sucesso!";
    //             header("location: curso.php");
    //             exit();
    //         else :
    //             $_SESSION['msgErro'] = "Ocorreu um erro durante alterar o registo, por favor tente novamente";
    //             header("location: curso.php");
    //             exit();
    //         endif;
    //     } catch (Exception $ex) {
    //         Erro::trataErro($ex);
    //     }
    // } else if (isset($_POST['excluir']) && $_POST['idExcluir'] != 0) {

    //     try {
    //         $id = $_POST['idExcluir'];

    //         if ($curso->delete($id)) :
    //             $_SESSION['msgSucesso'] = "Curso excluido com sucesso!";
    //             header("location: curso.php");
    //             exit();
    //         else :
    //             $_SESSION['msgErro'] = "Ocorreu um erro durante a exclusão do registo, por favor tente novamente";
    //             header("location: curso.php");
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
