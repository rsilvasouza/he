<?php
ini_set('error_reporting', E_ALL ^ E_NOTICE);
ob_start();
header('X-Frame-Options: DENY');

if (!isset($_SESSION)) session_start();

if ($_SESSION['status'] != 'logado') {
    header("Location: login.php"); // Chamar um form de login por exemplo.
    exit();
} else {
    if (isset($_SESSION['idUsuario'])) $idUsuario = $_SESSION['idUsuario'];
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>FAETERJ - Paracambi</title>

    <!-- Template -->
    <link href="dist/css/styles.css" rel="stylesheet" />
        
    <!-- Bootstrap -->
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.css">

    <!-- DataTable -->
    <!-- <link rel="stylesheet" href="vendor/datatables/datatables/media/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendor/datatables/datatables/media/css/jquery.dataTables.min.css"> -->
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">

</head>

<body class="sb-nav-fixed">
<?php if($_SESSION['perfil'] == '1') {
    require_once 'menuAdmin.php';
}else if($_SESSION['perfil'] == '2') {
    require_once 'menuAluno.php';
}else{
    header("Location: login.php");
}

?>

        <div id="layoutSidenav_content">
            <main>
                <br>
            <div class="container">
                <?php


                if (isset($_SESSION["msgSucesso"])) :
                    $msgSucesso = $_SESSION["msgSucesso"];
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            $msgSucesso
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                          </div>
                          ";
                    unset($_SESSION["msgSucesso"]);

                elseif (isset($_SESSION["msgErro"])) :
                    $msgErro = $_SESSION["msgErro"];
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            $msgErro
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                          </div>";
                    unset($_SESSION["msgErro"]);

                elseif (isset($_SESSION["msgInfo"])) :
                    $msgInfo = $_SESSION["msgInfo"];
                    echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
                            $msgInfo
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                          </div>";
                    unset($_SESSION["msgInfo"]);
                
                elseif (isset($_SESSION["msgWarning"])) :
                    $msgInfo = $_SESSION["msgWarning"];
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            $msgInfo
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                          </div>";
                    unset($_SESSION["msgWarning"]);
                endif;

                ?>
                </div>