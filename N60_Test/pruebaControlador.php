<?php

    namespace N60_Test;
    use N30_Data\conexion_DB;

    class pruebaControlador extends conexion_DB{

        public function seleccionarDatos(){

            $this->consultar(["*"], "tabladeprueba", []);
        }
    }

?>