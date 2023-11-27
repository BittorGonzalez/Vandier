<?php

//INFO: Carga de clases automaticamente en cualquier archivo del proyecto
spl_autoload_register(function ($clase) {

    $archivo = __DIR__ . "/" . $clase . ".php";
    $archivo = str_replace("\\", "/", $archivo);

    if (is_file($archivo)) {
        require $archivo;
    }
});



?>
