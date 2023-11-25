<main>

    <section class="container-lg d-flex flex-column align-items-center justify-content-center">
        <h2 class="mainTitle text-center">REGISTRATE EN VANDIER</h2>
        <hr class="lineaDivisora w-25">

        <form id="multipasos-form" class="mt-5 border border-2 border-white p-4 rounded-3">

            <!-- Paso 1 -->
            <div class="step active" id="step1">

                <div class="form-group">
                    <h2 class="fw-bold">Danos tu nombre</h2>

                    <div class="d-flex flex-column gap-3 mt-4">
                        <input type="text" class="form-control" placeholder="Usuario" required>
                        <input type="text" class="form-control" placeholder="Nombre" required>
                        <input type="text" class="form-control" placeholder="Apellido" required>
                    </div>


                </div>
                <button type="button" class="btn border border-white text-white border-2 fw-bold mt-3 mt-5"
                    onclick="nextStep(1)">Siguiente</button>
            </div>

            <!-- Paso 2 -->
            <div class="step" id="step2">
                <h2 class="fw-bold">Define las credenciales</h2>
                <div class="form-group">
                    <div class="d-flex flex-column gap-3 mt-4">
                        <input type="email" class="form-control" placeholder="Email" required>
                        <input type="password" class="form-control" placeholder="Contraseña" required>
                        <input type="password" class="form-control" placeholder="Confirma la contraseña" required>

                    </div>
                </div>
                <div class="mt-5 d-flex gap-3">
                    <button type="button" class="btn btn-dark" onclick="prevStep(2)">Anterior</button>
                    <button type="button" class="btn border border-white text-white border-2 fw-bold"
                        onclick="nextStep(2)">Registrarse</button>

                </div>

            </div>

            <!-- Paso 3 -->
            <div class="step" id="step3">

                <div class="alert alert-success" role="alert">
                    Te has registrado correctamente
                </div>
                <div class="alert alert-danger" role="alert">
                    Error en el registro
                </div>
                <a href="<?php APP_URL ?>/tienda"
                    class="btn border border-white text-white border-2 fw-bold mt-5">Ver tienda</a>
            </div>
        </form>
    </section>

</main>