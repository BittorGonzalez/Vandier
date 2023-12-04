<?php

namespace N20_Negocio\N22_Modelos;
use N30_Data\conexion_DB;
use PDO, PDOException;    

class usuariosModelo extends conexion_DB{

    protected function comprobarUsuario($usuario, $email, $contraseña) {
        $sql = $this->consultar("SELECT * FROM usuarios WHERE (usuario = :usuario OR email = :email) AND passw = :contrasena");
        
        $sql->bindParam(':usuario', $usuario);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':contrasena', $contraseña);
        
        $sql->execute();
        
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        return $resultados;
    }

    protected function insertarUsuario($datos) {
        try {
            $campos = implode(', ', array_keys($datos));
            $marcadores = ':' . implode(', :', array_keys($datos));

            $query = "INSERT INTO usuarios ($campos) VALUES ($marcadores)";
            $stmt = $this->conectar()->prepare($query);

            foreach ($datos as $campo => $valor) {
                $stmt->bindValue(":$campo", $valor);
            }

            $stmt->execute();

            return $stmt->rowCount();
            
        } catch (PDOException $e) {
            echo 'Error al insertar datos: ' . $e->getMessage();
            return 0;
        }
    }


    public function comprobarUsuarioExistente(){
        $sql = $this->consultar("SELECT usuario, email FROM usuarios");
        $sql->execute();

        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }


    public function modificarUsuario($datosUsuario){

        try {
            $query = "UPDATE usuarios SET
                      nombre = :nombre,
                      apellido = :apellido,
                      usuario = :usuario,
                      email = :email,
                      passw = :passw,
                      fechaRegistro = :fechaRegistro,
                      idRol = :idRol
                      WHERE id = :id";
    
            $stmt = $this->conectar()->prepare($query);
    
            // Vincular los valores a los marcadores de posición
            $stmt->bindParam(':nombre', $datosUsuario['nombre']);
            $stmt->bindParam(':apellido', $datosUsuario['apellido']);
            $stmt->bindParam(':usuario', $datosUsuario['usuario']);
            $stmt->bindParam(':email', $datosUsuario['email']);
            $stmt->bindParam(':passw', $datosUsuario['passw']);
            $stmt->bindParam(':fechaRegistro', $datosUsuario['fechaRegistro']);
            $stmt->bindParam(':idRol', $datosUsuario['idRol']);
            $stmt->bindParam(':id', $datosUsuario['id']);

            // Ejecutar la consulta preparada
            $stmt->execute();
    
            // Devolver la cantidad de filas afectadas
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo 'Error al modificar el usuario: ' . $e->getMessage();
            return 0;
        }
    }

    public function modificarDatosUsuario($datos) {
        $setClause = implode(', ', array_map(fn($campo) => "$campo = :$campo", array_keys($datos)));
        
        $query = "UPDATE usuarios SET $setClause WHERE id = :id";
        $stmt = $this->conectar()->prepare($query);
        
        foreach ($datos as $campo => $valor) {
            $stmt->bindValue(":$campo", $valor);
        }
    
        $stmt->execute();
    
        return $stmt->rowCount();
    }

    public function obtenerConexion(){
        return $this->conectar();
    }


    public function consultarUsuarios(){
        $sql = $this->consultar("SELECT * FROM usuarios");
        $sql->execute();

        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }
    
    


    public function borrarUsuario($id){
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $query = $this->conectar()->prepare($sql);
        
        $query->bindParam(':id', $id, PDO::PARAM_INT);
    
        $result = $query->execute();
    
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    public function añadirNuevoUsuario($datos){
        try {
            // Decodificar la cadena JSON para obtener un array
            $datosArray = json_decode($datos, true);
    
            // Verificar si la decodificación fue exitosa
            if ($datosArray === null) {
                throw new Exception('Error al decodificar la cadena JSON');
            }
    
            // Obtener las claves del array sin incluir 'id'
            $campos = implode(', ', array_diff(array_keys($datosArray), ['id']));
            $marcadores = ':' . implode(', :', array_diff(array_keys($datosArray), ['id']));
    
            $query = "INSERT INTO usuarios ($campos) VALUES ($marcadores)";
            $stmt = $this->conectar()->prepare($query);
    
            foreach ($datosArray as $campo => $valor) {
                // Omitir la asignación de 'id'
                if ($campo !== 'id') {
                    $stmt->bindValue(":$campo", $valor);
                }
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
    }
    


?>