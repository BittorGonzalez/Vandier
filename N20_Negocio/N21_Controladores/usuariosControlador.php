<?php

namespace N20_Negocio\N21_Controladores;

session_start();

require '../../autoload.php';
include("../../N50_Vendor/Editor-2.2.2/lib/DataTables.php" );

use N20_Negocio\N22_Modelos\usuariosModelo;
use PDO,PDOException;
use N20_Negocio\N22_Modelos\productosModelo;
use DataTables\Editor;
use DataTables\Editor\Field;
use DataTables\Editor\Format;
use DataTables\Editor\Validate;
use DataTables\Editor\ValidateOptions;

class usuariosControlador extends usuariosModelo
{

    private $postData;

    public function __construct(){
        $this->postData = json_decode(file_get_contents("php://input"), true);

    }


    public function gestionarPeticionPost() {
        if (isset($this->postData["tipo"])) {
            if ($this->postData["tipo"] === "validarLogin") {
                $this->validarLogin();
            } else if ($this->postData["tipo"] == "registrarUsuario") {
                $this->procesarRegistro();
            } else if ($this->postData["tipo"] == "obtenerUsuarios") {
                $this->obtenerUsuarios();
            }
        } else {
            if (isset($_GET['action'])) {
                if ($_GET['action'] === 'create') {
                    $this->añadirUsuario();
                } else if ($_GET['action'] === 'edit') {
                    $this->actualizarUsuarioDashboard();
                }
            } else {
                echo "No existe";
            }
        }
    }


    public function gestionarPeticionDelete(){

        $tipo = isset($_GET['accion']) ? $_GET['accion'] : '';

        if($tipo === "eliminarSesion"){
            $this->destruirSesion();
        }else{
            if(isset($_GET['action'])){
                if($_GET['action'] === 'remove'){
                    $this->eliminarUsuario();

                }
            }
        }
    }   

    public function gestionarPeticionGet(){
        $tipo2 = isset($_GET['accion2']) ? $_GET['accion2'] : '';
     
        if($tipo2 === "obtenerEstadoLogin"){
            $this->obtenerEstadoLogin();
        }else if($tipo2 == "comprobarUsuariosExistente"){
            $this->comprobarUsuariosExistentes();
        }
    }

    public function gestionarPeticionPut(){

        if(isset($this->postData["tipo"])){
            if($this->postData["tipo"] === "actualizarUsuario"){
                $this->actualizarUsuario();
            }else if($this->postData["tipo"] === "registrarUsuario"){
                $this->procesarRegistro();
            }
        }

    }

    private function validarLogin()
    {

        if ($this->postData["datos"]) {

            $usuario = $this->postData['datos']['usuario'];
            $email = isset($this->postData['datos']['email']) ? $this->postData['datos']['email'] : null;
            $contraseña = $this->postData['datos']['contrasena'];

            $datos = $this->comprobarUsuario($usuario, $email, $contraseña);

            if (!empty($datos)) {
                $_SESSION['logueado'] = true;
                $response = $datos;
            } else {
                $response = ["mensaje" => "No se encontraron resultados"];
            }

            echo json_encode($response);
        }
    }


    public function procesarRegistro() {
        $datos = $this->postData["datos"];
    
        $estado = $this->insertarUsuario($datos);

        if($estado > 0){
            $response = ["mensaje" => "Datos actualizados"];

        }else{
            $response = ["mensaje" => "Error al  registrar"];

        }

        echo json_encode($response);
    }


    public function actualizarUsuarioDashboard(){
        if (isset($_POST['data'])) {
            // Obtener el primer conjunto de datos (suponiendo que solo hay uno)
            foreach ($_POST['data'] as $index => $usuario) {
                // Verificar si 'id' está presente en el producto actual
                if(isset($usuario['id'])){
                    // Obtener los datos específicos
                    $datosUsuario = array(
                        "nombre" => $usuario['nombre'],
                        "apellido" => $usuario['apellido'],
                        "usuario" => $usuario['usuario'],
                        "email" => $usuario['email'],
                        "passw" => $usuario['passw'],
                        "fechaRegistro" => $usuario['fechaRegistro'],
                        "idRol" => $usuario['idRol'],
                        "id" => $usuario['id']

                    );
                    
                    $resul = $this->modificarUsuario($datosUsuario);
    
                    if($resul ){
                        // Devolver los datos actualizados como respuesta
                        echo json_encode(array(
                            "status" => "success",
                            "message" => "Producto actualizado exitosamente"
                        ));
                    } else {
                        echo json_encode(array("status" => "error", "message" => "Error al actualizar el usuario"));
                    }
    
                    break;
                }
            }
        } else {
            // Manejar el caso en el que 'data' no está presente en $_POST
            echo json_encode(array("status" => "error", "message" => "Error al obtener datos del cuerpo de la solicitud"));
        }
    }
    public function actualizarUsuario(){

        $datos = $this->postData["datos"];
        
     
        $estado = $this->modificarDatosUsuario($datos);

        if($estado > 0){
            $response = ["mensaje" => "Datos actualizados"];
        }else{
            $response = ["mensaje" => "Error al actualizar los datos"];

        }

        echo json_encode($response);

    }


