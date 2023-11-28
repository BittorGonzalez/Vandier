<?php

namespace N20_Negocio\N21_Controladores;

require '../../autoload.php';


use N20_Negocio\N22_Modelos\productosModelo;


class productosControlador extends productosModelo{

    public function recuperarTodosProductos(){

        $datos = $this->obtenerProductosAll();

        if($datos){
            
            $response = $datos;
        }else{
            $response = ['mensaje', 'Error al obtener productos'];
        }

        echo json_encode($response);

    }

}


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $productoControl = new productosControlador();
    $productoControl->recuperarTodosProductos();
}



?>