<?php
ini_set('error_reporting', E_ALL ^ E_NOTICE);
ob_start();
header('X-Frame-Options: DENY');

if (!isset($_SESSION)) session_start();

if ($_SESSION['status'] != '1') {
    header("Location: login.php"); // Chamar um form de login por exemplo.
} else {
    if (isset($_SESSION['idUsuario'])) $idUsuario = $_SESSION['idUsuario'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>       
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">  

        <title>SCPJur</title>

        <link rel='shortcut icon' type='image/x-icon' href='images/favicon.ico' />
        <link rel="stylesheet" href="css/bootstrap.min.css" />        
        <link rel="stylesheet" href="css/glyphicons.css" />
        
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/custom.js" ></script>

        <!-- CDN's necessários para rodar o funcionamento do DataTable dos RELATORIOS -->
        <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css" />
        <!-- <link rel="stylesheet" href="css/jquery.dataTables.min.css" /> -->

        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.min.js"></script>
        <script src="js/javascript.util.min.js"></script>

        <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
        <!-- <script type="text/javascript" src="js/datatables.min.js"></script> -->

        <script>
            // Esconder os alertas após carregar o documento.
            $(() => {
                $(".alert").hide();
            });
        </script>

        <style>
            .paginate_button:hover{
                color: #fff !important;
                background: #6c757d !important;
                border: #6c757d !important;
            }
            .paginate_button.disabled:hover{
                cursor: no-drop !important;
                color: #666 !important;
                border: 1px solid transparent !important;
                background: transparent !important;
            }
        </style>

    </head>

    <body>
        <nav class="navbar navbar-expand-sm bg-light navbar-light">
            <!-- Brand -->
            <a class="navbar-brand" href="index.php">Ass. Jurídica</a>

            <!-- Links -->
            <ul class="navbar-nav">
                <!-- Dropdown -->
<?php
    if(($_SESSION['perfil'] == 1) ||($_SESSION['perfil'] == 2)){    // Somente admin/moderador tem acesso ao conteudo dessa parte da pagina
?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Cadastrar
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="processo-criar.php">Processo</a>
                        <a class="dropdown-item" href="encarregado-criar.php">Encarregado</a>
                        <a class="dropdown-item" href="om-criar.php">OM</a>
                    </div>
                </li>
<?php }?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Listagens
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="encarregado-listar.php">Encarregado</a>
                        <a class="dropdown-item" href="om-listar.php">OM</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Relatórios
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="processo-listar.php">Todos os Processos</a>
                        <a class="dropdown-item" href="relatorios-a-vencer.php">A vencer</a>
                        <a class="dropdown-item" href="relatorios-atrasados.php">Atrasados</a>
                        <a class="dropdown-item" href="relatorios-solucoes-vencidas.php">Solução Vencida</a>
                        <a class="dropdown-item" href="relatorios-finalizados.php">Finalizados</a>
                    </div>
                </li>
<?php
if($_SESSION['perfil'] == 1){    // Somente administrador tem acesso ao conteudo dessa parte da pagina
?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Administração
                    </a>
                    <div class="dropdown-menu">

                        <h6 class="dropdown-header"> Manipular Usuários</h6>
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="usuario-criar.php">Cadastrar</a>
                            <a class="dropdown-item" href="usuario-listar.php">Listar</a>
                            <!-- <a class="dropdown-item" href="enviar-email.php">Alterar Senha</a> -->
                        
                        <div class="dropdown-divider"></div>
                        <h6 class="dropdown-header"> Listagem de Desabilitados</h6>
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="usuario-desabilitados.php">Usuários</a>
                            <a class="dropdown-item" href="encarregados-desabilitados.php">Encarregados</a>

                        <div class="dropdown-divider"></div>
                        <h6 class="dropdown-header"> Envio de Notificação</h6>
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="solucao-automatica.php">Listar Para Notificar</a> 
                            <a class="dropdown-item" href="disparo-automatico.php">Enviar Para Todos</a>
                            <a class="dropdown-item" href="solucao-controller.php?dispararTodos=">Envio Automatico</a>  
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="processo-enviado.php">Lista de Enviados</a> 
                    </div>
                </li>
<?php }?>

            </ul>

            <div id="conta" style="margin: auto auto auto auto;">
                <?php
                /* if(isset($_SESSION['usuario'])){
                  echo '<a class="navbar-brand" href="logout.php">';
                  echo 'Olá, ' . $_SESSION['usuario'];
                  }else{
                  echo '<a class="navbar-brand" href="login.php"> Login';
                  }
                  </a> */
                ?>
            </div>

            <!-- Inicio Menu Superior -->
            <!--span class="navbar-text">
                <a href="trocar-senha.php"><span class="glyphicon glyphicon-user"></span> Olá, </a> | 
                <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sair</a>

            </span-->
            <div class="navbar-right" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Olá <?= $_SESSION['usuario']; ?></a>
                    <ul class="dropdown-menu">
                        <li><a href="trocar-senha.php" class="nav-link"><span class="glyphicon glyphicon-edit"></span> Trocar Senha</a></li>
                        <li role="separator" class="dropdown-divider divider"></li>
                        <li><a href="logout.php" class="nav-link"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
                    </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert">
                        <strong></strong> <span></span>
                    </div>
                    <div class="alert alert-warning" role="alert">
                        <strong></strong> <span></span>
                    </div>
                    <div class="alert alert-danger" role="alert">
                        <strong></strong> <span></span>
                    </div>
                </div>
            </div>
