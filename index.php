<?php
require_once './N00_Config/app.php';
require_once './autoload.php';

//Se obtiene los parametros de la URL y se separa para meterlo en un Array
if (isset($_GET['views'])) {
    $URL = explode('/', $_GET['views']);
} else {
    $URL = ['inicio'];
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once './N10_Presentacion/N13_Plantillas/head.php' ?>
</head>

<body>
    <?php require_once './N10_Presentacion/N13_Plantillas/header.php' ?>

    <?php

    use N20_Negocio\N21_Controladores\viewsControlador;

    $viewsControlador = new viewsControlador();

    $vista = $viewsControlador->obtenerVistasControlador($URL[0]);

    require_once $vista;

    require_once './N10_Presentacion/N13_Plantillas/script.php'

    ?>

    <?php require_once './N10_Presentacion/N13_Plantillas/footer.php' ?>
</body>

</html>