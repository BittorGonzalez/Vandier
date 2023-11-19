<?php

    namespace N20_Negocio\N21_Controladores;
    use N20_Negocio\N22_Modelos\viewsModelo;

    class viewsControlador extends viewsModelo{
        
        public function obtenerVistasControlador($vista){
            if($vista != ""){
                $respuesta = $this->obtenerVistasModelo($vista);
                
            }else{
                $respuesta = "404";
            }
            return $respuesta;
        }
    }

?>