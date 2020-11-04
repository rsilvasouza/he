<?php
session_start();
require_once 'classes.php';

$aluno = new Aluno();
$administrador = new Administrador();


if (isset($_POST['logar'])) {

    try {
        $aluno->setEmail($_POST['email']);
        $aluno->setSenha($_POST['senha']);
        $aluno->setStatus('1');

        $administrador->setEmail($_POST['email']);
        $administrador->setSenha($_POST['senha']);

        if ($administrador->autenticar()) {
            $dados = $administrador->findEmail($administrador->getEmail());
            $_SESSION['status'] = 'logado';
            $_SESSION['idAdministrador'] = $dados[0]->id;
            $_SESSION['nome'] = $dados[0]->nome;
            $_SESSION['perfil'] = '1';
            $_SESSION['idUsuario'] = '';
            header("location: index.php");
            exit();
        } else if ($aluno->autenticar()) {
            
            $dados = $aluno->findEmail($aluno->getEmail());
            $_SESSION['status'] = 'logado';
            $_SESSION['idAluno'] = $dados[0]->id;
            $_SESSION['nome'] = $dados[0]->nome;
            $_SESSION['perfil'] = '2';
            header("location: aluno.php");
            exit();
        } else if($aluno->verificaStatus($aluno->getEmail())){
            $_SESSION['msgInfo'] = "Usuário já cadastrado. <b>Aguardando Aprovação!</b>";
            header("location: login.php");
            exit();
        } else {
            $_SESSION['msgErro'] = "Credenciais inválidas!";
            header("location: login.php");
            exit();
        }
    } catch (Exception $ex) {
        Erro::trataErro($ex);
    }
}
else if (isset($_POST['logout'])) {

    try {

        $_SESSION['status'] = '0';
        session_destroy();
        header('Location: login.php');
    } catch (Exception $ex) {
        Erro::trataErro($ex);
    }
}
// else if (isset($_POST['editar'])) {

//     try {
//         $aluno->setId($_POST['id']);
//         $aluno->setNome($_POST['nome']);
//         $aluno->setPostoGraduacao($_POST['pg']);
//         $aluno->setMilitar($_POST['militar']);
//         $aluno->setFuncao($_POST['funcao']);
//         $aluno->setSecao($_POST['secao']);
//         $aluno->setIp($_POST['ip']);
//         $aluno->setMac($_POST['mac']);
//         $aluno->setNumPatrimonio($_POST['numPatrimonio']);
//         $aluno->setSistemaOperacional($_POST['so']);
//         $aluno->setSoLicenciado($_POST['licenca']);
//         $aluno->setObservacao($_POST['observacao']);
//         $aluno->setUsuario($_POST['usuario']);

//         if ($aluno->update()) :
//             $_SESSION['msgSucesso'] = "Registro editada com sucesso!";
//             header("location: maquina.php");
//             exit();
//         else :
//             $_SESSION['msgErro'] = "Ocorreu um erro durante alterar o registo, por favor tente novamente";
//             header("location: maquina.php");
//             exit();
//         endif;
//     } catch (Exception $ex) {
//         Erro::trataErro($ex);
//     }
// } else if ($_GET['acao'] == 'deletar' && $_GET['id'] != 0) {

//     try {
//         $id = $_GET['id'];

//         if ($aluno->delete($id)) :
//             $_SESSION['msgSucesso'] = "Registro excluido com sucesso!";
//             header("location: maquina.php");
//             exit();
//         else :
//             $_SESSION['msgErro'] = "Ocorreu um erro durante a exclusão do registo, por favor tente novamente";
//             header("location: maquina.php");
//             exit();
//         endif;
//     } catch (Exception $ex) {
//         Erro::trataErro($ex);
//     }
// } 
else {
    $_SESSION['msgInfo'] = "Ops, algo de errado aconteceu!";
    header("location: index.php");
    exit();
}
