<?php
require_once 'include/topo.php';
require_once 'classes.php';

$maquina = new Curso();

?>
<div class="container-fluid">
    <h1>Cursos</h1>
<table id="listar" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Curso</th>
                </tr>
            </thead>
            <?php foreach ($maquina->findAll() as $key => $value) : ?>
                <tr>
                    <td><?php echo $value->id; ?></td>
                    <td><?php echo $value->sigla . " - " . $value->nome; ?></td>
                </tr>
            <?php endforeach;?>
</table>
</div>


<?php require_once 'include/rodape.php'?>

<script>
   $(document).ready(function() {
        $('#listar').dataTable();
    } );
</script>