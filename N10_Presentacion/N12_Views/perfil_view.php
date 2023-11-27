<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4 left-side">
               
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                       AAAAAAAAAA<?php  $user  ?>
                    </h5>
                    <h6>
                        aaaaaaaaaaaaaa<?php  $rol  ?>
                    </h6>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#" role="tab"
                                aria-controls="home" aria-selected="true">About</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Guardar" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 profile-img">
            <img src="N10_Presentacion\N14_Assets\Images\perfilFoto.png" alt="" />
            </div>
            <div class="col-md-8 left-side">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Usuario</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" value ="<?php  $user  ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nombre</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" value ="<?php  $nombre . " " . $apellido  ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" value ="<?php  $email  ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Telefono</label>
                            </div>
                            <div class="col-md-6">
                            <input type="text" value ="655 555 555">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Fecha de Registro</label>
                            </div>
                            <div class="col-md-6">
                            <input type="text" value ="<?php  $fechaRegistro  ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>