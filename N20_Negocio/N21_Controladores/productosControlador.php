<?php

namespace N20_Negocio\N21_Controladores;

require '../../autoload.php';


use N20_Negocio\N22_Modelos\productosModelo;


class productosControlador extends productosModelo{

    private $postData;

    public function __construct(){

        $this->postData = json_decode(file_get_contents("php://input"), true);

    }

    public function gestionarPeticionPost(){

        if (isset($this->postData["tipo"])) {
            
            if ($this->postData["tipo"] === "obtenerProductos") {
                $this->obtenerProductos();
            } else if ($this->postData["tipo"] === "obtenerCodigosDescuento") {
                $this->obtenerCodigosDescuento();
            }
        }
    }
    public function obtenerProductos(){

        $limite = isset($this->postData['limite']) ? (int)$this->postData['limite'] : null;

        $datos = $this->consultarProductos($limite);

        if($datos){
            
            $response = $datos;
        }else{
            $response = ['mensaje', 'Error al obtener productos'];
        }

        echo json_encode($response);

    }




    function obtenerCodigosDescuento(){
        
        $datos = $this->consultarProductosConCodigoDescuento($this->postData['codigo']);

        if($datos){
            $response = $datos;
        }else{
            $response = ['mensaje' => 'No hay articulos con este codigo'];
        }

        echo json_encode($response);


    }

}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $productoControl = new productosControlador();
    $productoControl->gestionarPeticionPost();

}



?>