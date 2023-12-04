<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="N10_Presentacion/N11_Public/CSS/styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.13.6/b-2.4.2/sl-1.7.0/datatables.min.css"/>
<link rel="stylesheet" href="N50_Vendor/Editor-2.2.2/css/editor.dataTables.css">

<?php 

    use N20_Negocio\N21_Controladores\viewsControlador;


   $viewsControlador = new viewsControlador();
   
   if (isset($URL) && $viewsControlador->esVistaPermitida($URL[0], 2)) {
    echo '<link rel="stylesheet" type="text/css" href="N10_Presentacion/N11_Public/CSS/' . $URL[0] . '.css">';

    }else{
        echo '<link rel="stylesheet" type="text/css" href="N10_Presentacion/N11_Public/CSS/404.css">';

    }

   ?>


<link rel="icon" type="image/png" href="N10_Presentacion\N14_Assets\Images\logo.png" />
</style>
<title>
    <?php echo APP_NAME; ?>
</title>

