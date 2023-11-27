<?php


namespace N20_Negocio\N21_Controladores;

session_start();

require '../../autoload.php';


use N20_Negocio\N22_Modelos\usuariosModelo;


class usuariosControlador extends usuariosModelo{
    public function validarLogin(){

        $datosLogin = json_decode(file_get_contents('php://input'), true);

        if($datosLogin){

            $usuario = $datosLogin['usuario'];
            $email = isset($datosLogin['email']) ? $datosLogin['email'] : null;
            $contraseña = $datosLogin['contrasena'];

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

    public function obtenerEstadoLogin() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        if (isset($_SESSION["logueado"])) {
            $response = ["usuarioLogueado" => $_SESSION['logueado']];
        } else {
            $response = ["usuarioLogueado" => false];
        }
    
        //INFO: Aprovechamos la petición y mandamos la constante APP_URL
        echo json_encode($response);
    }

    public function destruirSesion(){

        session_destroy();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $controlador = new usuariosControlador();
    $controlador->validarLogin();

}else if($_SERVER["REQUEST_METHOD"] == "GET"){
    $controlador = new usuariosControlador();
    $controlador->obtenerEstadoLogin();
}else if($_SERVER["REQUEST_METHOD"] == "DELETE"){
    $controlador = new usuariosControlador();
    $controlador->destruirSesion();
}

?>
