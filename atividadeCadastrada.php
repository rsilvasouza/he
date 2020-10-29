<?php
require_once 'include/topo.php';
require_once 'classes.php';

$alunoAtividade = new AlunoAtividade();
$atividade = new Atividade();

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
                <th>Matricula</th>
                <th>Aluno</th>    
                <th>Nome da Atividade</th>
                <th>Tipo de Atividade</th>
                <th>Período da Atividade</th>
                <th>Carga Horária</th>
                <th>Arquivo</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <?php foreach ($alunoAtividade->listarAtividadeCadastrada() as $key => $value) : 
            $periodo = ($value->data_inicial == $value->data_final) ? date("d/m/Y", strtotime($value->data_inicial)) : date("d/m/Y", strtotime($value->data_inicial)) . " - " . date("d/m/Y", strtotime($value->data_final));
        ?>
            <tr>
                <td><?php echo $value->matricula; ?></td>
                <td><?php echo $value->aluno; ?></td>
                <td><?php echo $value->descricao; ?></td>
                <td><?php echo $value->nome; ?></td>
                <td class="text-center"><?php echo $periodo; ?> </td>
                <td class="text-center"><?php echo $value->carga_horaria; ?></td>
                <td class="text-center">
                    <a class="btn btn-info" href="arquivos/<?php echo $value->arquivo; ?>" download="<?php echo $value->descricao; ?>">
                        <i class="fas fa-cloud-download-alt"></i> Download
                    </a>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#aprovar" onclick="preencheDados('aprovar', <?php echo '\'' . $value->id . '\''?>)">Aprovar</button>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#rejeitar" onclick="preencheDados('rejeitar', <?php echo $value->id; ?>)">Rejeitar</button>
                </td>
            </tr>




        <?php endforeach; ?>
    </table>
</div>
<!-- Modal Excluir -->
<div class="modal fade" id="aprovar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Deseja Aprovar essa Atividade?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="alunoAtividadeController.php">
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
<div class="modal fade" id="rejeitar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rejeitar Atividade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form enctype="multipart/form-data" method="post" action="alunoAtividadeController.php">
                <div class="modal-body text-left">
                <input type="hidden" name="idRejeitar" id="idRejeitar">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Motivo</label>
                            <input type="text" name="motivo" id="motivo" class="form-control" aria-describedby="helpId">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="rejeitar" class="btn btn-danger">Rejeitar</button>
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

    function preencheDados(tipo, id) {
        if (tipo == 'rejeitar') {
            $('#idRejeitar').val(id);
            
        } else if (tipo == 'aprovar') {
            $('#idAprovar').val(id);
        }
    }

    // function validaPeriodo(dataInicial, dataFinal){
    //     if(dataFinal < dataInicial){
    //         document.getElementById("botao").disabled = true;
    //         return elemento.style.backgroundColor = "yellow";
    //     }else{
    //         document.getElementById("botao").disabled = false;
    //         return elemento.style.backgroundColor = "";
    //     }
    // }
</script>