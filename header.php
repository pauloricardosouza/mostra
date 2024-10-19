<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>

            <?php
                date_default_timezone_set('America/Sao_Paulo');

                error_reporting(0);
                //Código para deixar o title da página dinâmico

                if(isset($_GET["pagina"])){
                    $pagina = $_GET['pagina']; //Pega o nome da página via GET

                    switch($pagina){
                        case "formInteressado"           : echo "Cadastrar Interessado"; break;
                        case "listarInteressados"        : echo "Listar Interessados"; break;
                        case "formFiltrarInteressados"   : echo "Filtrar Interessados"; break;

                        default                        : echo "Sistema de Gestão Acadêmica"; break;
                    }
                }
                else{
                    echo "Sistema para a Mostra de Cursos";
                }
            ?>

        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- CDN para importar os ícones do Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <!-- CDN para Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sixtyfour+Convergence&display=swap" rel="stylesheet">
        <style>
            .img {
                width: 400px;
                background: #aaa;
            }

            /* <uniquifier>: Use a unique and descriptive class name */
            .sixtyfour-convergence-header {
                font-family: "Sixtyfour Convergence", sans-serif;
                font-optical-sizing: auto;
                font-weight: 400;
                font-style: normal;
                font-variation-settings:
                    "BLED" 0,
                    "SCAN" 0,
                    "XELA" 0,
                    "YELA" 0;
            }
        </style>

    </head>

    <body style="height:100%; display:grid;">

        <div class="p-3 bg-light text-dark text-center">
            <img src="img/ifpr_logo.png" width="100">
            <br><br>
            <h3 class="sixtyfour-convergence-header">TECNOLOGIA EM ANÁLISE E DESENVOLVIMENTO DE SISTEMAS (TADS)</h3> 
        </div>

        <nav class="navbar navbar-expand-sm bg-primary navbar-dark sticky-top">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Programação Web</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-sm-4" style="border-right: 3px solid black;">
                    <h3 class="mt-4">Programação Web</h3>
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php if($pagina == 'formInteressado'){echo 'active';} ?>" href="formInteressado.php?pagina=formInteressado" title="Ir para o formulário de cadastro de interessados">Cadastrar Interessado</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link <?php if($pagina == 'listarInteressados'){echo 'active';} ?>" href="listarInteressados.php?pagina=listarInteressados" title="Ver pessoas interessadas">Ver Pessoas Interessadas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($pagina == 'formFiltrarInteressados'){echo 'active';} ?>" href="formFiltrarInteressados.php?pagina=formFiltrarInteressados" title="Filtrar interessados por curso">Filtrar Interessados por Curso</a>
                        </li>
                    </ul>
                    <hr class="d-sm-none">
                </div>

        