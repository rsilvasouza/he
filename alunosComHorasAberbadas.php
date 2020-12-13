<?php
require_once 'include/topo.php';
require_once 'classes.php';

$alunoAtividade = new AlunoAtividade();
$aluno = new Aluno();

?>
<div class="container-fluid">
    <div class="form-row">
        <div class="form-group col-md-10">
            <h1>Horas Averbadas</h1>
        </div>
    </div>
    <table id="listar" class="display" style="width:100%">
        <thead class="text-center">
            <tr>
                <th>Matricula</th>
                <th>Aluno</th>
                <th>Curso</th>
                <th>Horas</th>
                <th></th>
            </tr>
        </thead>
        <?php foreach ($aluno->listarAlunosComHorasAverbadas() as $key => $value) :

        ?>
            <tr>
                <td><?php echo $value->matricula; ?></td>
                <td><?php echo $value->aluno; ?></td>
                <td><?php echo $value->curso . " - " . $aluno->turno($value->turno); ?></td>
                <td><?php echo substr($value->horas,0,5) . ' / 100h'; ?></td>
                <td><?php echo "<a class='btn btn-info' target='_blank' href='relatorioFinal.php?aluno={$value->matricula}'><i class='fas fa-file-signature'></i></a>"?></td>

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