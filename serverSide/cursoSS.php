<?php
require_once 'include/topo.php';
require_once 'classes.php';

$curso = new Curso();

?>
<div class="container-fluid">
    <h1>Cursos</h1>
<table id="listar" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sigla</th>
                    <th>Curso</th>
                    <th></th>
                    
                    
                </tr>
            </thead>
</table>
</div>


                <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edição de Curso</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="cursoController.php">
                                <div class="modal-body text-left">
                                    <input type="hidden" value="<?php echo $value->id; ?>" name="id" id="id">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Sigla</label>
                                            <input type="text" name="sigla" id="sigla" class="form-control" aria-describedby="helpId">
                                        </div>

                                        <div class="form-group col-md-8">
                                            <label>Nome do Curso</label>
                                            <input type="text" name="nome" id="nome" class="form-control" aria-describedby="helpId">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="editar" class="btn btn-success">Editar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

<?php require_once 'include/rodape.php'?>

<script>
   $(document).ready(function() {
        $('#listar').dataTable({
            "processing": true,
            "serverSide":true,
            "ajax":"getData.php",
            
            "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button>Click!</button>"
        } ]
        });

        $('#listar tbody').on( 'click', 'button', function () {
        alert(data[1]);
    } );
    });

   function preencheEditar(tipo, id, sigla, nome){
        
        $('#id').val(id);
        $('#sigla').val(sigla);
        $('#nome').val(nome);
        
    }
</script>