<?php

namespace N20_Negocio\N22_Modelos;
use N30_Data\conexion_DB;
use PDO;

class productosModelo extends conexion_DB {

    public function obtenerProductosAll(){
        $sql = $this->consultar("SELECT * FROM producto");

        $sql->execute();

        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    }


    public function obtenerProductoPorCodReferencia($codReferencia){
        $sql = $this->consultar("SELECT * FROM producto WHERE codReferencia= :codReferencia");

        $sql->bindParam(':codReferencia', $codReferencia);

        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;

    }
}

?>