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
            <li class="position-relative">
                <i class="iconoUsuario fa-solid fa-user fa-lg h-100 p-2 py-2"></i>

                <div class="login_content d-none mt-3 rounded-3 p-3 border border-2">

                    <form action="" class="d-flex flex-column gap-3">

                        <input type="text" placeholder="Usuario" class=" form-control px-3 py-2 border-dark">
                        <input type="password" placeholder="Contraseña" class=" form-control px-3 py-2 border-dark">


                        <!-- INFO: Son elementos a porque el button no tiene href y tenia problemas en el JS para coger las configuraciones globales -->
                        <a type="button"
                            class="btn_iniciarsesion btn bg-white border border-dark border-2 fw-bold mt-3">Iniciar
                            sesion</a>
                        <a type="button" href="<?php echo APP_URL ?>/registro"
                            class="btn_registro btn btn-dark text-white fw-bold">Registrarse</a>
                    </form>




                </div>
            </li>


            <!-- Icono de carrito -->
            <li class="position-relative">
                <i class="iconoCarrito fa-solid fa-basket-shopping fa-lg h-100 p-2"></i>

                <div class="carrito_content  d-none flex-column  mt-3 rounded-3 border border-2">

                    <div class="productosCarrito p-3">
                        <article class="d-flex gap-2 pb-4 border-bottom border-2 position-relative">
                            <i class="borrarProducto fa-regular fa-circle-xmark text-danger"></i>
                            <img class="rounded" src="N10_Presentacion\N14_Assets\Images\camisa_1.webp" alt="">
                            <div class="info d-flex flex-column">
                                <h2 class="productTitle fw-bold">Gorro de invierno con orejeras</h2>

                                <div
                                    class="cantidad_precio mt-1 w-100 d-flex justify-content-between align-items-center">

                                    <div class="contador d-flex align-items-center gap-1">
                                        <button class="btnDecrementa bg-white border-0">-</button>
                                        <input type="number" class="counter border-0" size="" value="1">
                                        <button class="btnIncrementa bg-white border-0">+</button>
                                    </div>

                                    <span class="fw-bold">12,45€</span>
                                </div>
                            </div>
                        </article>

                        <article class="d-flex gap-2 pb-4 border-bottom border-2 position-relative">
                            <i class=" borrarProducto fa-regular fa-circle-xmark text-danger"></i>

                            <img class="rounded" src="N10_Presentacion\N14_Assets\Images\camisa_1.webp" alt="">
                            <div class="info d-flex flex-column">
                                <h2 class="productTitle fw-bold">Gorro de invierno con orejeras</h2>

                                <div
                                    class="cantidad_precio mt-1 w-100 d-flex justify-content-between align-items-center">

                                    <div class="contador d-flex align-items-center gap-1">
                                        <button class="btnDecrementa bg-white border-0">-</button>
                                        <input type="number" class="counter border-0" size="" value="1">
                                        <button class="btnIncrementa bg-white border-0">+</button>
                                    </div>

                                    <span class=" fw-bold">12,45€</span>
                                </div>
                            </div>
                        </article>

                        <article class="d-flex gap-2 pb-4 border-bottom border-2 position-relative">
                            <i class="borrarProducto fa-regular fa-circle-xmark text-danger"></i>

                            <img class="rounded" src="N10_Presentacion\N14_Assets\Images\camisa_1.webp" alt="">
                            <div class="info d-flex flex-column">
                                <h2 class="productTitle fw-bold">Gorro de invierno con orejeras</h2>

                                <div
                                    class="cantidad_precio mt-1 w-100 d-flex justify-content-between align-items-center">

                                    <div class="contador d-flex align-items-center gap-1">
                                        <button class="btnDecrementa bg-white border-0">-</button>
                                        <input type="number" class="counter border-0" size="" value="1">
                                        <button class="btnIncrementa bg-white border-0">+</button>
                                    </div>

                                    <span class=" fw-bold">12,45€</span>
                                </div>
                            </div>
                        </article>


                        <article class="d-flex gap-2 pb-4 border-bottom border-2 position-relative">
                            <i class="borrarProducto fa-regular fa-circle-xmark text-danger"></i>

                            <img class="rounded" src="N10_Presentacion\N14_Assets\Images\camisa_1.webp" alt="">
                            <div class="info d-flex flex-column">
                                <h2 class="productTitle fw-bold">Gorro de invierno con orejeras</h2>

                                <div
                                    class="cantidad_precio mt-1 w-100 d-flex justify-content-between align-items-center">

                                    <div class="contador d-flex align-items-center gap-1">
                                        <button class="btnDecrementa bg-white border-0">-</button>
                                        <input type="number" class="counter border-0" size="" value="1">
                                        <button class="btnIncrementa bg-white border-0">+</button>
                                    </div>

                                    <span class="fw-bold">12,45€</span>
                                </div>
                            </div>
                        </article>


                    </div>

                    <div class="resumen d-flex flex-column p-3">

                        <div class="codigos_descuento position-relative">
                            <span class="fw-bold">Tienes codigos descuento?</span>
                            <input type="text" class="form-control px-3 py-2 border-dark mt-2 " placeholder="Codigo">
                            <button type="button" class="btn btn-dark d-flex justify-content-center align-items-center"><i class="fa-solid fa-check"></i></button>

                        </div>



                        <div class="row d-flex justify-content-between mt-4">
                            <span class="col">Subtotal:</span>
                            <span class="col text-end">165€</span>
                        </div>

                        <hr>
                        <div class="row d-flex justify-content-between">
                            <span class="col">21% IVA:</span>
                            <span class="col text-end">185€</span>
                        </div>

                        <hr>
                        <div class="row d-flex justify-content-between">
                            <h2 class="col fw-bold">TOTAL:</h2>
                            <h2 class="col text-end fw-bold">185€</h2>
                        </div>
                        <button type="button" class="btn btn-dark mt-2">COMPRAR</button>

                    </div>

                </div>

            </li>
            <!-- Icono de favoritos -->
            <li>
                <i class="iconoFavoritos fa-solid fa-heart fa-lg h-100 p-2"></i>
            </li>
        </ul>
    </div>

</header>