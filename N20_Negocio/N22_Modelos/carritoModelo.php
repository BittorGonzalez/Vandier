<?php

namespace N20_Negocio\N22_Modelos;
use N30_Data\conexion_DB;

class CarritoModelo extends conexion_DB{

    public function insertarProductosAlCarrito(){

        $procedimiento = "CALL insertarProducto(:)";

        //$this->ejecutar("insertarProducto");
    }

}


?>