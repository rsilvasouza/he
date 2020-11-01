<?php 
require_once "include/topo.php";
require_once 'classes.php';

$alunoAtividade = new AlunoAtividade();

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

</div>

<?php require_once "include/rodape.php"; ?>