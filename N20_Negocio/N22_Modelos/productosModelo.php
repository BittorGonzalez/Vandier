<?php

namespace N20_Negocio\N22_Modelos;
use N30_Data\conexion_DB;
use PDO;

class productosModelo extends conexion_DB {

    public function consultarProductos($limite) {
        
        if (is_numeric($limite) && $limite > 0) {
            $sql = $this->consultar("SELECT * FROM producto WHERE stock > 0 LIMIT " . $limite);
        } else {
            $sql = $this->consultar("SELECT * FROM producto WHERE stock > 0");
        }
    
        $sql->execute();
    
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        return $resultados;
    }

    public function consultarProductosConCodigoDescuento($codigo)
    {
        $sql = $this->consultar("SELECT PR.nombre, CD.descuento FROM producto AS PR 
                                LEFT JOIN codigos_descuento AS CD ON PR.idCodigoDescuento = CD.id
                                WHERE CD.nombre = '$codigo'"
        );

        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        if (count($resultados) > 0) {
            $response = ['descuento' => null, 'productos' => []];
    
            foreach ($resultados as $row) {
                $response['descuento'] = $row['descuento']; 
                $response['productos'][] = $row['nombre']; 
            }
        } else {
            $response = ['mensaje' => 'No existen productos con ese código asignado'];
        }
    
        return $response;
    }
    

}

?>