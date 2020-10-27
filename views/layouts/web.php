<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trazabilidad de Asistencia - Gym Tracking App</title>

    <!-- font -->
    <link rel="stylesheet" href="/assets/css/fonts.css">
    
    <!-- css framework -->
    <link rel="stylesheet" href="/assets/css/pure-base-min.css">
    <link rel="stylesheet" href="/assets/css/pure-grids-min.css">
    <link rel="stylesheet" href="/assets/css/pure-forms-min.css">

    <!-- jquery ui -->
    <link rel="stylesheet" href="/assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="/assets/css/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="/assets/css/jquery-ui.theme.min.css">

    <!-- custom css -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/utils.css">

    <!-- jquery & jquery ui -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/jquery-ui.min.js"></script>
    
    <!-- custom global js -->
    <script src="/assets/js/main.js"></script>
</head>
<body>
    <div class="container bg-black-1">

        <div class="pure-g">
            <div class="pure-u-1-1">
                <ul class='nav-links'>
                    <li class="nav-li">
                        <a href='/home' class="styled-button text-upper">Inicio</a>
                    </li>
                    <li class="nav-li">
                        <a href='#' data-dropdown="links-admin" class="styled-button text-upper">
                            Administrar
                        </a>
                        <div class="nav-dropdown" id='links-admin'>
                            <ul class="dropdown-links ff-1">
                                <li><a class='styled-inverse' href="/trainee/new">Nueva Persona</a></li>
                                <li><a class='styled-inverse' href="/attendance/export">Exportar Registros</a></li>
                                <li><a class='styled-inverse' href="/trainee/export">Exportar Personas</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pure-g">
            <div class="pure-u-1-1 content-center">
                <img src="/assets/img/logo.jpeg" class="logo" alt="FUNTRAINSPORTS Entrenamiento Funcional">
            </div>
        </div>
        
        <?= $bodyContent ?>


        <div class="alert-container pure-g">
            <?php
            $flash = Core\Utils\FlashMessages::getInstance();
            if ($flash->hasMessages()) {
                $flash->display();
            }
            ?>
        </div>
    </div>

    <?php 
    if (isset($bodyScripts)) {
        foreach ($bodyScripts as $scriptPath) {
            echo "<script src=\"/assets/js/{$scriptPath}\"></script>";
        }
    }
    ?>
</body>
</html>