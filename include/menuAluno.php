<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Horas Extracurriculares</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></form>
    <!-- Navbar-->
    <div class="text-light"><?php echo "Olá " . strtok($_SESSION['nome'], ' '); ?></div>
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="alunoEditar.php">Editar</a>
                <div class="dropdown-divider"></div>
                <form action="loginController.php" method="post">
                    <button class="dropdown-item" name="logout" type="submit">Logout</button>
                </form>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading"></div>

                    <a class="nav-link" href="alunoEditar.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-edit"></i></div>
                        Editar Cadastro
                    </a>

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#gerenciar" aria-expanded="false" aria-controls="gerenciar">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Atividades
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="gerenciar" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="alunoAtividade.php">Cadastradas</a>
                        </nav>
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="alunoAtividadeAverbada.php">Averbadas</a>
                        </nav>
                    </div>

                </div>
            </div>
        </nav>
    </div>