<?php


namespace N20_Negocio\N21_Controladores;

session_start();

require '../../autoload.php';


use N20_Negocio\N22_Modelos\usuariosModelo;


class usuariosControlador extends usuariosModelo
{
    public function validarLogin()
    {

        $datosLogin = json_decode(file_get_contents('php://input'), true);

        if ($datosLogin) {

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

    public function obtenerEstadoLogin()
    {
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

    public function destruirSesion()
    {

        session_destroy();
    }
}
//ACTUALMENTE EL LOGIN FUNCIONA CORRECTAMENTE SIEMPRE Y CUANDO PERMANEZCA COMENTADO ESTE CODIGO.
/* ESTE CODIGO ES EL CONTROLADOR PARA EL REGISTRO DE USUARIOS, AUN GENERA CONFLICTO CON EL LOGIN,
    ACTUALMENTE INSERTA A LA BASE DE DATOS SOLAMENTE EL 'USUARIO' DEL LOGIN EJ: 'JUANITO', LA FECHA ACTUAL Y EL IDROL 2 POR DEFECTO ASIGNADO,
    DESDE EL FORMULARIO DE LOGIN NO FUNCIONA EL BOTON DE INICIAR SESION PERO AL CLICKAR EN EL DE REGISTRAR, SE INSERTA EL USUARIO JUANITO,
    LOS DEMAS CAMPOS  nombre 	apellido  	email 	passw EN NULL. (NO RECONOCE EL FORMULARIO DE REGISTRO, SOLO EL DE LOGIN)
     */

/*public function procesarRegistro($data)
{
    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
    $usuario = $data['usuario'];
    $email = $data['email'];
    $contrasena = $data['contraseña'];


    if ($this->insertarUsuario($nombre, $apellido, $usuario, $email, $contrasena)) {
        $respuesta = array('mensaje' => 'Registro exitoso');
    } else {
        $respuesta = array('mensaje' => 'Error en el registro');
    }

    $this->destruirSesion();

    header('Content-Type: application/json');
    echo json_encode($respuesta);
    }
}

$controlador = new usuariosControlador();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$data = json_decode(file_get_contents('php://input'), true);

$controlador->procesarRegistro($data);
}*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $controlador = new usuariosControlador();
    $controlador->validarLogin();
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $controlador = new usuariosControlador();
    $controlador->obtenerEstadoLogin();
} else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $controlador = new usuariosControlador();
    $controlador->destruirSesion();
}
