<?php

require_once './N00_Config/app.php';

session_start();


?>

<header class="navbar" id="myNavbar">
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
        <a class="" href="<?php echo APP_URL ?>"><img class="logonavbar"
                src="N10_Presentacion\N14_Assets\Images\logotexto.png" alt="Logo"></a>
    </div>

    <!-- ICONOS -->
    <div class="diconos">
        <ul>
            <!-- Icono de perfil -->
            <li class="position-relative">
                <i class="iconoUsuario fa-solid fa-user fa-lg h-100 p-2 py-2"></i>

                <div class="login_content d-none mt-3 rounded-3 p-3 border border-2">

                    <form action="" class="formularioInicioSesion d-flex flex-column gap-3">

                        <input type="text" placeholder="Usuario o email"
                            class=" inputUsuario form-control px-3 py-2 border-dark" required>
                        <input type="password" placeholder="Contraseña"
                            class="inputContraseña form-control px-3 py-2 border-dark" required>


                        <!-- INFO: Son elementos a porque el button no tiene href y tenia problemas en el JS para coger las configuraciones globales -->
                        <a type="button"
                            class="btn_iniciarsesion btn bg-white border border-dark border-2 fw-bold mt-3">Iniciar
                            sesion</a>
                        <a type="button" href="<?php echo APP_URL ?>/registro"
                            class="btn_registro btn btn-dark text-white fw-bold">Registrarse</a>
                    </form>


                    <div class="loginInfo text-danger mt-4 fw-bold d-none" role="alert">
                        Usuario o contraseña incorrectos
                    </div>

                </div>
            </li>


            <!-- Icono de carrito -->
            <li class="position-relative">
                <i class="iconoCarrito fa-solid fa-basket-shopping fa-lg h-100 p-2"></i>

                <div class="carrito_content  d-none flex-column align-items-center mt-3 rounded-3 border border-2">

                    <i class="iconoError fa-solid fa-xmark text-danger"></i>
                    <h2 class="mt-2 fw-bold fs-4">No estas logueado</h2>
                    <button type="button" class="btn_iniciarSesionCarrito btn btn-dark text-white fw-bold mt-4">Iniciar
                        sesion</button>
                </div>

            </li>
            <!-- Icono de favoritos -->
            <li>
                <i class="iconoFavoritos fa-solid fa-heart fa-lg h-100 p-2"></i>
            </li>
        </ul>
    </div>

</header>

<script>
    window.addEventListener('scroll', function () {
        let navbar = document.getElementById('myNavbar');

        // Altura a la que el cambio de estilos se activará
        let scrollThreshold = 100;

        if (window.scrollY > scrollThreshold) {
            // Si el desplazamiento vertical es mayor que la altura de scrollThreshold
            navbar.style.backgroundColor = 'rgba(248, 249, 250, 0.9)'; // Fondo transparente gradual
            navbar.style.height = '70px'; // Altura aumentada gradual
        } else {
            // Si el desplazamiento es menor que scrollThreshold
            navbar.style.backgroundColor = '#f8f9fa'; // Restaura el color de fondo original
            navbar.style.height = 'fit-content'; // Restaura la altura original
        }
    });
</script>