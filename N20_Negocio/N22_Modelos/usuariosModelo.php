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

}

?>