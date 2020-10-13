<?php

require_once "classes.php";
$curso = new Curso();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Controle de Maquinas</title>
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="custom/custom.css">
</head>

<body class="text-center">
    <main>
        <div class="center">
            <h1 class="h3 mb-3 font-weight-normal">Autenticação</h1>
            <form class="form-signin text-left" method="post" action="usuarioController.php">
                <div class="form-group">
                    <label for="">E-mail</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="" aria-describedby="helpId" required>
                </div>

                <div class="form-group">
                    <label for="">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" placeholder="" aria-describedby="helpId" required>
                </div>

                <div class="bd-example">
                    <button type="submit" name="logar" class="btn btn-lg btn-success btn-block" type="submit">acessar</button>
                    <button type="button" class="btn btn-lg btn-info btn-block" data-toggle="modal" data-target="#cadastro">Cadastre-se</button>
                </div>
            </form>
            <p class="mt-5 mb-3 text-muted text-center">&copy; FAETERJ - Paracambi <?php echo date('Y'); ?></p>
        </div>
    </main>
</body>

<script src="vendor/components/jquery/jquery.js"></script>
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.js"></script>

</html>

<div class="modal fade" id="cadastro" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Faça o seu cadastro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="loginController.php">
                    <div class="modal-body text-left">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>matricula</label>
                                <input type="text" name="matricula" id="matricula" class="form-control" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Nome Completo</label>
                                <input type="text" name="nome" id="nome" class="form-control" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>E-mail</label>
                                <input type="text" name="email" id="email" class="form-control" aria-describedby="helpId">
                            </div>

                            <div class="form-group col-md-4">
                                <label>Senha</label>
                                <input type="text" name="senha" id="senha" class="form-control" aria-describedby="helpId">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>Curso</label>
                                <select class="form-control" name="curso" id="">
                                    <option value="">Selecione</option>
                                    <?php foreach ($curso->findAll() as $key => $value) : ?>
                                        <option value="<?php echo $value->id; ?>"><?php echo $value->sigla . ' - ' . $value->nome; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Turno</label>
                                <select class="form-control" name="" id="">
                                    <option value="">Selecione</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Noite</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>