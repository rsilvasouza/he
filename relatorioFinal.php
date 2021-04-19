<?php
require_once 'classes.php';

$matricula = $_GET['aluno'];

$aluno = new Aluno();

$alunos = $aluno->buscarAluno($matricula);
foreach ($alunos as $key => $value) :
endforeach;

$atividade = new AlunoAtividade();

$somaNota = $atividade->horasAprovadas($value->id);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Final</title>
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.css">
</head>

<body>
    <div class="container-fluid">
        <div class="text-center">
            <img src="img/brasao.png" alt="" width="150" height="150">
            <p>
                Governo do Estado do Rio de Janeiro <br>
                Secretaria de Estado de Ciência, Tecnologia e Inovação<br>
                Fundação de Apoio à Escola Técnica
            </p>
            <p>
                <strong>QUADRO DE AVERBAÇÃO DE ATIVIDADES COMPLEMENTARES</strong> <br>
                <small>(Aprovado na reunião do Conselho Acadêmico do dia 24 de agosto de 2016)</small>
            </p>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Curso: <?php echo $value->curso; ?></h5>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Aluno:</strong> <?php echo $value->nome; ?>
                    </div>

                    <div class="col-md-4">
                        <strong>Matrícula:</strong> <?php echo $value->matricula; ?>
                    </div>
                    <div class="col-md-2">
                        <strong>Turno:</strong> <?php echo $aluno->turno($value->turno); ?>
                    </div>
                </div>


                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>Atividade</th>
                            <th>Horas averbadas</th>
                        </tr>
                    </thead>

                    <div class="card-body">
                        <?php $atividades = $atividade->buscarAtividadesAprovadasEnsino($value->id);

                        if (!empty($atividades)) {
                            echo "<thead>
                                    <tr class='text-left'>
                                        <th>Dimensão: Ensino</th>
                                        <th></th>
                                    </tr>
                                  </thead>";

                            foreach ($atividades as $key => $atv) :

                        ?>
                                <tr>
                                    <td><?php echo $atv->nome; ?></td>
                                    <td class="text-center"><?php echo substr($atv->horas, 0, 5); ?></td>
                                </tr>
                        <?php
                            endforeach;
                        } ?>
                    
                        <?php $atividades = $atividade->buscarAtividadesAprovadasPesquisa($value->id);

                        if (!empty($atividades)) {
                            echo "<thead>
                                    <tr class='text-left'>
                                        <th>Dimensão: Pesquisa</th>
                                        <th></th>
                                    </tr>
                                  </thead>";

                            foreach ($atividades as $key => $atv) :

                        ?>
                                <tr>
                                    <td><?php echo $atv->nome; ?></td>
                                    <td class="text-center"><?php echo substr($atv->horas, 0, 5); ?></td>
                                </tr>
                        <?php
                            endforeach;
                        } ?>
                  
                        <?php $atividades = $atividade->buscarAtividadesAprovadasExtensao($value->id);

                        if (!empty($atividades)) {
                            echo "<thead>
                                    <tr class='text-left'>
                                        <th>Dimensão: Extensão</th>
                                        <th></th>
                                    </tr>
                                  </thead>";

                            foreach ($atividades as $key => $atv) :

                        ?>
                                <tr>
                                    <td><?php echo $atv->nome; ?></td>
                                    <td class="text-center"><?php echo substr($atv->horas, 0, 5); ?></td>
                                </tr>
                        <?php
                            endforeach;
                        } ?>
                   
                        <?php $atividades = $atividade->buscarAtividadesAprovadasAtividadesExtras($value->id);

                        if (!empty($atividades)) {
                            echo "<thead>
                                    <tr class='text-left'>
                                        <th>Dimensão: Atividades Extras</th>
                                        <th></th>
                                    </tr>
                                  </thead>";

                            foreach ($atividades as $key => $atv) :

                        ?>
                                <tr>
                                    <td><?php echo $atv->nome; ?></td>
                                    <td class="text-center"><?php echo substr($atv->horas, 0, 5); ?></td>
                                </tr>
                        <?php
                            endforeach;
                        } ?>
                    </div>
                </table>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <p><strong>Carga Horária Total Necessária:</strong> 100 Horas</p>
                <p><strong>Carga Horária Total Averbada:</strong> <?php echo $somaNota[0]->total; ?> Horas</p>
            </div>
        </div>
        <br>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">

            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                Docente Responsável: _______________________________________________
            </div>

            <div class="form-group col-md-4">
                Data: ____/____/________
            </div>
        </div>


    </div>








</body>

</html>