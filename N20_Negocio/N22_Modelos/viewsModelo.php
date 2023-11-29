<?php

    namespace N20_Negocio\N22_Modelos;
    
    require_once './N00_Config/app.php'; 

    class viewsModelo{
        
        //Se valida el nombre de la vista que se pasa como parametro en la URL y si no existe se saca un 404.
        public function esVistaPermitida($vista) {
            $whitelist = ["dashboard", "inicio", "login", "registro","tienda", "contacto", "perfil", "carrito", "productos", "pedidos", "pedidosUsuarios", "usuarios", "descuentos"];
            return in_array($vista, $whitelist);
        }
    
        // Se valida el nombre de la vista que se pasa como parámetro en la URL y si no existe se saca un 404.
        protected function obtenerVistasModelo($vistas) {

            //INFO: Es un apaño bastante malo para solucionar un fallo que daba al pasar 2 parametros en la URL
            if (sizeof($vistas) > 1) {
                echo '<script>window.location.href = " '. APP_URL .'/404 ";</script>';
            }

            if ($this->esVistaPermitida($vistas[0])) {
                if (is_file("N10_Presentacion/N12_Views/" . $vistas[0] . "_view.php")) {
                    $contenido = "N10_Presentacion/N12_Views/" . $vistas[0] . "_view.php";
                } else {
                    $contenido = "N10_Presentacion/N12_Views/404_view.php";
                }
            } else {
                $contenido = "N10_Presentacion/N12_Views/404_view.php";
            }
    
            return $contenido;
        }
    }


?>