<?php
   use N20_Negocio\N21_Controladores\viewsControlador;

    require_once './N00_Config/app.php'; 
    require_once './autoload.php';

    //Se obtiene los parametros de la URL y se separa para meterlo en un Array
    if(isset($_GET['views'])){
        $URL = explode('/', $_GET['views']);
    }else{
        $URL = ['inicio'];
    }


?>

<!DOCTYPE html>
<html lang="es">
<head>
   <?php 


   $viewsControlador = new viewsControlador();
   
   if (isset($URL) && $viewsControlador->esVistaPermitida($URL[0])) {
    echo '<link rel="stylesheet" type="text/css" href="N10_Presentacion/N11_Public/CSS/' . $URL[0] . '.css">';

    }else{
        echo '<link rel="stylesheet" type="text/css" href="N10_Presentacion/N11_Public/CSS/404.css">';

    }

    require_once './N10_Presentacion/N13_Plantillas/head.php';
   ?>
   
</head>
<body>
    

<?php 

    require_once './N10_Presentacion/N13_Plantillas/header.php';

    $viewsControlador = new viewsControlador();

    $vista = $viewsControlador->obtenerVistasControlador($URL);

    require_once $vista;
    
    require_once './N10_Presentacion/N13_Plantillas/footer.php';
    require_once './N10_Presentacion/N13_Plantillas/script.php';

?>

</body>
</html>