<?php

namespace N20_Negocio\N22_Modelos;
use N30_Data\conexion_DB;
use PDOException;   

class ventasModelo extends conexion_DB{

    public function insertarProductos($parametros){
        try{

            $procedimiento = "CALL nuevaVenta()";
            $resultado = $this->ejecutar($procedimiento, $parametros);

            return $resultado;


        }catch(PDOException $e){
            return false;
        }
       
    }
}

?>