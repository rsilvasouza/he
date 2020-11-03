<?php
require_once 'include/topo.php';
require_once 'include/verificaAcesso.php';
require_once 'classes.php';

$aluno = new Aluno();

?>
<div class="container-fluid">
    <h1>Alunos Pré Cadastrados</h1>
    
<table id="listar" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Matricula</th>
                    <th>Curso</th>
                    <th>Nome</th>
                    <th>email</th>
                    <th>turno</th>
                    <th></th>

                </tr>
            </thead>
            <?php foreach ($aluno->findPreCadastrado() as $key => $value) : ?>

                <tr>
                    <td><?php echo $value->matricula; ?></td>
                    <td><?php echo $value->sigla . " - " . $value->curso; ?></td>
                    <td><?php echo $value->nome; ?></td>
                    <td><?php echo $value->email; ?></td>
                    <td><?php echo $aluno->turno($value->turno); ?></td>
                    <td>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#aprovar" onclick="preencheDados('aprovar', <?php echo $value->id; ?>)">Aprovar</button>
                    </td>
                </tr>

                

                
            <?php endforeach;?>
</table>
</div>
                <!-- Modal aprovar -->
                <div class="modal fade" id="aprovar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Deseja aprovar esse registro?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="alunoController.php">
                            <input type="hidden" name="idAprovar" id="idAprovar">
                                
                                <div class="modal-footer">
                                    <button type='submit' name="aprovar" class='btn btn-success'>Aprovar</button>
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

<?php require_once 'include/rodape.php'?>

<script>
   $(document).ready(function() {
        $('#listar').dataTable({
            searching: false,
            responsive: true
        });
    } );

    function preencheDados(tipo, id, sigla, nome) {
        if(tipo == 'editar'){
            $('#id').val(id);
            $('#sigla').val(sigla);
            $('#nome').val(nome);
            
        }else if(tipo == 'aprovar'){
            $('#idAprovar').val(id);
        }

    }
</script>