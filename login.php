<?php

require_once "classes.php";

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
                </div>
            </form>
            <p class="mt-5 mb-3 text-muted text-center">&copy; DTI / 1ª RM<?php echo date('Y'); ?></p>
        </div>
    </main>
</body>

<script src="vendor/twbs/bootstrap/site/docs/4.4/assets/js/vendor/jquery.slim.min.js"></script>
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.js"></script>

</html>
