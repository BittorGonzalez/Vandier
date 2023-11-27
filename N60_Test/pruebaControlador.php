<?php

    namespace N60_Test;
    use N30_Data\conexion_DB;

    $c = new pruebaControlador();


    $c->saludar();

    class pruebaControlador extends conexion_DB{

        public function seleccionarDatos(){

            $this->consultar(["*"], "tabladeprueba", []);
        }


        public function saludar(){
                echo "hola";

        }
    }





?>