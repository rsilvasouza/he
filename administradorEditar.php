<?php
require_once 'include/topo.php';
require_once 'classes.php';

$administrador = new Administrador();

foreach ($administrador->buscaUsuario($_SESSION['idAdministrador']) as $key => $value) :
?>
    <div class="container-fluid">
        <div class="form-row">
            <div class="form-group col-md-10">
                <h1>Editar</h1>
            </div>
        </div>

        <form method="post" action="administradorController.php">

            <div class="form-row">
                <input type="hidden" name="id" value="<?php echo $_SESSION['idAdministrador']; ?>">
                <div class="form-group col-md-4">
                    <label>matricula</label>
                    <input type="text" name="matricula" id="matricula" value="<?php echo $value->matricula; ?>" class="form-control" aria-describedby="helpId">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Nome Completo</label>
                    <input type="text" name="nome" id="nome" value="<?php echo $value->nome; ?>" class="form-control" aria-describedby="helpId" required>
                </div>

                <div class="form-group col-md-6">
                    <label>E-mail</label>
                    <input type="text" name="email" id="email" value="<?php echo $value->email; ?>" class="form-control" aria-describedby="helpId" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" aria-describedby="helpId">
                </div>

                <div class="form-group col-md-6">
                    <label>Confirma Senha</label>
                    <input type="password" name="confirmaSenha" id="confirmaSenha" class="form-control" onblur="validarSenha()" aria-describedby="helpId">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12 text-right">
                    <button type="submit" name="editar" id="editar" class="btn btn-success">Salvar</button>
                </div>
            </div>
    </div>
    </form>

<?php
endforeach;
require_once "include/rodape.php";
?>

</div>