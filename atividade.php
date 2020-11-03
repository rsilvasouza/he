<?php
require_once 'include/topo.php';
require_once 'include/verificaAcesso.php';
require_once 'classes.php';

$atividade = new Atividade();

?>
<div class="container-fluid">
<div class="form-row">
        <div class="form-group col-md-10">
            <h1>Atividades</h1>
        </div>
        <div class="form-group col-md-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastrar">Cadastrar</button>
        </div>
    </div>
    <table id="listar" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Modo de Comprovação</th>
                <th>Horas Máximas</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <?php foreach ($atividade->findAll() as $key => $value) : ?>
            <tr>
                <td><?php echo $value->id; ?></td>
                <td><?php echo $value->nome; ?></td>
                <td><?php echo $value->modo_comprovacao; ?></td>
                <td><?php echo $value->max_horas; ?></td>
                <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar" onclick="preencheDados('editar', <?php echo '\'' . $value->id . '\',' . '\'' . $value->nome . '\',' . '\'' . $value->modo_comprovacao . '\',' . '\'' . $value->max_horas . '\'' ?>)">Editar</button>
                </td>
                <td>
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
            <form method="post" action="atividadeController.php">
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
            <form method="post" action="atividadeController.php">
                <div class="modal-body text-left">
                    <input type="hidden" name="id" id="id">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label>Nome Atividade</label>
                            <input type="text" name="nome" id="nome" class="form-control" aria-describedby="helpId">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Horas Máximas</label>
                            <input type="text" name="maxHoras" id="maxHoras" class="form-control" aria-describedby="helpId">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Modo de Comprovação</label>
                            <input type="text" name="descricao" id="descricao" class="form-control" aria-describedby="helpId">
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

<!-- Modal Cadastro -->
<div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastro de Atividade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="atividadeController.php">
                <div class="modal-body text-left">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label>Nome Atividade</label>
                            <input type="text" name="nome" id="nome" class="form-control" aria-describedby="helpId">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Horas Máximas</label>
                            <input type="text" name="maxHoras" id="maxHoras" class="form-control" aria-describedby="helpId">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Modo de Comprovação</label>
                            <input type="text" name="descricao" id="descricao" class="form-control" aria-describedby="helpId">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="cadastrar" class="btn btn-success">Salvar</button>
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

    function preencheDados(tipo, id, nome, modo_comprovacao, maxHoras) {

        if(tipo == 'editar'){
            $('#id').val(id);
            $('#nome').val(nome);
            $('#descricao').val(modo_comprovacao);
            $('#maxHoras').val(maxHoras);
            
        }else if(tipo == 'excluir'){
            $('#idExcluir').val(id);
        }

    }
</script>