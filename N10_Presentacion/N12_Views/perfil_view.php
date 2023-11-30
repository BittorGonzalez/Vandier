<main>

    <div class="container-xl px-4 mt-5">
        <div class="row">
            <div class="col-xl-4">
                <div class="card mb-4 mb-xl-0 rounded-4">
                    <div class="card-header fw-bold">Foto de perfil</div>
                    <div class="card-body text-center">
                        
                        <i class="fa-solid fa-user p-3 border border-2 border-dark fs-1 rounded-circle"></i>

                        <div class="small font-italic text-muted my-4">
                            JPG o PNG no mayores a 5MB
                        </div>

                        <button class="btn bg-white border border-dark border-2 fw-bold px-4" type="button">
                            Actualizar imagen
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card mb-4 datos rounded-4">
                    <div class="card-header fw-bold">Datos personales</div>
                    <div class="card-body">
                        <form class="mt-3 px-4">
                            <div class="mb-3">
                                <label class="mb-2" for="inputUsername ">Usuario</label>
                                <input class="form-control px-3 py-2 border-dark" id="inputUsername" type="text" value="" />
                            </div>

                            <div class="row gx-4 gy-4">
                                <div class="col-md-6">
                                    <label class="mb-2" for="inputFirstName">Nombre</label>
                                    <input class="form-control px-3 py-2 border-dark" id="inputFirstName" type="text" value="" />
                                </div>

                                <div class="col-md-6">
                                    <label class="mb-2" for="inputLastName">Apellido</label>
                                    <input class="form-control px-3 py-2 border-dark" id="inputLastName" type="text" value="" />
                                </div>
                            </div>

                            <div class="row gx-4 gy-4 mt-1">
                                <div class="col-md-6">
                                    <label class="mb-2" for="inputOrgName">Correo electronico</label>
                                    <input class="form-control px-3 py-2 border-dark" id="inputOrgName" type="text" value="" />
                                </div>

                                <div class="col-md-6">
                                    <label class="mb-2" for="inputLocation">Contraseña</label>
                                    <input class="form-control px-3 py-2 border-dark" id="inputLocation" type="password" value="" />
                                </div>
                            </div>

                          

                            

                            <button class="btnGuardar btn btn-dark text-white fw-bold mt-5 mb-2 px-5" type="button">
                               Guardar cambios
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>