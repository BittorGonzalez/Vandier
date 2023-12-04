<?php

namespace N20_Negocio\N22_Modelos;
use N30_Data\conexion_DB;
use PDOException, PDO;

class productosModelo extends conexion_DB {

    public function obtenerConexion(){
        return $this->conectar();
    }
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

    public function consultarProductosAdmin() {
        
        $sql = $this->consultar("SELECT * FROM producto");
        
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


    public function eliminarProducto($id){
        $sql = "DELETE FROM producto WHERE idProducto = :id";
        $query = $this->conectar()->prepare($sql);
        
        $query->bindParam(':id', $id, PDO::PARAM_INT);
    
        $result = $query->execute();
    
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    protected function insertarProducto($datos) {
        try {
            // Decodificar la cadena JSON para obtener un array
            $datosArray = json_decode($datos, true);
    
            // Verificar si la decodificación fue exitosa
            if ($datosArray === null) {
                throw new Exception('Error al decodificar la cadena JSON');
            }
    
            // Obtener las claves del array
            $campos = implode(', ', array_keys($datosArray));
            $marcadores = ':' . implode(', :', array_keys($datosArray));
    
            $query = "INSERT INTO producto ($campos) VALUES ($marcadores)";
            $stmt = $this->conectar()->prepare($query);
    
            foreach ($datosArray as $campo => $valor) {
                $stmt->bindValue(":$campo", $valor);
            }
    
            $stmt->execute();
    
            return $stmt->rowCount();
            
        } catch (PDOException $e) {
            echo 'Error al insertar datos: ' . $e->getMessage();
            return 0;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return 0;
        }
    }
    

    public function modificarArticulo($datosUsuario) {
        try {
            $query = "UPDATE producto SET
                      imagen = :imagen,
                      nombre = :nombre,
                      descripcion = :descripcion,
                      precio = :precio,
                      stock = :stock,
                      categoria = :categoria
                      WHERE codReferencia = :codReferencia";
    
            $stmt = $this->conectar()->prepare($query);
    
            // Vincular los valores a los marcadores de posición
            $stmt->bindParam(':imagen', $datosUsuario['imagen']);
            $stmt->bindParam(':nombre', $datosUsuario['nombre']);
            $stmt->bindParam(':descripcion', $datosUsuario['descripcion']);
            $stmt->bindParam(':precio', $datosUsuario['precio']);
            $stmt->bindParam(':stock', $datosUsuario['stock']);
            $stmt->bindParam(':categoria', $datosUsuario['categoria']);
            $stmt->bindParam(':codReferencia', $datosUsuario['codReferencia']);
    
            // Ejecutar la consulta preparada
            $stmt->execute();
    
            // Devolver la cantidad de filas afectadas
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo 'Error al modificar el artículo: ' . $e->getMessage();
            return 0;
        }
    }
}

?>