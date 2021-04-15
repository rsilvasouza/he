 <?php
    session_start();
    require_once 'classes.php';

    $alunoAtividade = new AlunoAtividade();
    $atividade = new Atividade();

    function somaCargaHoraria($somaCargaHoraria, $maxHorasPorAtividade)
    {
    }

    if (isset($_POST['cadastrar'])) {

        $alunoAtividade->setDescricao($_POST['descricao']);
        $alunoAtividade->setAtividadeId($_POST['atividade']);
        $alunoAtividade->setCargaHoraria($_POST['cargaHoraria']);
        $alunoAtividade->setDataInicial($_POST['dataInicial']);
        $alunoAtividade->setDataFinal((empty($_POST['dataFinal']) ? $_POST['dataInicial'] : $_POST['dataFinal']));
        $alunoAtividade->setHoraInicial($_POST['horaInicial']);
        $alunoAtividade->setHoraFinal($_POST['horaFinal']);
        $alunoAtividade->setAlunoId($_SESSION['idAluno']);
        $alunoAtividade->setObservacao($_POST['observacao']);

        if (!empty($_FILES['arquivo']['name'])) {
            $formatosPermitidos = array("png", "jpeg", "jpg", "pdf");
            $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);

            if (in_array($extensao, $formatosPermitidos)) {
                $pasta = "arquivos/";
                $temporario = $_FILES['arquivo']['tmp_name'];
                $novoNome = uniqid() . ".$extensao";
                $alunoAtividade->setArquivo($novoNome);

                if (move_uploaded_file($temporario, $pasta . $novoNome)) {
                    cadastraAlunoAtividade($alunoAtividade);
                } else {
                    $_SESSION['msgInfo'] = "Ops! Erro ao salvar arquivo!";
                    header("location: alunoAtividade.php");
                    exit();
                }
            } else {
                $_SESSION['msgInfo'] = "O formato do arquivo informado <b>não é válido</b>";
                header("location: alunoAtividade.php");
                exit();
            }
        } else {
            $alunoAtividade->setArquivo('');
            cadastraAlunoAtividade($alunoAtividade);
        }
    } else if (isset($_POST['aprovar']) && $_POST['idAprovar'] != 0) {

        try {
            $id = $_POST['idAprovar'];
            $idAluno = $_POST['idAluno'];
            $idAtividade = $_POST['idAtividade'];
            $cargaHoraria = $_POST['cargaHoraria'];
            $status = 1;

            //Busca Carga Horária
            $cargaHorariaAtividade = $atividade->listarAtividade($idAtividade);
            $cargaHorariaAtividadeMinutos = horaParaMinutos($cargaHorariaAtividade . ":00");

            //Busca Horas Aprovadas
            $horasTotaisAprovadas = $alunoAtividade->somarCargaHorariaPorTipo($idAtividade, $idAluno);
            $horasTotaisAprovadasMinutos = horaParaMinutos($horasTotaisAprovadas);

            $soma = $horasTotaisAprovadasMinutos + horaParaMinutos($cargaHoraria);


            if ($horasTotaisAprovadasMinutos >= $cargaHorariaAtividadeMinutos) {

                $motivo = "A atividade informada já chegou ao limite máximo de horas necessárias";
                $status = 0;

                if ($alunoAtividade->rejeitar($id, $motivo, $status)) :
                    $_SESSION['msgSucesso'] = "Atividade aprovada com sucesso!";
                    header("location: atividadeCadastrada.php");
                    exit();
                else :
                    $_SESSION['msgErro'] = "Ocorreu um erro durante a aprovação do registo, por favor tente novamente";
                    header("location: atividadeCadastrada.php");
                    exit();
                endif;
            } else if ($soma > $cargaHorariaAtividadeMinutos) {


                $subtrai = $soma - $cargaHorariaAtividadeMinutos;
                $cargaHorariaAtualizada = horaParaMinutos($cargaHoraria) - $subtrai;
                $sobra = minutosParaHoras($cargaHorariaAtualizada);

                //APROVA ATIVIDADE COM CARGA HORARIA ATUALIZADA
                if ($alunoAtividade->aprovarComCargaHoraria($id, $status, $sobra)) :
                    $_SESSION['msgSucesso'] = "Atividade aprovada com sucesso!";
                    header("location: atividadeCadastrada.php");
                    exit();
                else :
                    $_SESSION['msgErro'] = "Ocorreu um erro durante a aprovação do registo, por favor tente novamente";
                    header("location: atividadeCadastrada.php");
                    exit();
                endif;
            } else {
                //APROVA ATIVIDADE
                if ($alunoAtividade->aprovar($id, $status)) :
                    $_SESSION['msgSucesso'] = "Atividade aprovada com sucesso!";
                    header("location: atividadeCadastrada.php");
                    exit();
                else :
                    $_SESSION['msgErro'] = "Ocorreu um erro durante a aprovação do registo, por favor tente novamente";
                    header("location: atividadeCadastrada.php");
                    exit();
                endif;
            }
        } catch (Exception $ex) {
            Erro::trataErro($ex);
        }
    } else if (isset($_POST['rejeitar']) && $_POST['idRejeitar'] != 0) {

        try {
            $id = $_POST['idRejeitar'];
            $motivo = $_POST['motivo'];
            $status = 0;

            if ($alunoAtividade->rejeitar($id, $motivo, $status)) :
                $_SESSION['msgSucesso'] = "Atividade <b>Rejeitada</b> com sucesso!";
                header("location: atividadeCadastrada.php");
                exit();
            else :
                $_SESSION['msgErro'] = "Ocorreu um erro durante a rejeição do registo, por favor tente novamente";
                header("location: atividadeCadastrada.php");
                exit();
            endif;
        } catch (Exception $ex) {
            Erro::trataErro($ex);
        }
    } else if (isset($_POST['editar'])) {

        try {
            $alunoAtividade->setId($_POST['id']);
            $alunoAtividade->setDescricao($_POST['descricao']);
            $alunoAtividade->setAtividadeId($_POST['atividade']);
            $alunoAtividade->setCargaHoraria($_POST['cargaHoraria']);
            $alunoAtividade->setDataInicial($_POST['dataInicial']);
            $alunoAtividade->setDataFinal((empty($_POST['dataFinal']) ? $_POST['dataInicial'] : $_POST['dataFinal']));
            $alunoAtividade->setAlunoId($_SESSION['idAluno']);
            $alunoAtividade->setHoraInicial($_POST['horaInicial']);
            $alunoAtividade->setHoraFinal($_POST['horaFinal']);
            $alunoAtividade->setObservacao($_POST['observacao']);

            if (!empty($_FILES['arquivo']['name'])) {
                $formatosPermitidos = array("png", "jpeg", "jpg", "pdf");
                $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);

                if (in_array($extensao, $formatosPermitidos)) {
                    $pasta = "arquivos/";
                    $temporario = $_FILES['arquivo']['tmp_name'];
                    $novoNome = uniqid() . ".$extensao";
                    $alunoAtividade->setArquivo($novoNome);

                    if (move_uploaded_file($temporario, $pasta . $novoNome)) {
                        if ($alunoAtividade->update()) :
                            $_SESSION['msgSucesso'] = "Atividade Editada com sucesso!";
                            header("location: alunoAtividade.php");
                            exit();
                        else :
                            $_SESSION['msgErro'] = "Ocorreu um erro durante salvar o registo, por favor tente novamente";
                            header("location: alunoAtividade.php");
                            exit();
                        endif;
                    } else {
                        $_SESSION['msgInfo'] = "Ops! Erro ao salvar arquivo!";
                        header("location: alunoAtividade.php");
                        exit();
                    }
                } else {
                    $_SESSION['msgInfo'] = "O formato do arquivo informado <b>não é válido</b>";
                    header("location: alunoAtividade.php");
                    exit();
                }
            } else {
                $alunoAtividade->setArquivo('');
                if ($alunoAtividade->updateSemArquivo()) :
                    $_SESSION['msgSucesso'] = "Atividade Editada com sucesso!";
                    header("location: alunoAtividade.php");
                    exit();
                else :
                    $_SESSION['msgErro'] = "Ocorreu um erro durante salvar o registo, por favor tente novamente";
                    header("location: alunoAtividade.php");
                    exit();
                endif;
            }
        } catch (Exception $ex) {
            Erro::trataErro($ex);
        }
    } else if (isset($_POST['excluir']) && $_POST['idExcluir'] != 0) {

        try {
            $id = $_POST['idExcluir'];

            if ($alunoAtividade->delete($id)) :
                $_SESSION['msgSucesso'] = "Atividade excluida com sucesso!";
                header("location: alunoAtividade.php");
                exit();
            else :
                $_SESSION['msgErro'] = "Ocorreu um erro durante a exclusão do registo, por favor tente novamente";
                header("location: alunoAtividade.php");
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


    function cadastraAlunoAtividade($alunoAtividade)
    {

        $atividade = new Atividade();
        $dimensao = new Dimensao();

        //Validação por dimensão
        $idDimensao = $atividade->buscaIdDimensao($alunoAtividade->getAtividadeId());
        $somaHorasTipoAtividade = $alunoAtividade->somarCargaHorariaPorTipoAtividade($alunoAtividade->getAlunoId(), $idDimensao);
        $horaMaxDimensao = $dimensao->buscaHoraMaxDimensao($idDimensao);

        //Validação horas por tipo
        $somaAtividade = $alunoAtividade->somarCargaHorariaPorTipo($alunoAtividade->getAtividadeId(), $alunoAtividade->getAlunoId());
        $horaMaxAtividade = $atividade->listarAtividade($alunoAtividade->getAtividadeId());


        if ($somaAtividade < $horaMaxAtividade) {
            if ($somaHorasTipoAtividade < $horaMaxDimensao) {
                if ($alunoAtividade->insert()) {
                    $_SESSION['msgSucesso'] = "Atividade cadastrada com sucesso!";
                    header("location: alunoAtividade.php");
                    exit();
                } else {
                    $_SESSION['msgErro'] = "Ocorreu um erro durante salvar o registo, por favor tente novamente";
                    header("location: alunoAtividade.php");
                    exit();
                }
            } else {

                $_SESSION['msgWarning'] = "O <strong>tipo de Atividade</strong> informado já atingiu o limite de horas previstas na <strong>Dimensão</strong>!";
                header("location: alunoAtividade.php");
                exit();
            }
        } else {
            $_SESSION['msgWarning'] = "O <strong>tipo de Atividade</strong> informado já atingiu o limite de horas previstas!";
            header("location: alunoAtividade.php");
            exit();
        }
    }

    function horaParaMinutos($hora)
    {
        $partes = explode(":", $hora);
        $minutos = $partes[0] * 60 + $partes[1];

        return ($minutos);
    }

    function minutosParaHoras($minutos)
    {

        $horas = floor($minutos / 60);
        $minutos = $minutos % 60;
        $minutos = ($minutos === 0) ? "00" : $minutos;

        $hora = $horas . ":" . $minutos;

        return $hora;
    }
