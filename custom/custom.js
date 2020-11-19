$(document).ready(function() {
  $("#cargaHoraria2").mask("99:99");
  $("#horaInicial2").mask("99:99");
  $("#horaFinal2").mask("99:99");
});

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