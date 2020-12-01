<?php
require_once "include/topo.php";
require_once 'classes.php';

$alunoAtividade = new AlunoAtividade();
$atividade = new Atividade();

$horasCadastradas = $alunoAtividade->horasCadastradas($_SESSION['idAluno']);
foreach ($horasCadastradas as $key => $value) {
    $horasCadastrada = ($value->total != NULL) ? $value->total : '0';
}

$horasAprovadas = $alunoAtividade->horasAprovadas($_SESSION['idAluno']);
foreach ($horasAprovadas as $key => $value) {
    $horasAprovada = ($value->total != NULL) ? $value->total : '0';
}


?>

<div class="container-fluid">
    <?php require_once 'include/dashboardAluno.php'; ?>

    <div class="card bg-default">
        <div class="card-body">
<h3 class="text-center">Horas Complementares</h3>
            <table id="listar" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Modo de Comprovação</th>
                        <th>Horas Máximas</th>
                        <th>Dimensão</th>
                    </tr>
                </thead>
                <?php foreach ($atividade->listarTipoAtividade() as $key => $value) : ?>
                    <tr>
                        <td><?php echo $value->nome; ?></td>
                        <td><?php echo $value->modo_comprovacao; ?></td>
                        <td><?php echo $value->max_horas; ?></td>
                        <td><?php echo $value->dimensao; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?php require_once "include/rodape.php"; ?>
<script>
    $(document).ready(function() {
        $('#listar').dataTable({
            searching: true,
            responsive: true
        });
    });
</script>