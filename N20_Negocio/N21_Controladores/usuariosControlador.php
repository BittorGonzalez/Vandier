<?php

namespace N20_Negocio\N21_Controladores;

session_start();

require '../../autoload.php';

use N20_Negocio\N22_Modelos\usuariosModelo;

class usuariosControlador extends usuariosModelo
{
    public function procesarSolicitud()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->validarLogin();
        } else if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->obtenerEstadoLogin();
        } else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $this->destruirSesion();
        } else if ($_SERVER["REQUEST_METHOD"] == "PUT") {
            $this->procesarRegistro();
        } else {
            echo "Error: Método de solicitud no permitido";
        }
    }

    private function validarLogin()
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

    private function obtenerEstadoLogin()
    {
        if (isset($_SESSION["logueado"])) {
            $response = ["usuarioLogueado" => $_SESSION['logueado']];
        } else {
            $response = ["usuarioLogueado" => false];
        }

        echo json_encode($response);
    }

    private function destruirSesion()
    {
        session_destroy();
    }

    private function procesarRegistro()
{
    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        $jsonData = file_get_contents("php://input");

        // Decodificar JSON
        $datos = json_decode($jsonData, true);

        // Llamada a la función insertarUsuarioDesdeJSON con el array actualizado
        $this->insertarUsuarioDesdeJSON($datos);

        echo "Datos insertados correctamente en la base de datos";
    } else {
        echo "Error: Método de solicitud no permitido";
    }
}
}

$controlador = new usuariosControlador();
$controlador->procesarSolicitud();

?>

    