<?php

    namespace N20_Negocio\N22_Modelos;

    class viewsModelo{
        
        //Se valida el nombre de la vista que se pasa como parametro en la URL y si no existe se saca un 404.
        protected function obtenerVistasModelo($vista){

            //Se definen las vistas que pueden accederse
            //TODO: Añadir las vistas/crear alguna configuracion que las incluya

            $whitelist = ["dashboard", "inicio", "login", "tienda", "contacto", "perfil", "carrito", "dashboard", "favoritos"];

            if(in_array($vista, $whitelist)){

                if(is_file("N10_Presentacion/N12_Views/" . $vista . "_view.php")){
                    
                    $contenido = "N10_Presentacion/N12_Views/" . $vista . "_view.php";

                }else{
                    $contenido = "N10_Presentacion/N12_Views/404_view.php";
                }
                
            }else{
                $contenido = "N10_Presentacion/N12_Views/404_view.php";
            }

            return $contenido;
        }
    }


?>