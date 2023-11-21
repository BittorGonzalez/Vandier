<?php

    namespace N20_Negocio\N21_Controladores;
    use N20_Negocio\N22_Modelos\viewsModelo;

    class viewsControlador extends viewsModelo{
        
        public function obtenerVistasControlador($vistas){

            if($vistas != ""){
                $respuesta = $this->obtenerVistasModelo($vistas);
                
            }else{
                $respuesta = "404";
            }
            return $respuesta;
        }
    }

?>