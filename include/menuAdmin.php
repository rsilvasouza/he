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
                <a class="dropdown-item" href="administradorEditar.php">Editar</a>
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
                    <a class="nav-link" href="administradorEditar.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-edit"></i></div>
                        Editar Cadastro
                    </a>
                    <div class="sb-sidenav-menu-heading">Administração</div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#gerenciar" aria-expanded="false" aria-controls="gerenciar">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Gerenciar
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="gerenciar" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="curso.php">Cursos</a>
                            <a class="nav-link" href="dimensao.php">Dimensões</a>
                            <a class="nav-link" href="atividade.php">Tipo de Atividades</a>
                        </nav>
                    </div>


                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#alunos" aria-expanded="false" aria-controls="alunos">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Aluno
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="alunos" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="alunoCadastrado.php">Aprovar Cadastros</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#atividades" aria-expanded="false" aria-controls="atividades">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Atividades
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="atividades" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="atividadeCadastrada.php">
                                Aprovar Atividades
                                <div class="sb-sidenav-collapse-arrow"></div>
                            </a>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#relatorioAtividades" aria-expanded="false" aria-controls="relatorioAtividades">
                                Relatórios
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="relatorioAtividades" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="alunosComHorasAberbadas.php">Horas Averbadas</a>
                                    <a class="nav-link" href="alunosComHoras.php">Atividades detalhadas</a>
                                    <!-- <a class="nav-link" href="#">Alunos Cadastrados</a> -->
                                </nav>
                            </div>
                        </nav>
                    </div>

                    <!-- <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a> -->

                </div>
            </div>
            <!-- <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div> -->
        </nav>
    </div>