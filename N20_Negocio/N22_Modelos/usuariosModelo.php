<?php

namespace N20_Negocio\N22_Modelos;
use N30_Data\conexion_DB;
use PDO;    

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
    public function insertarUsuarioDesdeJSON($datos)
    {
            // Asegúrate de tener una conexión a la base de datos
            $conexion = $this->conectar();
    
            // Agregar valores predeterminados
            $datos['fechaRegistro'] = date("Y-m-d H:i:s"); // Establecer la fecha actual
            $datos['idRol'] = 2; // Establecer el valor predeterminado para idRol
    
            // Preparar la sentencia SQL
            $sql = "INSERT INTO usuarios (nombre, apellido, usuario, email, passw, fechaRegistro, idRol) VALUES (:nombre, :apellido, :usuario, :email, :passw, :fecha, :idrol)";
    
            // Preparar la declaración
            $stmt = $conexion->prepare($sql);
    
            // Asignar valores
            $stmt->bindParam(':nombre', $datos['nombre']);
            $stmt->bindParam(':apellido', $datos['apellido']);
            $stmt->bindParam(':usuario', $datos['usuario']);
            $stmt->bindParam(':email', $datos['email']);
            $stmt->bindParam(':passw', $datos['contraseña']);
            $stmt->bindParam(':fecha', $datos['fechaRegistro']); // Usar el valor predeterminado
            $stmt->bindParam(':idrol', $datos['idRol']); // Usar el valor predeterminado
    
            // Ejecutar la declaración
            $stmt->execute();
            
            echo "Datos insertados correctamente en la base de datos";
    }
    }
    


?>