<?php

namespace N20_Negocio\N21_Controladores;
require '../../autoload.php';

use N20_Negocio\N22_Modelos\ventasModelo;

class ventasControlador extends ventasModelo
{

    public function guardarInfoVenta()
    {
        $datosVenta = json_decode(file_get_contents('php://input'), true);

        $resul = $this->insertarProductos($datosVenta);

        if ($resul) {
            $respuesta = array('estado' => 'success', 'mensaje' => 'Operación exitosa');
        } else {
            $respuesta = array('estado' => 'error', 'mensaje' => 'Error en la operación');

        }


        echo json_encode($respuesta);

    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controlador = new ventasControlador();
    $controlador->guardarInfoVenta();
}

?>