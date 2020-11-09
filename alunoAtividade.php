<?php
require_once 'include/topo.php';
require_once 'classes.php';

$alunoAtividade = new AlunoAtividade();
$atividades = new Atividade();

?>
<div class="container-fluid">
    <div class="form-row">
        <div class="form-group col-md-10">
            <h1>Atividades Cadastradas</h1>
        </div>
        <div class="form-group col-md-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastrar">Cadastrar</button>
        </div>
    </div>
    <table id="listar" class="display" style="width:100%">
        <thead class="text-center">
            <tr>
                <th>Nome da Atividade</th>
                <th>Tipo de Atividade</th>
                <th>Período da Atividade</th>
                <th>Carga Horária</th>
                <th>Situação</th>
                <th>Arquivo</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <?php foreach ($alunoAtividade->findAtividadesCadastradas($_SESSION['idAluno']) as $key => $value) : 
            $periodo = ($value->data_inicial == $value->data_final) ? date("d/m/Y", strtotime($value->data_inicial)) : date("d/m/Y", strtotime($value->data_inicial)) . " - " . date("d/m/Y", strtotime($value->data_final));
            $motivo = ($value->motivo == NULL) ? '' : " - " . $value->motivo;
        ?>
            <tr>
                <td><?php echo $value->descricao; ?></td>
                <td><?php echo $value->nome; ?></td>
                <td class="text-center"><?php echo $periodo; ?> </td>
                <td class="text-center"><?php echo $value->carga_horaria; ?></td>
                <td class="text-center"><?php echo $alunoAtividade->situacao($value->status) . $motivo; ?></td>
                <td class="text-center">
                    <a class="btn btn-info" href="arquivos/<?php echo $value->arquivo; ?>" download="<?php echo $value->descricao; ?>">
                        <i class="fas fa-cloud-download-alt"></i> Download
                    </a>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar" onclick="preencheDados('editar', <?php echo '\'' . $value->id . '\',' . '\'' . $value->descricao . '\',' . '\'' . $value->atividade_id . '\',' . '\'' . $value->data_inicial . '\',' . '\'' . $value->data_final . '\',' . '\'' . $value->carga_horaria . '\',' . '\'' . $value->arquivo . '\','?>)">Editar</button>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir" onclick="preencheDados('excluir', <?php echo $value->id; ?>)">Excluir</button>
                </td>
            </tr>




        <?php endforeach; ?>
    </table>
</div>
<!-- Modal Excluir -->
<div class="modal fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Deseja Excluir esse registro?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="">
                <input type="hidden" name="idExcluir" id="idExcluir">

                <div class="modal-footer">
                    <button type='submit' name="excluir" class='btn btn-danger'>Excluir</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edição de Curso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form enctype="multipart/form-data" method="post" action="alunoAtividadeController.php">
                <div class="modal-body text-left">
                    <input type="hidden" value="<?php echo $value->id; ?>" name="id" id="id">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Nome da Atividade</label>
                            <input type="text" name="descricao" id="descricao" class="form-control" aria-describedby="helpId">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Tipo de Atividade</label>
                            <select class="form-control" name="atividade" id="atividade">
                                <option value="">Selecione</option>
                                <?php foreach ($atividades->findAll() as $key => $atividade) : ?>
                                    <option value="<?php echo $atividade->id; ?>" <?php echo ($atividade->id == $value->atividade_id) ? 'selected' : ''; ?>><?php echo $atividade->nome; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Período da Atividade</label>
                            <input type="date" name="dataInicial" id="dataInicial" class="form-control" aria-describedby="helpId">
                        </div>

                        <div class="form-group col-md-6">
                            <label>&nbsp;</label>
                            <input type="date" name="dataFinal" id="dataFinal" class="form-control" aria-describedby="helpId">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Carga Horária</label>
                            <input type="time" name="cargaHoraria" id="cargaHoraria" class="form-control" aria-describedby="helpId">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Anexar Arquivo</label>
                            <input type="file" name="arquivo" id="arquivo" class="form-control-file" aria-describedby="helpId">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="editar" class="btn btn-success">Editar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Cadastrar -->
<div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastro de Atividades</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post" action="alunoAtividadeController.php">
                <div class="modal-body text-left">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Nome da Atividade</label>
                            <input type="text" name="descricao" id="descricao" class="form-control" aria-describedby="helpId">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Tipo de Atividade</label>
                            <select class="form-control" name="atividade" id="atividade">
                                <option value="">Selecione</option>
                                <?php foreach ($atividades->findAll() as $key => $atividade) : ?>
                                    <option value="<?php echo $atividade->id; ?>"><?php echo $atividade->nome; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Período da Atividade</label>
                            <input type="date" name="dataInicial" id="dataInicial" class="form-control" aria-describedby="helpId">
                        </div>

                        <div class="form-group col-md-6">
                            <label>&nbsp;</label>
                            <input type="date" name="dataFinal" id="dataFinal" class="form-control" aria-describedby="helpId">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Carga Horária</label>
                            <input type="time" name="cargaHoraria" id="cargaHoraria" class="form-control" aria-describedby="helpId">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Anexar Arquivo</label>
                            <input type="file" name="arquivo" id="arquivo" class="form-control-file" aria-describedby="helpId">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="cadastrar" id="botao" class="btn btn-success">Salvar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'include/rodape.php' ?>

<script>
    $(document).ready(function() {
        $('#listar').dataTable({
            searching: false,
            responsive: true
        });
    });

    function preencheDados(tipo, id, descricao, atividade, dataInicial, dataFinal, cargaHoraria) {
        if (tipo == 'editar') {
            $('#id').val(id);
            $('#descricao').val(descricao);
            $('#atividade').val(atividade);
            $('#dataInicial').val(dataInicial);
            $('#dataFinal').val(dataFinal);
            $('#cargaHoraria').val(cargaHoraria);
        } else if (tipo == 'excluir') {
            $('#idExcluir').val(id);
        }
    }

    // function validaPeriodo(dataInicial, dataFinal){
    //     if(dataFinal < dataInicial){
    //         document.getElementById("botao").disabled = true;
    //         console.log(dataInicial);
    //         console.log(dataFinal);
    //         return alert ('Período inválido!');
    //     }else{
    //         document.getElementById("botao").disabled = false;
    //         return elemento.style.backgroundColor = "";
    //     }
    // }
</script>