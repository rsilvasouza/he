<?php
require_once "include/topo.php";
require_once 'classes.php';
if ($_SESSION['perfil'] == 2) header("Location: aluno.php");


$alunoAtividade = new AlunoAtividade();
$aluno = new Aluno();

$atividadesEmAnalise = $alunoAtividade->atividadesEmAnalise();
foreach ($atividadesEmAnalise as $key => $value) {
    $atividadesCadastradasEmAnalise = ($value->total != NULL) ? $value->total : '0';
}

$contasCadastradas = $aluno->contasCadastradas();
foreach ($contasCadastradas as $key => $value) {
    $contas = ($value->total != NULL) ? $value->total : '0';
}
?>

<div class="container-fluid">
    <?php require_once 'include/dashboardAdmin.php';?>


</div>

<?php require_once "include/rodape.php";
