<?php

namespace N30_Data;
use PDO, PDOException;
require_once '../../N00_Config/bd.php';

class conexion_DB
{
    private $server = DB_HOST;
    private $dbname = DB_NAME;
    private $user = DB_USER;
    private $passw = DB_PASS;


    protected function conectar()
    {

        try {
            $conexion = new PDO("mysql:host=$this->server; dbname=$this->dbname", $this->user, $this->passw);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;

        } catch (PDOException $e) {
            echo 'Error en la conexion ' . $e->getMessage();
        }
    }

    protected function consultar($sentencia){
        $sql = $this->conectar()->prepare($sentencia);
        return $sql;
    }



    protected function insertar($datos, $tabla)
{
    try {
        $conexion = $this->conectar();

        $campos = implode(", ", array_keys($datos));
        $valores = ":" . implode(", :", array_keys($datos));

        $sql = "INSERT INTO $tabla ($campos) VALUES ($valores)";

        $stmt = $conexion->prepare($sql);

        foreach ($datos as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
        echo "Datos insertados correctamente en la base de datos";
    } catch (PDOException $e) {
        echo 'Error al insertar datos: ' . $e->getMessage();
    }
}



    protected function actualizar($datos, $tabla){}
    

    protected function ejecutar($procedimiento, $parametros = array()){
    try {
        $conexion = $this->conectar();
        $stmt = $conexion->prepare($procedimiento);

        foreach ($parametros as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
        return $stmt;
    } catch (PDOException $e) {
        echo 'Error al intentar ejecutar el procedimiento almacenado' . $e->getMessage();
        return null;
    }
}
}


?>