    public function obtenerEstadoLogin()
    {
        if (isset($_SESSION["logueado"])) {
            $response = ["usuarioLogueado" => $_SESSION['logueado']];
        } else {
            $response = ["usuarioLogueado" => false];
        }

        echo json_encode($response);
    }

    public function comprobarUsuariosExistentes(){

        $usuariosRegistrados = $this->comprobarUsuarioExistente();

        if($usuariosRegistrados){
            $resul =  $usuariosRegistrados;
        }else{
            $resul = ["mensaje"=>"Error al obtener usuarios"];
        }

        echo json_encode($resul);

        return json_encode($resul);

    }



    private function destruirSesion()
    {
        session_destroy();
    }

    private function eliminarUsuario(){
        if(isset($_GET['data'])){
            // Iterar sobre el arreglo 'data'
            foreach ($_GET['data'] as $index => $usuario) {
                // Verificar si 'idProducto' está presente en el producto actual
                if(isset($usuario['id'])){
                    // Obtener el valor del parámetro 'idProducto'
                    $idUsuario = $usuario['id'];
    
                    $resul = $this->borrarUsuario($idUsuario);
    
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

    public function configurarEditor()
{
    // Configuración de DataTables Editor
    Editor::inst($this->obtenerConexion(), 'producto')
        ->fields(
            Field::inst('nombre'),
            Field::inst('apellido'),
            Field::inst('usuario'),
            Field::inst('email'),
            Field::inst('passw'),
            Field::inst('fechaRegistro'),
            Field::inst('idRol'),
            Field::inst('codReferencia')
        )
        ->debug(true)
        ->process($_POST)
        ->json();
}


public function obtenerUsuarios(){

    $datos = $sql = $this->consultarUsuarios();
    
    if($datos){
        $response = $datos;
    }else{
        $response = ["Mensaje"=> "Error al encontrar usuarios"];
    }

    echo json_encode($response);
}

public function añadirUsuario(){

    if (isset($_POST['data'])) {
        // Obtener el primer conjunto de datos (suponiendo que solo hay uno)
        $primerConjuntoDatos = $_POST['data'][0];

        $datosProducto = array(
            'nombre' => $primerConjuntoDatos['nombre'],
            'apellido' => $primerConjuntoDatos['apellido'],
            'usuario' => $primerConjuntoDatos['usuario'],
            'email' => $primerConjuntoDatos['email'],
            'passw' => $primerConjuntoDatos['passw'],
            'fechaRegistro' => $primerConjuntoDatos['fechaRegistro'],
            'idRol' => $primerConjuntoDatos['idRol']


        );

        // Convertir el array a formato JSON
        $jsonDatosProducto = json_encode($datosProducto);

        echo $jsonDatosProducto;
        $resul = $this->añadirNuevoUsuario($jsonDatosProducto);

        if($resul > 0){
            echo json_encode(array("status" => "success", "message" => "Usuario insertado exitosamente"));

        }else{
            echo json_encode(array("status" => "error", "message" => "Error al insertar el usuario en la base de datos"));

        }

      
    } else {
        // Manejar el caso en el que 'data' no está presente en $_POST
        echo json_encode(array("status" => "error", "message" => "Error al obtener datos del cuerpo de la solicitud"));
    }
}


}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $usuarioControl = new usuariosControlador();
    $usuarioControl->gestionarPeticionPost();

}else if($_SERVER["REQUEST_METHOD"] == "GET"){
    $usuarioControl = new usuariosControlador();
    $usuarioControl->gestionarPeticionGet();

}else if($_SERVER["REQUEST_METHOD"] == 'DELETE'){
    $usuarioControl = new usuariosControlador();
    $usuarioControl->gestionarPeticionDelete();

}else if($_SERVER["REQUEST_METHOD"] == 'PUT'){
    $usuarioControl = new usuariosControlador();
    $usuarioControl->gestionarPeticionPut();

}elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["editor"])) {
    // Llamada para la configuración y procesamiento de Editor
    $productoControl = new productosControlador();
    $productoControl->configurarEditor();

}
?>

    