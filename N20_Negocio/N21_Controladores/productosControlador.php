<?php

namespace N20_Negocio\N21_Controladores;

require '../../autoload.php';


include("../../N50_Vendor/Editor-2.2.2/lib/DataTables.php" );

use PDO;
use N20_Negocio\N22_Modelos\productosModelo;
use DataTables\Editor;
use DataTables\Editor\Field;
use DataTables\Editor\Format;
use DataTables\Editor\Validate;
use DataTables\Editor\ValidateOptions;

class productosControlador extends productosModelo{

    private $postData;

    public function __construct(){

        $this->postData = json_decode(file_get_contents("php://input"), true);

    }

    public function gestionarPeticionPost() {
        if (isset($this->postData["tipo"])) {
            if ($this->postData["tipo"] === "obtenerProductos") {
                $this->obtenerProductos();
            } else if ($this->postData["tipo"] === "obtenerCodigosDescuento") {
                $this->obtenerCodigosDescuento();
            } else if ($this->postData["tipo"] === "obtenerProductosAdmin") {
                $this->obtenerProductosAdmin();
            } 
        }else{
            if (isset($_GET['action'])) {
                
                if($_GET['action'] === 'create'){
                    $this->añadirProducto();
                }else if($_GET['action'] == 'edit'){
                    $this->actualizarProducto();
                }
            } else {
                echo "No existe";
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


    public function obtenerProductosAdmin(){


        $datos = $this->consultarProductosAdmin();

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


    public function configurarEditor()
{
    // Configuración de DataTables Editor
    Editor::inst($this->obtenerConexion(), 'producto')
        ->fields(
            Field::inst('imagen'),
            Field::inst('nombre'),
            Field::inst('descripcion'),
            Field::inst('precio'),
            Field::inst('stock'),
            Field::inst('categoria'),
            Field::inst('codReferencia')
        )
        ->debug(true)
        ->process($_POST)
        ->json();
}




public function borrarProducto(){
    // Verificar si 'data' está presente en la URL
    if(isset($_GET['data'])){
        // Iterar sobre el arreglo 'data'
        foreach ($_GET['data'] as $index => $producto) {
            // Verificar si 'idProducto' está presente en el producto actual
            if(isset($producto['idProducto'])){
                // Obtener el valor del parámetro 'idProducto'
                $idProducto = $producto['idProducto'];

                $resul = $this->eliminarProducto($idProducto);

                if($resul){
                    echo json_encode(array("status" => "success", "message" => "Producto eliminado exitosamente"));
                }else{
                    echo json_encode(array("status" => "error", "message" => "Error al eliminar el producto"));

                }
                break;
            }
        }
    } else {
        // Manejar el caso en el que 'data' no está presente en la URL
        echo "El parámetro 'data' no está presente en la URL";
    }
}


public function añadirProducto(){

    if (isset($_POST['data'])) {
        // Obtener el primer conjunto de datos (suponiendo que solo hay uno)
        $primerConjuntoDatos = $_POST['data'][0];

        $datosProducto = array(
            'nombre' => $primerConjuntoDatos['nombre'],
            'descripcion' => $primerConjuntoDatos['descripcion'],
            'precio' => $primerConjuntoDatos['precio'],
            'stock' => $primerConjuntoDatos['stock'],
            'categoria' => $primerConjuntoDatos['categoria'],
            'codReferencia' => $primerConjuntoDatos['codReferencia']
        );

        // Convertir el array a formato JSON
        $jsonDatosProducto = json_encode($datosProducto);

        $resul = $this->insertarProducto($jsonDatosProducto);

        if($resul > 0){
            echo json_encode(array("status" => "success", "message" => "Producto insertado exitosamente"));

        }else{
            echo json_encode(array("status" => "error", "message" => "Error al insertar el producto en la base de datos"));

        }

      
    } else {
        // Manejar el caso en el que 'data' no está presente en $_POST
        echo json_encode(array("status" => "error", "message" => "Error al obtener datos del cuerpo de la solicitud"));
    }
}



public function actualizarProducto(){
    if (isset($_POST['data'])) {
        // Obtener el primer conjunto de datos (suponiendo que solo hay uno)
        foreach ($_POST['data'] as $index => $producto) {
            // Verificar si 'codReferencia' está presente en el producto actual
            if(isset($producto['codReferencia'])){
                // Obtener los datos específicos
                $datosUsuario = array(
                    "imagen" => $producto['imagen'],
                    "nombre" => $producto['nombre'],
                    "descripcion" => $producto['descripcion'],
                    "precio" => $producto['precio'],
                    "stock" => $producto['stock'],
                    "categoria" => $producto['categoria'],
                    "codReferencia" => $producto['codReferencia']
                );

                // Llamada a la función para modificar el artículo
                $resul = $this->modificarArticulo($datosUsuario);

                if($resul){
                    // Devolver los datos actualizados como respuesta
                    echo json_encode(array(
                        "status" => "success",
                        "message" => "Producto actualizado exitosamente"
                    ));
                } else {
                    echo json_encode(array("status" => "error", "message" => "Error al actualizar el producto"));
                }

                break;
            }
        }
    } else {
        // Manejar el caso en el que 'data' no está presente en $_POST
        echo json_encode(array("status" => "error", "message" => "Error al obtener datos del cuerpo de la solicitud"));
    }
}


}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $productoControl = new productosControlador();
    $productoControl->gestionarPeticionPost();

}elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["editor"])) {
    // Llamada para la configuración y procesamiento de Editor
    $productoControl = new productosControlador();
    $productoControl->configurarEditor();

}else if($_SERVER["REQUEST_METHOD"] == "DELETE"){
    $productoControl = new productosControlador();
    $productoControl->borrarProducto();
}



?>