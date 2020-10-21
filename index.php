<?php
require_once "include/topo.php";

if ($_SESSION['perfil'] == 2) header("Location: aluno.php");

require_once "include/rodape.php";