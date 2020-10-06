<?php
require_once 'topo.php';
require_once 'classes.php';

$maquina = new Maquina();
$funcao = new Funcao();
$secao = new Secao();
$pg = new PostoGraduacao();
$so = new SistemaOperacional();
?>

<body>
    <!-- Button trigger modal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <h1>Maquinas da 1ª RM</h1>
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#maquinaCadastrar">
                    Cadastrar
                </button>
            </div>
        </div>

        <table id="listar" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Militar</th>
                    <th>Seção</th>
                    <th>IP</th>
                    <th>OS</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <?php foreach ($maquina->findAllAll() as $key => $value) : ?>
                <tr>
                    <td><?php echo $value->id_maquina; ?></td>
                    <td><?php echo $value->nome; ?></td>
                    <td><?php echo $value->sigla . " " . $value->militar; ?></td>
                    <td><?php echo $value->desc_secao; ?></td>
                    <td><?php echo $value->ip; ?></td>
                    <td><?php echo $value->desc_so; ?></td>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#maquinaEditar<?php echo $value->id_maquina; ?>">Editar</button>
                    </td>

                    <td>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#maquinaExcluir<?php echo $value->id_maquina; ?>">Excluir</button>
                    </td>
                </tr>

                <?php
                $optionPG = $value->posto_graduacao;
                $optionFuncao = $value->funcao;
                $optionSecao = $value->secao;
                $optionSO = $value->sistema_operacional;
                $optionLicenca = $value->so_licenciado;
                $militar = $value->militar;
                $ip = $value->ip;
                $mac = $value->mac;
                $numPatrimonio = $value->num_patrimonio;
                $observacao = $value->observacao;
                ?>

                <!-- MODAL Excluir -->
                <div class="modal fade" id="maquinaExcluir<?php echo $value->id_maquina; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Deseja Excluir esse registro?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="maquinaController.php">

                                <div class="modal-footer">
                                    <a href="maquinaController.php?acao=deletar&id=<?php echo $value->id_maquina; ?>"><button type='button' class='btn btn-danger'>Excluir</button></a>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="maquinaEditar<?php echo $value->id_maquina; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edição de Maquina</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="maquinaController.php">
                                <div class="modal-body text-left">
                                    <input type="hidden" value="<?php echo $value->id_maquina; ?>" name="id" id="id">
                                    <input type="hidden" value="<?php echo $value->usuario; ?>" name="usuario" id="usuario">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Nome da Maquina</label>
                                            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo $value->nome; ?>" aria-describedby="helpId">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label>Posto/Graduação</label>
                                            <select class="form-control" name="pg" id="">
                                                <option value="">Selecione</option>
                                                <?php
                                                foreach ($pg->findAll() as $key => $value) :
                                                    $selected = ($optionPG == $value->id) ? "selected='selected'" : null;

                                                ?>
                                                    <option <?php echo $selected; ?> value="<?php echo $value->id; ?>"><?php echo $value->sigla; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Militar / Funcionário Civil</label>
                                            <input type="text" name="militar" id="militar" value="<?php echo $militar; ?>" class="form-control" aria-describedby="helpId">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Função</label>
                                            <select class="form-control" name="funcao" id="funcao">
                                                <option value="">Selecione</option>

                                                <?php foreach ($funcao->findAll() as $key => $value) :
                                                    $selected = ($optionFuncao == $value->id) ? "selected='selected'" : null;
                                                ?>
                                                    <option <?php echo $selected; ?> value="<?php echo $value->id; ?>"><?php echo $value->descricao; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Seção</label>
                                            <select class="form-control" name="secao" id="">
                                                <option value="">Selecione</option>
                                                <?php foreach ($secao->findAll() as $key => $value) :
                                                    $selected = ($optionSecao == $value->id) ? "selected='selected'" : null;
                                                ?>
                                                    <option <?php echo $selected; ?> value="<?php echo $value->id; ?>"><?php echo $value->descricao; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>IP</label>
                                            <input type="text" name="ip" id="ip" value="<?php echo $ip; ?>" class="form-control" aria-describedby="helpId">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>MAC</label>
                                            <input type="text" name="mac" id="mac" value="<?php echo $mac; ?>" onkeypress="$(this).mask('00:00:00:00:00:00');" maxlength="16" class="form-control" aria-describedby="helpId">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Número de Patrimonio</label>
                                            <input type="text" name="numPatrimonio" id="numPatrimonio" value="<?php echo $numPatrimonio; ?>" class="form-control" aria-describedby="helpId">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label>Sistema Operacional</label>
                                            <select class="form-control" name="so" id="">
                                                <option value="">Selecione</option>
                                                <?php foreach ($so->findAll() as $key => $value) :
                                                    $selected = ($optionSO == $value->id) ? "selected='selected'" : null;
                                                ?>
                                                    <option <?php echo $selected; ?> value="<?php echo $value->id; ?>"><?php echo $value->descricao; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Licença</label>
                                            <select class="form-control" name="licenca" id="">
                                                <option value="">Selecione</option>
                                                <option value="1" <?= ($optionLicenca == 1) ? 'selected' : '' ?>>Sim</option>
                                                <option value="0" <?= ($optionLicenca == 0) ? 'selected' : '' ?>>Não</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Observações</label>
                                            <input type="text" name="observacao" id="observacao" value="<?php echo $observacao; ?>" class="form-control" aria-describedby="helpId">
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="editar" class="btn btn-warning">Editar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </table>
    </div>
</body>

<?php require_once 'rodape.php' ?>

<!-- Cadastrar -->
<div class="modal fade" id="maquinaCadastrar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastro de Maquinas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body text-left">
                <form method="post" action="maquinaController.php">
                    <input type="hidden" value="1" name="usuario" id="usuario">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Nome da Maquina</label>
                            <input type="text" name="nome" id="nome" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label>Posto/Graduação</label>
                            <select class="form-control" name="pg" id="">
                                <option value="">Selecione</option>
                                <?php foreach ($pg->findAll() as $key => $value) : ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->sigla; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Militar / Funcionário Civil</label>
                            <input type="text" name="militar" id="militar" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>

                        <div class="form-group col-md-2">
                            <label>Função</label>
                            <select class="form-control" name="funcao" id="funcao">
                                <option value="">Selecione</option>
                                <?php foreach ($funcao->findAll() as $key => $value) : ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->descricao; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Seção</label>
                            <select class="form-control" name="secao" id="">
                                <option value="">Selecione</option>
                                <?php foreach ($secao->findAll() as $key => $value) : ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->descricao; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>IP</label>
                            <input type="text" name="ip" id="ip" class="form-control" aria-describedby="helpId">
                        </div>

                        <div class="form-group col-md-4">
                            <label>MAC</label>
                            <input type="text" name="mac" id="mac" class="form-control" onkeypress="$(this).mask('00:00:00:00:00:00');" maxlength="16" aria-describedby="helpId">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Número de Patrimonio</label>
                            <input type="text" name="numPatrimonio" id="numPatrimonio" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label>Sistema Operacional</label>
                            <select class="form-control" name="so" id="">
                                <option value="">Selecione</option>
                                <?php foreach ($so->findAll() as $key => $value) : ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->descricao; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Licença</label>
                            <select class="form-control" name="licenca" id="">
                                <option value="">Selecione</option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Observações</label>
                            <input type="text" name="observacao" id="observacao" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="cadastrar" class="btn btn-success">Cadastrar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#listar').DataTable({
	"searching": true,
        "ordering": false,
        "scrollCollapse": true,
        "lengthChange": false,
        "info": false,
        "paging": true,
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ]	
	});
    });
</script>
