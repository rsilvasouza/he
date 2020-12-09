<?php
require_once 'include/topo.php';
require_once 'classes.php';

$alunoAtividade = new AlunoAtividade();
$atividades = new Atividade();

?>
<div class="container-fluid">
    <div class="form-row">
        <div class="form-group col-md-12">
            <h1>Atividades Aberbadas</h1>
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
            </tr>
        </thead>
        <?php foreach ($alunoAtividade->findAtividadesAverbadas($_SESSION['idAluno']) as $key => $value) :
            $periodo = ($value->data_inicial == $value->data_final) ? date("d/m/Y", strtotime($value->data_inicial)) : date("d/m/Y", strtotime($value->data_inicial)) . " - " . date("d/m/Y", strtotime($value->data_final));
            $motivo = ($value->motivo == NULL) ? '' : " - " . $value->motivo;
            $arquivo =  "<a class='btn btn-info' href='arquivos/{$value->arquivo}' download='{$value->descricao}'>
                                <i class='fas fa-cloud-download-alt'></i>
                            </a>";
        ?>
            <tr>
                <td><?php echo $value->descricao; ?></td>
                <td><?php echo $value->nome; ?></td>
                <td class="text-center"><?php echo $periodo; ?> </td>
                <td class="text-center"><?php echo $value->carga_horaria; ?></td>
                <td class="text-center"><?php echo $alunoAtividade->situacao($value->status) . $motivo; ?></td>
                <td class="text-center">
                    <?php echo $arquivo; ?>
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
            responsive: true
        });
    });

</script>