<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- Bootstrap core JavaScript-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

<script src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.13.6/b-2.4.2/sl-1.7.0/datatables.min.js"></script>
<script src="N50_Vendor/Editor-2.2.2/js/dataTables.editor.js"></script>


<script src="N10_Presentacion\N11_Public\JS\carritoManager_class.js"></script>

<script src="N10_Presentacion\N11_Public\JS\main.js"></script>
<?php

if (isset($URL) && $viewsControlador->esVistaPermitida($URL[0])) {
    $rutaJS = "N10_Presentacion/N11_Public/JS/" . $URL[0] . ".js";
    
    if (is_file($rutaJS)) {
  
        echo '<script src="' . $rutaJS . '"></script>';

        
    }
}

?>