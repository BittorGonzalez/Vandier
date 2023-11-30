<?php

namespace N20_Negocio\N22_Modelos;
use N30_Data\conexion_DB;
use PDOException;   

class ventasModelo extends conexion_DB{

    public function insertarProductos($parametros){
        try{

            $json_param = json_encode($parametros);
            $procedimiento = "CALL nuevaVenta('$json_param')";

            
            $resultado = $this->ejecutar($procedimiento);

            return $resultado;


        }catch(PDOException $e){
            return false;
        }
       
    }
}

?>