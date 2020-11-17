function validarSenha(){
    senha = document.getElementById('senha').value;
    confirmaSenha = document.getElementById('confirmaSenha').value;
    if (senha != confirmaSenha) {
      document.getElementById("editar").disabled = true;
      alert("Senhas diferentes!\n"); 
    }else{
      document.getElementById("editar").disabled = false;
    }
 }

 function formataHora(){
   //alert("To aqui");
  $(document).ready(function() {
    $("#cargaHoraria").mask("99:99");
    $("#horaInicial").mask("99:99");
    $("#horaFinal").mask("99:99");
});
 }