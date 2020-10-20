<?php
require_once 'include/topo.php';
require_once 'classes.php';

$alunoAtividade = new AlunoAtividade();

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
        <thead>
            <tr>
                <th>Atividade</th>
                <th>Descricao</th>
                <th>Horas</th>
                <th>Arquivo</th>
                <th>Data do Cadastro</th>
                <th>Situação</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <?php foreach ($alunoAtividade->findAtividadesCadastradas($_SESSION['idAluno']) as $key => $value) : ?>
            <tr>
                <td><?php echo $value->nome; ?></td>
                <td><?php echo $value->descricao; ?></td>
                <td><?php echo $value->horas_registradas; ?></td>
                <td><?php echo $value->arquivo; ?></td>
                <td><?php echo $value->data_registro; ?></td>
                <td><?php echo $alunoAtividade->situacao($value->status); ?></td>
                <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar" onclick="preencheDados('editar', <?php echo '\'' . $value->id . '\',' . '\'' . $value->sigla . '\',' . '\'' . $value->nome . '\'' ?>)">Editar</button>
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
            <form method="post" action="cursoController.php">
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
            <form method="post" action="cursoController.php">
                <div class="modal-body text-left">
                    <input type="hidden" value="<?php echo $value->id; ?>" name="id" id="id">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Sigla</label>
                            <input type="text" name="sigla" id="sigla" class="form-control" aria-describedby="helpId">
                        </div>

                        <div class="form-group col-md-8">
                            <label>Nome do Curso</label>
                            <input type="text" name="nome" id="nome" class="form-control" aria-describedby="helpId">
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
                <h5 class="modal-title">Cadastro de Curso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="cursoController.php">
                <div class="modal-body text-left">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Sigla</label>
                            <input type="text" name="sigla" id="sigla" class="form-control" aria-describedby="helpId">
                        </div>

                        <div class="form-group col-md-8">
                            <label>Nome do Curso</label>
                            <input type="text" name="nome" id="nome" class="form-control" aria-describedby="helpId">
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
            searching: false
        });
    });

    function preencheDados(tipo, id, sigla, nome) {
        if (tipo == 'editar') {
            $('#id').val(id);
            $('#sigla').val(sigla);
            $('#nome').val(nome);

        } else if (tipo == 'excluir') {
            $('#idExcluir').val(id);
        }

    }
</script>