<?php

require_once './N00_Config/app.php'; 


?>

<header class="navbar">
    <!-- ENLACES -->
    <div class="dlinks">
        <ul>
            <li>
                <a href="<?php echo APP_URL ?>/inicio">Inicio</a>
            </li>
            <li>
                <a href="<?php echo APP_URL ?>/tienda">Tienda</a>
            </li>
            <li>
            <a href="<?php echo APP_URL ?>/contacto">Contacto</a>
            </li>
        </ul>
    </div>

    <!-- LOGO -->
    <div class="dlogo">
        <a class="" href="#"><img class="logonavbar" src="N10_Presentacion\N14_Assets\Images\logotexto.png"
                alt="Logo"></a>
    </div>

    

    <!-- ICONOS -->
    <div class="diconos">
        <ul>
            <!-- Icono de perfil -->
            <li>
                <a href="#"><i class="fa-solid fa-user fa-lg" style="color: #000000;"></i></a>
            </li>
            <!-- Icono de carrito -->
            <li>
                <a href="#"><i class="fa-solid fa-basket-shopping fa-lg" style="color: #000000;"></i></a>
            </li>
            <!-- Icono de favoritos -->
            <li>
                <a class="icono" href="#"><i class="fa-solid fa-heart fa-lg" style="color: #000000;"></i></a>
            </li>
        </ul>
    </div>

</header>