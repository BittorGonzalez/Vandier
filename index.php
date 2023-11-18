<?php

    require_once './N00_Config/app.php';
    require_once './autoload.php';

    //Se obtiene los parametros de la URL y se separa para meterlo en un Array
    if(isset($_GET['views'])){
        $URL = explode('/', $_GET['views']);
    }else{
        $URL = ['login'];
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <?php require_once './N10_Presentacion/N13_Plantillas/head.php' ?>
</head>
<body>
    

<?php require_once './N10_Presentacion/N13_Plantillas/script.php'?>

</body>
</html>