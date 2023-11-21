<?php

require_once '../N00_Config/bd.php';

class conexion_DB
{
    private $server = $DB_HOST;
    private $dbname = $DB_NAME;
    private $user = $DB_USER;
    private $passw = $DB_PASS;


    protected function conectar()
    {

        try {
            $conexion = new PDO("mysqli:host=$this->server; dbname=$this->dbname", $this->user, $this->passw);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;

        } catch (PDOException $e) {
            echo 'Error en la conexion ' . $e->getMessage();
        }
    }


    protected function consultar(array $campos, $tabla, array $condiciones = []){
        $consulta = "SELECT " . implode(", ", $campos) . " FROM $tabla";

        if (!empty($condiciones)) {
            $where = " WHERE ";
            $condicionesWhere = [];

            foreach ($condiciones as $campo => $valor) {
                $condicionesWhere[] = "$campo = :$campo";
            }

            $consulta .= $where . implode(" AND ", $condicionesWhere);
        }

        $sql = $this->conectar()->prepare($consulta);

        foreach ($condiciones as $campo => $valor) {
            $sql->bindValue(":$campo", $valor);
        }

        $sql->execute();

        return $sql;
    }



    protected function insertar($datos, $tabla)
    {

        //INFO: Construccion de la sentencia insert recorriendo array de datos

        /*
            Ejem. Estructura del array de datos =>
    
                $datos = [
                    [
                        "campo_nombre"=>"nombreUsuario",
                        "campo_marcador"=>":Nombre",
                        "campo_valor" => $nombre
                    ],
                    [
                        "campo_nombre"=>"ApellidoUsuario",
                        "campo_marcador"=>":Apellido",
                        "campo_valor" => $apellido
                    ]
    
                ]

            Ejem. Sentencia resultante: INSERT INTO USUARIOS (campo1, campo2) VALUES(:campo1, :campo2)       
    
        */


        $query = "INSERT INTO $tabla (";
        $values = "";

        $i = 0;

        foreach ($datos as $clave) {

            //Si el contador ES MAYOR a 1 se pone una , al principio
            if ($i >= 1) {
                $query .= ",";
                $values .= ",";
            }

            $query .= $clave["campo_nombre"];
            $values .= $clave["campo_marcador"];

            $i++;
        }

        $query .= ") VALUES ($values)";
        $sql = $this->conectar()->prepare($query);

        //Se cambian los valores de los marcadores por el valor real
        foreach ($datos as $clave) {
            $sql->bindParam($clave["campo_marcador"], $clave["campo_valor"]);
        }

        $sql->execute();
        return $sql;
    }


    protected function actualizar($datos, $tabla)
    {

    }
}


?>