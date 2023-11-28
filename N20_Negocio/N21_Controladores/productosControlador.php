<?php

namespace N20_Negocio\N21_Controladores;

require '../../autoload.php';


use N20_Negocio\N22_Modelos\productosModelo;


class productosControlador extends productosModelo{

   

    public function obtenerProductos($limite){

        $datos = $this->consultarProductos($limite);

        if($datos){
            
            $response = $datos;
        }else{
            $response = ['mensaje', 'Error al obtener productos'];
        }

        echo json_encode($response);

    }

}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $postData = json_decode(file_get_contents("php://input"), true);
    $limite = isset($postData['limite']) ? (int)$postData['limite'] : null;

    $productoControl = new productosControlador();
    $productoControl->obtenerProductos($limite);
}



?>