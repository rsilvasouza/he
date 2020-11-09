<?php
require_once 'include/topo.php';
require_once 'classes.php';

$alunoAtividade = new AlunoAtividade();
$aluno = new Aluno();

?>
<div class="container-fluid">
    <div class="form-row">
        <div class="form-group col-md-10">
            <h1>Alunos com atividades Cadastradas</h1>
        </div>
    </div>
    <table id="listar" class="display" style="width:100%">
        <thead class="text-center">
            <tr>
                <th>Matricula</th>
                <th>Aluno</th>
                <th>Curso</th>
                <th>Tipo de Atividade</th>
                <th>Carga Horária</th>
                <th>Situação</th>
                <th>Arquivos</th>
            </tr>
        </thead>
        <?php foreach ($aluno->listarAlunosComAtividade() as $key => $value) :

        ?>
            <tr>
                <td><?php echo $value->matricula; ?></td>
                <td><?php echo $value->aluno; ?></td>
                <td><?php echo $value->curso . " - " . $aluno->turno($value->turno); ?></td>
                <td><?php echo $value->atividade; ?></td>
                <td><?php echo substr($value->carga_horaria,0,5) . 'h'; ?></td>
                <td><?php echo $alunoAtividade->situacao($value->status); ?></td>
                <td class="text-center">
                    <a class="btn btn-info" href="arquivos/<?php echo $value->arquivo; ?>" download="<?php echo $value->descricao; ?>">
                        <i class="fas fa-cloud-download-alt"></i> Download
                    </a>
                </td>

            </tr>




        <?php endforeach; ?>
    </table>
</div>

<?php require_once 'include/rodape.php' ?>

<script>
    $(document).ready(function() {
        $('#listar').dataTable({
            searching: true,
            responsive: true,
            dom: 'Bfrtip',
            buttons: [{
                extend: 'print',
                name: 'Imprimir'
            }]
        });
    });
</script>