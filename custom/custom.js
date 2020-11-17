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

 function formataHora(hora){
   alert("To aqui");
  $(document).ready(function() {
    $("#horaInicial").mask("99:99");
});
 }