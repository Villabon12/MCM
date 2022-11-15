<div class="main-panel">

    <?php if ($perfil->img_perfil == (NULL)) {

        $perfil->img_perfil = "usuario.png";
    } else {

        $perfil->img_perfil = $perfil->img_perfil;
    } ?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">



    <div class="content-wrapper">
        <?php if ($this->session->flashdata("error")) { ?>

            <p><?php echo $this->session->flashdata("error") ?></p>

        <?php } ?>
        <?php if ($this->session->flashdata("exito")) { ?>

            <p><?php echo $this->session->flashdata("exito") ?></p>

        <?php } ?>
        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-body">

                        <div class="row">

                            <div class="col-lg-4">

                                <div class="border-bottom text-center pb-4">

                                    <button type="button" style="border:none;background:none;" data-bs-toggle="modal" data-bs-target="#verFoto">
                                        <img src="<?= base_url() ?>assets/img/fotosPerfil/<?= $perfil->img_perfil ?>" alt="profile" class="img-lg rounded-circle mb-3" />
                                    </button>
                                    <button type="button" style="padding:0;border:none;background:none;position: relative; top:35px; right:30px; " data-bs-toggle="modal" data-bs-target="#subirFoto">
                                        <i style=" color:#36E1F9;  font-size: 30px;" class="bi bi-gear-fill"></i>
                                    </button>

                                    <!-- Button trigger modal -->



                                    <!-- Modal ver -->

                                    <div class="modal fade" id="verFoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                        <div class="modal-dialog">

                                            <div class="modal-content">

                                                <div class="modal-header">

                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                                                </div>

                                                <center>

                                                    <div class="modal-body">

                                                        <img src="<?= base_url() ?>assets/img/fotosPerfil/<?= $perfil->img_perfil ?>" width="300px" height="250px" alt="profile">

                                                    </div>

                                                </center>

                                            </div>

                                        </div>

                                    </div>



                                    <!-- Modal actualizar -->

                                    <div class="modal fade" id="subirFoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                        <div class="modal-dialog">

                                            <div class="modal-content">

                                                <form action="<?= base_url() ?>Perfil/actualizarFoto/<?= $perfil->token ?>" method="post" enctype="multipart/form-data">

                                                    <div class="modal-header">

                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Sube una foto de perfil</h1>

                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                                                    </div>

                                                    <div class="modal-body">

                                                        <div class="input-group mb-3">

                                                            <label for=" sube un archivo"></label>

                                                            <input type="file" class="form-control" placeholder="Username" aria-label="img" aria-describedby="basic-addon1" name="img">

                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                                                        <button type="submit" style="background-color: #36E1F9;" class="btn ">Modificar</button>

                                                    </div>

                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="mb-3">

                                        <h3><?= $perfil->nombre . "  " . $perfil->apellido1 ?></h3>

                                        <div class="d-flex align-items-center justify-content-center">

                                            <h5 class="mb-0 me-2 text-muted"><?= $perfil->ciudad_id ?></h5>

                                        </div><br>

                                        <?php if ($perfil->cedula == "1003895100" || $perfil->cedula == "1075316223") { ?>

                                            <div class="d-flex align-items-center justify-content-center">

                                                <h5 class="mb-0 me-2 text-muted"> Desarrollador</h5>

                                            </div> <br>

                                            <div class="d-flex align-items-center justify-content-center">

                                                <h5 class="mb-0 me-2 text-muted"><?= $perfil->tipo ?></h5>

                                            </div>

                                        <?php } else { ?>

                                            <div class="d-flex align-items-center justify-content-center">

                                                <h5 class="mb-0 me-2 text-muted"><?= $perfil->tipo ?></h5>

                                            </div>

                                        <?php } ?>
                                        <?php if ($perfil->img_cedula_front == null || $perfil->img_cedula_back == null || $perfil->img_selfie == null) { ?>
                                            <br>
                                            <a href="<?= base_url() ?>Perfil/updateCuenta/<?= $perfil->token ?>" class="btn btn-success">Verificar usuario</a>
                                        <?php } else { ?>

                                        <?php } ?>

                                    </div>

                                </div>


                                <!-- <div class="py-4">

                                    <p class="clearfix">

                                        <span class="float-left">

                                            Estado

                                        </span>

                                        <span class="float-right text-muted">
                                            <?php if ($perfil->verificar_user == 0) { ?>
                                                Inactivo
                                            <?php } else { ?>
                                                Activo
                                            <?php } ?>


                                        </span>

                                    </p>

                                </div> -->

                            </div>

                            <div class="col-lg-8">

                                <div class="mt-4 py-2 border-top border-bottom">

                                    <ul class="nav profile-navbar">

                                        <li class="nav-item">

                                            <a class="nav-link active" href="<?= base_url() ?>Inicio_page/perfil">

                                                <i class="ti-user"></i>

                                                Informacion

                                            </a>

                                        </li>

                                        <!-- <li class="nav-item">

                                            <a class="nav-link" href="#">

                                                <i class="ti-calendar"></i>

                                                Direcciones

                                            </a>

                                        </li> -->

                                    </ul>

                                </div>

                                <form method="post" action="<?= base_url() ?>Perfil/updatePerfil/<?= $perfil->token ?>">

                                    <div class="row">

                                        <div class="col">

                                            <label for="inputCity" class="form-label">Nombre</label>

                                            <input type="text" class="form-control" placeholder="Nombre" value="<?= $perfil->nombre ?>" name="nombre">

                                        </div>

                                        <div class="col">

                                            <label for="inputCity" class="form-label">Apellido</label>

                                            <input type="text" class="form-control" placeholder="" value="<?= $perfil->apellido1 ?>" name="apellido1">

                                        </div>

                                    </div> <br>

                                    <div class="row">

                                        <div class="col">

                                            <label for="inputCity" class="form-label">Cedula</label>

                                            <span class="input-group-text" id="basic-addon2"><?= $perfil->cedula ?> </span>

                                        </div>

                                        <div class="col">

                                            <label for="inputCity" class="form-label">Celular</label>

                                            <input type="text" class="form-control" placeholder="celular" value="<?= $perfil->celular ?>" name="celular">

                                        </div>

                                    </div><br>

                                    <div class="row">

                                        <div class="col">

                                            <label for="inputCity" class="form-label">Fecha nacimiento</label>

                                            <input type="date" class="form-control" value="<?= date("d/m/Y", strtotime($perfil->fecha_nacimiento)) ?> " name="fecha_nacimiento" id="datepicker">

                                            <p style="color: green;"> Su fecha de nacimiento es : <?= $perfil->fecha_nacimiento ?></p>

                                        </div>

                                        <div class="col">

                                            <label for="inputCity" class="form-label">Usuario</label>

                                            <span class="input-group-text" id="basic-addon2"> <?= $perfil->user ?> </span>

                                        </div>

                                        <div class="col">
                                            <label for="inputCity" class="form-label">Contraseña</label>
                                            <div class="row">
                                                <div class="input-group lg-3">
                                                    <input type="text" class="form-control" placeholder="" value="***************" aria-label="Recipient's username" aria-describedby="button-addon2" readonly>
                                                    <button class="btn btn-success" style="line-height: 0;" type="button" data-bs-toggle="modal" data-bs-target="#actualizarcontra<?= $perfil->id ?>"><i class="mdi mdi-wrench"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col">


                                            <label for="inputCity" class="form-label">Correo</label>

                                            <span class="input-group-text" id="basic-addon2"> <?= $perfil->correo ?> </span>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col">

                                            <label for="inputCity" class="form-label">Fecha registro</label>

                                            <span class="input-group-text" id="basic-addon2"> <?= $perfil->fecha_registro ?> </span>
                                        </div>
                                    </div><br>

                                    <div class="row">

                                        <button style="background-color: #36E1F9;" type="submit" class="btn">Modificar</button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="modal fade" id="actualizarcontra<?= $perfil->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">actualizar contraseña</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url() ?>Perfil/actualizarcontra/<?= $perfil->id ?>" method="POST">

                    <div class="modal-body">
                        <div class="col">

                            <label for="inputCity" class="form-label">Contraseña actual</label>
                            <div class="row">
                                <div class="input-group lg-3">
                                    <input type="password" class="form-control" placeholder="" name="contra_actual" aria-label="Recipient's username" aria-describedby="button-addon2">
                                </div>
                            </div>
                            <label for="inputCity" class="form-label">Contraseña nueva</label>
                            <div class="row">
                                <div class="input-group lg-3">
                                    <input type="password" class="form-control" placeholder="" id="Input" name="contra_nueva" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <!-- <button class="btn btn-success" style="line-height: 0;" id="Eye" type="button" ><i class="mdi mdi-adjust"></i></button> -->
                                </div>
                            </div>
                            <label for="inputCity" class="form-label">Confirme su contraseña</label>
                            <div class="row">
                                <div class="input-group lg-3">
                                    <input type="password" class="form-control" placeholder="" aria-label="Recipient's username" name="confir_contra" aria-describedby="button-addon2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>